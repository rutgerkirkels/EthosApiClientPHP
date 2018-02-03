<?php

namespace RutgerKirkels\Ethos_Api_Client;


class Miner
{
    /**
     * @var string
     */
    protected $id;
    protected $motherboard;
    protected $driveName;
    protected $lanChip;
    protected $version;
    protected $condition;
    protected $ram;
    protected $totalHashrate;
    protected $gpus = [];

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @param string $id
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
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * @param mixed $totalRam
     */
    public function setRam($ram): void
    {
        $this->ram = $ram;
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

    /**
     * @return int Total number of GPU's
     */
    public function getTotalGpus() {
        return count($this->gpus);
    }
}