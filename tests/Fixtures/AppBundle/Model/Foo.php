<?php

namespace AppBundle\Model;

/**
 * Class Foo
 */
class Foo
{
    /**
     * ok
     */
    public function doMore()
    {
    }

    /**
     * ok
     */
    public function doSomething()
    {
        $data = [];

        foreach ($data as $value) {
            $this->doMore();
        }
    }
}
