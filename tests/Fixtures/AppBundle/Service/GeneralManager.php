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
     * @return mixed
     */
    public function doOtherThings()
    {
        return $this->doSomething() && !$this->doAnything();
        return 1 > count($this->returnOkThings());
        return $object instanceOf OneClass;
        return new GoodClass();
    }

    /**
     * good
     *
     * @return mixed
     */
    public function returnNiceThings()
    {
        return $this->doOtherThings()->getThings();
        return $this->doOtherThings($this->returnNiceThings());
        return true;
        return is_array($a);
        return [];
        return $this->getThings()->doThings()->doSomething();
        return;
        return self::CONSTANT;
        return CONSTANT::VALUE;
        return 10;
        return 'name';
        return $this->value;
        return null;
    }
}
