<?php

require __DIR__.'../bootstrap.php';

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /**
     * @var Game
     */
    protected $game;

    public function setUp()
    {
        $this->game = new \Game\Game();
    }

    public function testInstancesForGame()
    {
        $this->assertInstanceOf(\Game\Theme::class, $this->game->theme);
    }
}