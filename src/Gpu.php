<?php

namespace RutgerKirkels\Ethos_Api_Client;


class Gpu
{
    protected $bios;
    protected $hash;
    protected $temperature;
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
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash): void
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
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power): void
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


}