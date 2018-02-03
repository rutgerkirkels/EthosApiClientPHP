<?php

namespace RutgerKirkels\Ethos_Api_Client;


class Miner
{
    protected $id;
    protected $motherboard;
    protected $driveName;
    protected $lanChip;
    protected $version;
    protected $condition;
    protected $totalRam;
    protected $totalHashrate;
    protected $gpus = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getGpus(): array
    {
        return $this->gpus;
    }

    /**
     * @param array $gpus
     */
    public function addGpu(Gpu $gpu): void
    {
        $this->gpus[] = $gpu;
    }

    /**
     * @return mixed
     */
    public function getMotherboard()
    {
        return $this->motherboard;
    }

    /**
     * @param mixed $motherboard
     */
    public function setMotherboard($motherboard): void
    {
        $this->motherboard = $motherboard;
    }

    /**
     * @return mixed
     */
    public function getDriveName()
    {
        return $this->driveName;
    }

    /**
     * @param mixed $driveName
     */
    public function setDriveName($driveName): void
    {
        $this->driveName = $driveName;
    }

    /**
     * @return mixed
     */
    public function getLanChip()
    {
        return $this->lanChip;
    }

    /**
     * @param mixed $lanChip
     */
    public function setLanChip($lanChip): void
    {
        $this->lanChip = $lanChip;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param mixed $condition
     */
    public function setCondition($condition): void
    {
        $this->condition = $condition;
    }

    /**
     * @return mixed
     */
    public function getTotalRam()
    {
        return $this->totalRam;
    }

    /**
     * @param mixed $totalRam
     */
    public function setTotalRam($totalRam): void
    {
        $this->totalRam = $totalRam;
    }

    /**
     * @return mixed
     */
    public function getTotalHashrate()
    {
        return $this->totalHashrate;
    }

    /**
     * @param mixed $totalHashrate
     */
    public function setTotalHashrate($totalHashrate): void
    {
        $this->totalHashrate = $totalHashrate;
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

    public function getHashrate() {
        $data = $this->getData();
        var_dump($data);die;
    }
}