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
     *
     */
    public function chainingGood()
    {
        $this->variable->getOne();
        $this->doOtherThings()->getThings();
        $this->doOtherThings->getOne($this->returnNiceThings());
        $this->getType()->doSomething(self::class);
        $this->getType()->doSomething('1', [self::class]);
        $this->add($data)->add($data)->setData($data)->addOne($one);
    }

    /**
     *
     */
    public function chainingBad()
    {
        $this->getThings()->doThings()->doSomething();
    }
}
