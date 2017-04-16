<?php

namespace Game\Users;

final class DonatedUser
{
    public $name = 'DonatedUser';

    public $rang = 5;

    public $games = 130;

    public $winners = 80;

    public $losses = 30;

    public $draws = 20;

    /**
     * 0 - common user
     * 1 - donated user
     * 2 - Vip user
     * 3 - admin
     */
    public $status = 1;
}