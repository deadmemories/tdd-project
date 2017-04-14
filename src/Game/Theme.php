<?php

namespace Game;

use Game\Exceptions\Theme\IncorrectLogicType;

class Theme
{
    public $default = 'Default theme';

    public $themes = ['Good', 'His', 'Beautiful', 'My'];

    public const RETURN_BOOL_ONLY = 0;
    public const RETURN_WITH_EACH = 1;
    public const RETURN_WITH_TRUE = 2;
    public const RETURN_WITH_FALSE = 3;

    public function has($themes, $logic = self::RETURN_BOOL_ONLY)
    {
        if (is_string($themes)) {
            if (! $this->logicIsCorrect($logic, 0)) {
                throw new \IncorrectLogicType('For string you can choose only RETURN_BOOL_ONLY');
            }

            return $this->hasThemeString($themes);
        } elseif (is_array(($themes))) {
            if (! $this->logicIsCorrect($logic, [1, 2, 3])) {
                throw new IncorrectLogicType('Incorrect logic for returns');
            }

            return $this->hasThemesArray($themes, $logic);
        }

        throw new \IncorrectLogicType('Incorrect type. Themes can be string or array only');
    }

    /**
     * @param string $theme
     * @return bool
     */
    private function hasThemeString(string $theme): bool
    {
        return in_array($theme, $this->themes);
    }

    /**
     * @param array $themes
     * @param int $logic
     * @return array|bool
     */
    private function hasThemesArray(array $themes, int $logic)
    {
        switch ($logic) {
            case self::RETURN_BOOL_ONLY:
                return $this->hasThemesArrayBoolOnly($themes);
                break;
            case self::RETURN_WITH_EACH:
                return $this->hasThemesWithEach($themes);
                break;
            case self::RETURN_WITH_TRUE:
                return $this->hasThemesWithTrueOnly($themes);
                break;
            case self::RETURN_WITH_FALSE:
                return $this->hasThemesWithFalseOnly($themes);
                break;
        }
    }

    /**
     * @param array $themes
     * @return bool
     */
    private function hasThemesArrayBoolOnly(array $themes): bool
    {
        foreach ($themes as $k) {
            if (! array_key_exists($k, $this->themes)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $themes
     * @return array
     */
    private function hasThemesWithEach(array $themes): array
    {
        $array = [];

        foreach ($themes as $k) {
            if (in_array($k, $this->themes)) {
                $array[$k] = true;
            } else {
                $array[$k] = false;
            }
        }

        return $array;
    }

    /**
     * @param array $themes
     * @return array
     */
    private function hasThemesWithTrueOnly(array $themes): array
    {
        $array = [];

        foreach ($themes as $k) {
            if (in_array($k, $this->themes)) {
                $array[] = $k;
            }
        }

        return $array;
    }

    /**
     * @param array $themes
     * @return array
     */
    private function hasThemesWithFalseOnly(array $themes): array
    {
        $array = [];

        foreach ($themes as $k) {
            if (! in_array($k, $this->themes)) {
                $array[] = $k;
            }
        }

        return $array;
    }

    /**
     * @param int $logic
     * @param $correct
     * @return bool
     */
    private function logicIsCorrect(int $logic, $correct): bool
    {
        if (is_integer($correct)) {
            if ($logic == $correct) {
                return true;
            } else {
                return false;
            }
        } elseif (is_array($correct)) {
            foreach ($correct as $k) {
                if ($k == $logic) {
                    return true;
                }
            }
        }

        return false;
    }
}