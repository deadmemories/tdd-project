<?php

namespace Game\Users;

final class CommonUser
{
    public $name = 'CommonUser';

    public $rang = 2;

    public $games = 50;

    public $winners = 20;

    public $losses  = 20;

    public $draws = 100;

    /**
     * 0 - common user
     * 1 - donated user
     * 2 - Vip user
     * 3 - admin
     */
    public $status = 0;
}