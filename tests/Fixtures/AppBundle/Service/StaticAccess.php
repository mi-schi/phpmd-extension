<?php

namespace AppBundle\Service;

class StaticAccess
{
    private static $users = [
        'Hupa',
        'Lumpa'
    ];

    private $service;

    public function getUsers()
    {
        return self::$users;
    }
}
