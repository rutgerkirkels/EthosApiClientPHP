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

    /**
     * @var int
     */
    protected $fanSpeed;

    /**
     * @var float
     */
    protected $vramSize;

    /**
     * @var int
     */
    protected $powerTune;

    /**
     * @var int
     */
    protected $coreSpeed;

    /**
     * @var int
     */
    protected $memorySpeed;

    /**
     * @return string
     */
    public function getBios() : string
    {
        return $this->bios;
    }

    /**
     * @param string $bios
     */
    public function setBios(string $bios): void
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
     * @return int
     */
    public function getTemperature() : int
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature(int $temperature): void
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
     * @return int
     */
    public function getFanSpeed() : int
    {
        return $this->fanSpeed;
    }

    /**
     * @param int $fanSpeed
     */
    public function setFanSpeed(int $fanSpeed): void
    {
        $this->fanSpeed = $fanSpeed;
    }

    /**
     * @return float
     */
    public function getVramSize() : float
    {
        return $this->vramSize;
    }

    /**
     * @param float $vramSize
     */
    public function setVramSize(float $vramSize): void
    {
        $this->vramSize = $vramSize;
    }

    /**
     * @return int
     */
    public function getPowerTune() : int
    {
        return $this->powerTune;
    }

    /**
     * @param int $powerTune
     */
    public function setPowerTune(int $powerTune): void
    {
        $this->powerTune = $powerTune;
    }

    /**
     * @return int
     */
    public function getCoreSpeed() : int
    {
        return $this->coreSpeed;
    }

    /**
     * @param int $coreSpeed
     */
    public function setCoreSpeed(int $coreSpeed): void
    {
        $this->coreSpeed = $coreSpeed;
    }

    /**
     * @return int
     */
    public function getMemorySpeed() : int
    {
        return $this->memorySpeed;
    }

    /**
     * @param int $memorySpeed
     */
    public function setMemorySpeed(int $memorySpeed): void
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