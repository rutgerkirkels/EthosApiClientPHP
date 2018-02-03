<?php

namespace RutgerKirkels\Ethos_Api_Client;

/**
 * Class Gpu
 * @package RutgerKirkels\Ethos_Api_Client
 * @author Rutger Kirkels <rutger@kirkels.nl>
 */
class Gpu
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $bios;

    /**
     * @var float
     */
    protected $hash;

    /**
     * @var int
     */
    protected $temperature;

    /**
     * @var int
     */
    protected $power;
    protected $fanSpeed;
    protected $vramSize;
    protected $powerTune;
    protected $coreSpeed;
    protected $memorySpeed;

    /**
     * @return mixed
     */
    public function getBios()
    {
        return $this->bios;
    }

    /**
     * @param mixed $bios
     */
    public function setBios($bios): void
    {
        $this->bios = $bios;
    }

    /**
     * @return float
     */
    public function getHash() : float
    {
        return $this->hash;
    }

    /**
     * @param float $hash
     */
    public function setHash(float $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature($temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return int
     */
    public function getPower() : int
    {
        return $this->power;
    }

    /**
     * @param int $power
     */
    public function setPower(int $power): void
    {
        $this->power = $power;
    }

    /**
     * @return mixed
     */
    public function getFanSpeed()
    {
        return $this->fanSpeed;
    }

    /**
     * @param mixed $fanSpeed
     */
    public function setFanSpeed($fanSpeed): void
    {
        $this->fanSpeed = $fanSpeed;
    }

    /**
     * @return mixed
     */
    public function getVramSize()
    {
        return $this->vramSize;
    }

    /**
     * @param mixed $vramSize
     */
    public function setVramSize($vramSize): void
    {
        $this->vramSize = $vramSize;
    }

    /**
     * @return mixed
     */
    public function getPowerTune()
    {
        return $this->powerTune;
    }

    /**
     * @param mixed $powerTune
     */
    public function setPowerTune($powerTune): void
    {
        $this->powerTune = $powerTune;
    }

    /**
     * @return mixed
     */
    public function getCoreSpeed()
    {
        return $this->coreSpeed;
    }

    /**
     * @param mixed $coreSpeed
     */
    public function setCoreSpeed($coreSpeed): void
    {
        $this->coreSpeed = $coreSpeed;
    }

    /**
     * @return mixed
     */
    public function getMemorySpeed()
    {
        return $this->memorySpeed;
    }

    /**
     * @param mixed $memorySpeed
     */
    public function setMemorySpeed($memorySpeed): void
    {
        $this->memorySpeed = $memorySpeed;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }


}