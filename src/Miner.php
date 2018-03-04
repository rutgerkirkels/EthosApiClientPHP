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
    protected $hashrate;

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
     * @param Gpu $gpu
     */
    public function addGpu(Gpu $gpu): void
    {
        $this->gpus[] = $gpu;
    }

    /**
     * @return string
     */
    public function getMotherboard() : string
    {
        return $this->motherboard;
    }

    /**
     * @param string $motherboard
     */
    public function setMotherboard(string $motherboard): void
    {
        $this->motherboard = $motherboard;
    }

    /**
     * @return string
     */
    public function getDriveName() : string
    {
        return $this->driveName;
    }

    /**
     * @param string $driveName
     */
    public function setDriveName(string $driveName): void
    {
        $this->driveName = $driveName;
    }

    /**
     * @return string
     */
    public function getLanChip() : string
    {
        return $this->lanChip;
    }

    /**
     * @param string $lanChip
     */
    public function setLanChip(string $lanChip): void
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
     * @return float
     */
    public function getHashrate() : float
    {
        return $this->hashrate;
    }

    /**
     * @param float $hashrate
     */
    public function setHashrate(float $hashrate): void
    {
        $this->hashrate = $hashrate;
    }

    /**
     * @return int Total number of GPU's
     */
    public function getTotalGpus() {
        return count($this->gpus);
    }
}