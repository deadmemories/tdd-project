<?php

require __DIR__.'../bootstrap.php';

use PHPUnit\Framework\TestCase;

class ThemeTest extends TestCase
{
    protected $theme;

    public function setUp()
    {
        $this->theme = new \Game\Theme();
    }

    public function testDefaultTheme()
    {
        $this->assertEquals('Default theme', $this->theme->default);
    }

    public function themesForTestWithEachFalse()
    {
        return [
            [
                [
                    'My',
                    'My2',
                    'Beautiful',
                ],
            ],
        ];
    }

    public function themesForTestWithEachTrue()
    {
        return [
            [
                [
                    'His',
                    'His2',
                    'Bad',
                ],
            ],
        ];
    }

    public function themeForTestWitFalse()
    {
        return [
            ['Shit'],
        ];
    }

    public function themeForTestWithTrue()
    {
        return [
            ['Good'],
        ];
    }

    public function themesForTestWithOneTypeOnly()
    {
        return [
            [
                [
                    'Her',
                    'His',
                    'Bad',
                    'Beautiful'
                ],
            ],
        ];
    }

    /**
     * @dataProvider themesForTestWithEachFalse
     * @param array $themes
     */
    public function testHasThemesWithEachFalse(array $themes)
    {
        $result = $this->theme->has($themes, \Game\Theme::RETURN_WITH_EACH);

        $this->assertNotEmpty($result);
        $this->assertTrue($result['My']);
        $this->assertTrue($result['Beautiful']);
        $this->assertFalse($result['My2']);
    }

    /**
     * @dataProvider themesForTestWithEachFalse
     * @param array $themes
     */
    public function testHasThemesWithEachFalseThrow(array $themes)
    {
        $this->expectException(\Game\Exceptions\Theme\IncorrectLogicType::class);
        $this->theme->has($themes, \Game\Theme::RETURN_BOOL_ONLY);
    }

    /**
     * @dataProvider themeForTestWitFalse
     * @param string $theme
     */
    public function testHasNoThemeStringOfClass(string $theme)
    {
        $this->assertFalse($this->theme->has($theme));
    }

    /**
     * @dataProvider themeForTestWithTrue
     * @param string $theme
     */
    public function testHasThemeStringOfClass(string $theme)
    {
        $this->assertTrue($this->theme->has($theme));
    }

    /**
     * @dataProvider themesForTestWithOneTypeOnly
     * @param array $themes
     */
    public function testReturnsHasThemesOnly(array $themes)
    {
        $result = $this->theme->has($themes, \Game\Theme::RETURN_WITH_TRUE);

        $this->assertNotEmpty($result);
        $this->assertContains('His', $result);
        $this->assertContains('Beautiful', $result);
    }

    /**
     * @dataProvider themesForTestWithOneTypeOnly
     * @param array $themes
     */
    public function testReturnsHasNoThemesOnly(array $themes)
    {
        $result = $this->theme->has($themes, \Game\Theme::RETURN_WITH_FALSE);

        $this->assertNotEmpty($result);
        $this->assertContains('Her', $result);
        $this->assertContains('Bad', $result);
    }
}
