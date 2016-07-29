<?php

namespace AppBundle\Service;

/**
 * Class UserConverter
 *
 * @package AppBundle\Service
 */
class UserConverter
{
    /**
     * inject the reader via DI
     */
    public function __construct()
    {
        $reader = new Reader();

        // this is ok
        $datetime = new \DateTime();
        $collection = new ArrayCollection();
    }

    /**
     * might be ok
     */
    public function doThings()
    {
        $reader = new Reader();
    }
}
