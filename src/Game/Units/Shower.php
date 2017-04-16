<?php

namespace Game\Units;

use Game\Exceptions\Units\ShowerException;

use Game\Units\AllUnits\CommonUnit;
use Game\Units\AllUnits\FreeUnit;
use Game\Units\AllUnits\HighUnit;
use Game\Units\AllUnits\VipUnit;


class Shower
{
    /**
     * @var array
     */
    public $allUnits = [
        'common' => [
            'class' => CommonUnit::class,
            'permission' => [
                Shower::COMMON,
                Shower::DONATED,
                Shower::VIP,
                Shower::ADMIN,
            ],
        ],
        'free' => [
            'class' => FreeUnit::class,
            'permission' => [
                Shower::COMMON,
                Shower::DONATED,
                Shower::VIP,
                Shower::ADMIN,
            ],
        ],
        'high' => [
            'class' => HighUnit::class,
            'permission' => [
                Shower::DONATED,
                Shower::VIP,
                Shower::ADMIN,
            ],
        ],
        'vip' => [
            'class' => VipUnit::class,
            'permission' => [
                Shower::VIP,
                Shower::ADMIN,
            ],
        ],
    ];

    public const COMMON = 0;
    public const DONATED = 1;
    public const VIP = 2;
    public const ADMIN = 3;

    /**
     * @param $user
     * @return array
     * @throws ShowerException
     */
    public function getUnits($user): array
    {
        $user = new $user;

        if (! $user->status &&
            (0 < self::COMMON) && (self::ADMIN < $user->status)
        ) {
            throw new ShowerException('Incorrect status');
        }

        return $this->getUnitsWithPermission($user->status);
    }

    /**
     * @param int $status
     * @return array
     */
    private function getUnitsWithPermission(int $status): array
    {
        $result = [];

        foreach ( $this->allUnits as $k => $v ) {
            foreach ( $v['permission'] as $int ) {
                if ( $status == $int ) {
                    $result[] = $v['class'];
                }
            }
        }

        return $result;
    }
}