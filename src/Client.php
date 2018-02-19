<?php

namespace RutgerKirkels\Ethos_Api_Client;

use GuzzleHttp\Exception\ConnectException;

/**
 * Class Client
 * @package RutgerKirkels\Ethos_Api_Client
 * @author Rutger Kirkels <rutger@kirkels.nl>
 * @license
 */
class Client
{
    const ETHOS_HOST = 'ethosdistro.com';
    protected $panelId;
    protected $cacheTime;

    /**
     * @var bool
     */
    protected $enableCaching;

    /**
     * Client constructor.
     * @param string|null $panelId
     * @param bool $enableCaching
     */
    public function __construct(string $panelId = null, $enableCaching = false) {
        if (!is_null($panelId)) {
            $this->panelId = $panelId;
        }

        if ($enableCaching === true) {
            $this->enableCaching();
        }
    }

    /**
     * @param int $seconds
     */
    public function enableCaching(int $seconds = 300) {
        $this->cacheTime = $seconds;
    }

    /**
     * @param string $panelId
     */
    public function setPanelId(string $panelId) {
        $this->panelId = $panelId;
    }

    /**
     * @return object
     * @throws \Exception
     */
    protected function getData() {
        if (is_null($this->panelId)) {
            throw new \Exception('No panel ID set.');
        }

        // Calculate the cache file's age in minutes
        if (file_exists('/tmp/minerdata_' . $this->panelId . '.json')) {
            $fileTime = new \DateTime();
            $fileTime->setTimestamp(filemtime('/tmp/minerdata_' . $this->panelId . '.json'));
            $fileAge = $fileTime->diff(new \DateTime())->i;
        }

        if (!is_null($this->cacheTime)) {
            if (file_exists('/tmp/minerdata_' . $this->panelId . '.json') && $fileAge < ($this->cacheTime/60) + 1) {
                return json_decode(file_get_contents('/tmp/minerdata_' . $this->panelId . '.json'));
            }
        }

        $client = new \GuzzleHttp\Client();
        $url = 'http://' .$this->panelId . '.' . self::ETHOS_HOST;
        try {
            $res = $client->request('get', $url, [
                'query' => ['json' => 'yes']
            ]);
        }

        catch (ConnectException $e) {
            error_log('Unable to connect to ' . $url, E_USER_WARNING);
            return false;
        }


        file_put_contents('/tmp/minerdata_' . $this->panelId . '.json', (string) $res->getBody());
        return json_decode((string) $res->getBody());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getStats() {
        $miners = [];
        $data = $this->getData();

        foreach ($data->rigs as $ethosId => $minerData) {
            $miner = new Miner();
            $miner->setId($ethosId);
            $miner->setHashrate($minerData->hash);
            $miner->setCondition($minerData->condition);
            $miner->setDriveName($minerData->drive_name);
            $miner->setLanChip($minerData->lan_chip);
            $miner->setMotherboard($minerData->mobo);
            $miner->setRam($minerData->ram);
            $miner->setVersion($minerData->version);
            $bios = explode(' ', $minerData->bioses);
            $hash = explode(' ', $minerData->miner_hashes);
            $temps = explode(' ', $minerData->temp);
            $watts = explode(' ', $minerData->watts);
            $fans = explode(' ', $minerData->fanrpm);
            $core = explode(' ', $minerData->core);
            $mem = explode(' ', $minerData->mem);
            $powertune = explode(' ', $minerData->powertune);
            $vramsize = explode(' ', $minerData->vramsize);
            for ($i = 0; $i < intval($minerData->gpus); $i++) {
                $gpu = new Gpu();
                $gpu->setBios($bios[$i]);
                $gpu->setHash(floatval($hash[$i]));
                $gpu->setFanSpeed(intval($fans[$i]));
                $gpu->setPower(floatval($watts[$i]));
                $gpu->setTemperature(intval($temps[$i]));
                $gpu->setPowerTune(intval($powertune[$i]));
                $gpu->setVramSize(intval($vramsize[$i]));
                $gpu->setCoreSpeed(intval($core[$i]));
                $gpu->setMemorySpeed(intval($mem[$i]));
                $miner->addGpu($gpu);
            }

            $miners[$ethosId] = $miner;
        }
        return $miners;
    }

    /**
     * @param string $ethosId
     * @return array
     * @throws \Exception
     */
    public function scanGpus(string $ethosId) {
        $data = $this->getData();

        $gpuStrings = explode(PHP_EOL, $data->rigs->$ethosId->meminfo);
        $gpuFanspeeds = explode(' ', $data->rigs->$ethosId->fanrpm);
        $gpuHashrates = explode(' ', $data->rigs->$ethosId->miner_hashes);
        $gpuTemperatures = explode(' ', $data->rigs->$ethosId->temp);
        $gpuPower = explode(' ', $data->rigs->$ethosId->watts);
        $gpuCores = explode(' ', $data->rigs->$ethosId->core);
        $gpuMems = explode(' ', $data->rigs->$ethosId->mem);
        $gpuVramSizes = explode(' ', $data->rigs->$ethosId->vramsize);
        $gpuPowertunes = explode(' ', $data->rigs->$ethosId->powertune);
        $gpus = [];

        $id = 0;
        foreach ($gpuStrings as $gpuString) {
            $gpuInfo = explode(':', $gpuString);
            $gpu = new Gpu();
            $gpu->setType($gpuInfo[3]);
            $gpu->setBios($gpuInfo[4]);
            $gpu->setFanSpeed(intval($gpuFanspeeds[$id]));
            $gpu->setHash(floatval($gpuHashrates[$id]));
            $gpu->setTemperature(intval($gpuTemperatures[$id]));
            $gpu->setPower(floatval($gpuPower[$id]));
            $gpu->setCoreSpeed(intval($gpuCores[$id]));
            $gpu->setMemorySpeed(intval($gpuMems[$id]));
            $gpu->setVramSize(floatval($gpuVramSizes[$id]));
            $gpu->setPowerTune(intval($gpuPowertunes[$id]));
            $gpus[$id] = $gpu;
            $id += 1;
        }
        return $gpus;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAllMiners() {
        $data = $this->getData();
        $miners = [];
        foreach ($data->rigs as $rigId => $rigData) {
            $miners[] = $this->getMiner($rigId);
        }
        return $miners;
    }

    /**
     * @param $ethosId
     * @param null $panelId
     * @return bool|Miner
     * @throws \Exception
     */
    public function getMiner($ethosId, $panelId = null) {
        if (!is_null($panelId)) {
            $this->panelId = $panelId;
        }

        $data = $this->getData();

        if (!$data) {
            return false;
        }
        if (!isset($data->rigs->$ethosId)) {
            throw new \Exception('Miner with ethOS ID ' . $ethosId . ' couldn\'t be found.');
        }
        $minerData = $data->rigs->$ethosId;
        $miner = new Miner();
        $miner->setId($ethosId);
        $miner->setMotherboard($minerData->mobo);
        $miner->setRam($minerData->ram);
        $miner->setLanChip($minerData->lan_chip);
        $miner->setDriveName($minerData->drive_name);
        $miner->setHashrate($minerData->hash);
        $miner->setCondition($minerData->condition);
        $miner->setVersion($minerData->version);

        foreach ($this->scanGpus($ethosId) as $data) {
            $gpu = new Gpu();
            $gpu->setType($data->type);
            $gpu->setBios($data->bios);
            $gpu->setFanSpeed($data->fanRpm);
            $gpu->setHash($data->hashRate);
            $gpu->setTemperature($data->temperature);
            $gpu->setPower($data->power);
            $gpu->setCoreSpeed($data->core);
            $gpu->setMemorySpeed($data->mem);
            $gpu->setVramSize($data->vramSize);
            $miner->addGpu($gpu);
        }
        return $miner;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTotalHashrate() {
        $data = $this->getData();
        return $data->total_hash;
    }

    /**
     * @return int
     */
    public function getCacheTime(): int
    {
        return $this->cacheTime;
    }

    /**
     * @param int $cacheTime
     */
    public function setCacheTime(int $cacheTime): void
    {
        $this->cacheTime = $cacheTime;
    }


}