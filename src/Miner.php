<?php

namespace RutgerKirkels\Ethos_Api_Client;

/**
 * Class Miner
 * @package RutgerKirkels\Ethos_Api_Client
 * @author Rutger Kirkels <rutger@kirkels.nl>
 */
class Miner
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $motherboard;

    /**
     * @var string
     */
    protected $driveName;

    /**
     * @var string
     */
    protected $lanChip;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $condition;

    /**
     * @var int
     */
    protected $ram;

    /**
     * @var float
     */
    protected $totalHashrate;

    /**
     * @var array
     */
    protected $gpus;

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
     * @return int
     */
    public function getRam() : int
    {
        return $this->ram;
    }

    /**
     * @param $ram
     */
    public function setRam(int $ram): void
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