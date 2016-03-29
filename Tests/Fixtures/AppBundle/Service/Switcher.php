<?php

namespace AppBundle\Service;

/**
 * Class Switcher
 */
class Switcher
{
    /**
     * @param string $type
     *
     * @return string
     */
    public function getType($type)
    {
        switch ($type) {
            case 'one':
                return 'one';
                break;
            case 'two':
                return 'two';
                break;
        }
    }
} 