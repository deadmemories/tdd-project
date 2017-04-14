<?php

namespace Game;

class Game
{
    /**
     * @var Theme
     */
    public $theme;

    public function __construct()
    {
        $this->theme = new Theme();
    }
}