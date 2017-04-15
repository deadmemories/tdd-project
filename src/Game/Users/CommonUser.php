<?php

namespace Game\Users;

final class CommonUser
{
    public const NAME = 'CommonUser';

    public const RANG = 2;

    public const GAMES = 50;

    public const WINNERS = 20;

    public const LOSSES = 20;

    public const DRAWS = 100;

    /**
     * 0 - common user
     * 1 - donated user
     * 2 - Vip user
     * 3 - admin
     */
    public const STATUS = 0;
}