<?php

namespace Game\Units;

class Unit
{
    /**
     * @var array
     *
     * All units
     */
    protected $allUnits = ['Common', 'FreeUnit', 'HighUnit', 'MyUnit'];

    /**
     * @var array
     *
     * Units for current game
     */
    protected $units = [];
}