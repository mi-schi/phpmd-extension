<?php

namespace AppBundle\Service;

/**
 * Class GeneralManager
 */
class GeneralManager
{
    /**
     * bad
     *
     * @return int|string
     */
    public function getData()
    {
        return 1 === 1 ? '1' : 2;
    }

    /**
     * bad
     *
     * @return bool
     */
    public function doAnything()
    {
        $a = 1 === 2 ? true : false;

        return $a;
    }

    /**
     * bad
     *
     * @return bool
     */
    public function doOtherThings()
    {
        return $this->doSomething() && !$this->doAnything();
    }
}
