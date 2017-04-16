<?php

require __DIR__.'../bootstrap.php';

use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    /**
     * @var \Game\Units\Unit
     */
    protected $unit;

    public function setUp()
    {
        $this->unit = new \Game\Units\Unit(new \Game\Units\AllUnits\CommonUnit());
    }

    public function testExceptionsWhenManyUnits()
    {
        $this->expectException(\Game\Exceptions\Units\UnitCountException::class);
        $this->unit->addUnit(new \Game\Units\AllUnits\CommonUnit(), 25);
    }

    public function testAddUnitsWithoutMultiplication()
    {
        $this->assertInstanceOf(
            \Game\Units\Unit::class,
            $this->unit->addUnit(new \Game\Units\AllUnits\CommonUnit())
        );

        $result = $this->unit->addUnit(new \Game\Units\AllUnits\FreeUnit());
        $this->assertArrayHasKey('Free', $result->getUnits());
        $this->assertEquals(1, $result->getUnits()['Free']['copy']);
    }

    public function testAddUnitsWithMultiplication()
    {
        $result = $this->unit->addUnit(new \Game\Units\AllUnits\HighUnit(), 4);
        $this->assertArrayHasKey('High', $result->getUnits());
        $this->assertEquals(4, $result->getUnits()['High']['copy']);

        $this->assertInstanceOf(
            \Game\Units\Unit::class,
            $this->unit->addUnit(new \Game\Units\AllUnits\VipUnit(), 3)
        );
    }

    public function testGetHeroesForCommonUser()
    {
        $result = $this->unit->show->getUnits(\Game\Users\CommonUser::class);

        $this->assertNotEmpty($result);
        $this->assertContains(\Game\Units\AllUnits\CommonUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\FreeUnit::class, $result);
    }

    public function testGetHeroesForDonatedUser()
    {
        $result = $this->unit->show->getUnits(\Game\Users\DonatedUser::class);

        $this->assertNotEmpty($result);
        $this->assertContains(\Game\Units\AllUnits\CommonUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\HighUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\FreeUnit::class, $result);
    }

    public function testGetHeroesForVipUser()
    {
        $result = $this->unit->show->getUnits(\Game\Users\VipUser::class);

        $this->assertNotEmpty($result);
        $this->assertContains(\Game\Units\AllUnits\CommonUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\HighUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\FreeUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\VipUnit::class, $result);
    }
}