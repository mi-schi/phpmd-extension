<?php

namespace AppBundle\Service;

/**
 * Class SuperfluousComment
 *
 * @package AppBundle\Service
 */
class SuperfluousComment
{
    /**
     * @var string
     *
     * the name
     */
    private $name;

    /**
     * get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * set the name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $value
     */
    public function doSomething($value)
    {
    }
}
