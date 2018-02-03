<?php

namespace RutgerKirkels\Ethos_Api_Client;

define('ETHOS_HOST','ethosdistro.com');

class Client
{
    protected $panelId;
    protected $cacheTime = 300; // Default cache time is 5 minutes

    public function __construct($panelId = null) {
        if (!is_null($panelId)) {
            $this->panelId = $panelId;
        }
    }

    public function setPanelId(string $panelId) {
        $this->panelId = $panelId;
    }

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


        if (file_exists('/tmp/minerdata_' . $this->panelId . '.json') && $fileAge < ($this->cacheTime/60) + 1) {
            return json_decode(file_get_contents('/tmp/minerdata_' . $this->panelId . '.json'));
        }

        $client = new \GuzzleHttp\Client();
        $url = 'http://' .$this->panelId . '.' . ETHOS_HOST;
        $res = $client->request('get', $url, [
            'query' => ['json' => 'yes']
        ]);
        file_put_contents('/tmp/minerdata_' . $this->panelId . '.json', (string) $res->getBody());
        return json_decode((string) $res->getBody());
    }

    public function getStats() {
        $miners = [];
        $data = $this->getData();

        foreach ($data->rigs as $ethosId => $minerData) {
            $miner = new Miner();
            $miner->setId($ethosId);
            $miner->setTotalHashrate($minerData->hash);
            $miner->setCondition($minerData->condition);
            $miner->setDriveName($minerData->drive_name);
            $miner->setLanChip($minerData->lan_chip);
            $miner->setMotherboard($minerData->mobo);
            $miner->setTotalRam($minerData->ram);
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

    public function getStatsByMiner($ethosId) {
        $data = $this->getData();
        foreach ($data->rigs as $id => $minerData) {
            if ($id == $ethosId) {
                $miner = new Miner();
            }
        }
    }

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
        $gpus = [];
        foreach ($gpuStrings as $gpuString) {
            $gpuInfo = explode(':', $gpuString);
            $gpu = new \stdClass();
            $gpu->type = $gpuInfo[3];
            $gpu->bios = $gpuInfo[4];
            $gpus[] = $gpu;
        }
        foreach ($gpus as $id => $gpu) {
            $gpus[$id]->fanRpm = intval($gpuFanspeeds[$id]);
            $gpus[$id]->hashRate = floatval($gpuHashrates[$id]);
            $gpus[$id]->temperature = intval($gpuTemperatures[$id]);
            $gpus[$id]->power = floatval($gpuPower[$id]);
            $gpus[$id]->core = intval($gpuCores[$id]);
            $gpus[$id]->mem = intval($gpuMems[$id]);
            $gpus[$id]->vramSize = floatval($gpuVramSizes[$id]);
        }
        return $gpus;
    }

    public function scanMiner($ethosId, $panelId = null) {
        if (is_null($panelId)) {
            $this->panelId = $ethosId;
        }
        else {
            $this->panelId = $panelId;
        }
        $data = $this->getData();
        if (!isset($data->rigs->$ethosId)) {
            throw new \Exception('Miner with ethOS ID ' . $ethosId . ' couldn\'t be found.');
        }
        $minerData = $data->rigs->$ethosId;
        $miner = new Miner();
        $miner->setMotherboard($minerData->mobo);
        $miner->setTotalRam($minerData->ram);
        $miner->setLanChip($minerData->lan_chip);
        $miner->setDriveName($minerData->drive_name);
        $miner->setTotalHashrate($minerData->hash);
        return $miner;
    }

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