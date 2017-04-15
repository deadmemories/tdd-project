<?php

namespace Game\Users;

final class DonatedUser
{
    public const NAME = 'DonatedUser';

    public const RANG = 5;

    public const GAMES = 130;

    public const WINNERS = 80;

    public const LOSSES = 30;

    public const DRAWS = 20;

    /**
     * 0 - common user
     * 1 - donated user
     * 2 - Vip user
     * 3 - admin
     */
    public const STATUS = 1;
}