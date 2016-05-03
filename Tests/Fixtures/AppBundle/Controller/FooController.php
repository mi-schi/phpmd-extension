<?php

namespace AppBundle\Controller;

/**
 * Class FooController
 */
class FooController extends AbstractFooController
{
    /**
    * @var string
    */
    protected $foo;

    /**
    * @param string $bar
    */
    public function __construct($bar = 'just an example') {
        $this->foo = $bar;
    }

    /**
     * good
     */
    public function barAction()
    {
        //
    }

    /**
     * bad
     */
    public function doSomething()
    {
        //
    }
}
