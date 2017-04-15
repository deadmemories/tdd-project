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
        $this->unit = new \Game\Units\Unit(new \Game\Units\AllUnits\Common());
    }

    public function testExceptionsWhenManyUnits()
    {
        $this->expectException(\Game\Exceptions\Units\UnitCountException::class);
        $this->unit->addUnit(new \Game\Units\AllUnits\Common(), 25);
    }

    public function testAddUnitsWithoutMultiplication()
    {
        $this->assertNull(
            $this->unit->addUnit(new \Game\Units\AllUnits\Common())
        );

        $this->assertNull(
            $this->unit->addUnit(new \Game\Units\AllUnits\FreeUnit())
        );
    }

    public function testAddUnitsWithMultiplication()
    {
        $this->assertNull(
            $this->unit->addWithCopy(new \Game\Units\AllUnits\HighUnit(), 5)
        );

        $this->assertNull(
            $this->unit->addWithCopy(new \Game\Units\AllUnits\VipUnit(), 3)
        );
    }

    public function testGetHeroesForCommonUser()
    {
        $result = $this->unit->show->GetUnits(\Game\Users\CommonUser::class);

        $this->assertNotEmpty($result);
        $this->assertContains(\Game\Units\AllUnits\Common::class, $result);
        $this->assertContains(\Game\Units\AllUnits\FreeUnit::class, $result);
    }

    public function testGetHeroesForDonatedUser()
    {
        $result = $this->unit->show->GetUnits(\Game\Users\DonatedUser::class);

        $this->assertNotEmpty($result);
        $this->assertContains(\Game\Units\AllUnits\Common::class, $result);
        $this->assertContains(\Game\Units\AllUnits\HighUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\FreeUnit::class, $result);
    }

    public function testGetHeroesForVipUser()
    {
        $result = $this->unit->show->GetUnits(\Game\Users\VipUser::class);

        $this->assertNotEmpty($result);
        $this->assertContains(\Game\Units\AllUnits\Common::class, $result);
        $this->assertContains(\Game\Units\AllUnits\HighUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\FreeUnit::class, $result);
        $this->assertContains(\Game\Units\AllUnits\VipUnit::class, $result);
    }
}