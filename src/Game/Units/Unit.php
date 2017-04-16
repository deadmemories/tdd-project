<?php

namespace Game\Units;

use Game\Contracts\Units\UnitInterface;
use Game\Exceptions\Units\UnitCountException;

class Unit
{
    /**
     * @var array
     *
     * Units for current game
     */
    protected $units = [];

    /**
     * @var Shower
     */
    public $show;

    public function __construct(UnitInterface $unit)
    {
        $this->show = new Shower();

        if (! $this->hasInAllUnits($unit->name)) {
            throw new \Exception('potom napishy');
        }

        $this->units[$unit->name] = [];
        $this->addUnit($unit);
    }

    /**
     * @param UnitInterface $unit
     * @param int $copy
     * @return Unit
     * @throws UnitCountException
     */
    public function addUnit(UnitInterface $unit, $copy = 1): Unit
    {
        if (20 <= $copy) {
            throw new UnitCountException('So many');
        }

        foreach ($this->units as $k => $v) {
            if ($k == $unit->name) {
                $this->units[$k]['copy'] += $copy;
                if (! $this->units[$k]['charterers']) {
                    $this->units[$k]['charterers'] = $unit->getCharterers();
                    $this->units[$k]['magical'] = $unit->getMagical();
                }
            } else {
                $this->units[$unit->name]['charterers'] = $unit->getCharterers();
                $this->units[$unit->name]['magical'] = $unit->getMagical();
                $this->units[$unit->name]['copy'] = $copy;
            }
        }

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    private function hasInAllUnits(string $name): bool
    {
        return array_key_exists(mb_strtolower($name), $this->show->allUnits);
    }

    /**
     * @return array
     */
    public function getUnits(): array
    {
        return $this->units;
    }
}