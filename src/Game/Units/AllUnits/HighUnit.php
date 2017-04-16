<?php

namespace Game\Units\AllUnits;

use Game\Contracts\Units\UnitInterface;

class HighUnit implements UnitInterface
{
    public $name = 'High';

    protected $charterers = [
        'attack' => 10,
        'armor' => 4,
    ];

    protected $magical = [];

    /**
     * @return array
     */
    public function getCharterers(): array
    {
        return $this->charterers;
    }

    /**
     * @param string $key
     * @param int $value
     * @return FreeUnit
     */
    public function setCharterers(string $key, int $value): FreeUnit
    {
        $this->charterers[$key] = $value;

        return $this;
    }

    public function getMagical(): array
    {
        return $this->magical;
    }

    /**
     * @param string $key
     * @param int $value
     * @return FreeUnit
     */
    public function setMagical(string $key, int $value): FreeUnit
    {
        $this->magical[$key] = $value;

        return $this;
    }
}