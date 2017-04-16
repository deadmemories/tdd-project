<?php

namespace Game\Users;

final class VipUser
{
    public $name = 'VipUser';

    public $rang = 4;

    public $games = 80;

    public $winners = 40;

    public $losses = 40;

    public $draws = 0;

    /**
     * 0 - common user
     * 1 - donated user
     * 2 - Vip user
     * 3 - admin
     */
    public $status = 3;
}