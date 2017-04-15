<?php

namespace Game\Users;

final class VipUser
{
    public const NAME = 'VipUser';

    public const RANG = 4;

    public const GAMES = 80;

    public const WINNERS = 40;

    public const LOSSES = 40;

    public const DRAWS = 0;

    /**
     * 0 - common user
     * 1 - donated user
     * 2 - Vip user
     * 3 - admin
     */
    public const STATUS = 3;
}