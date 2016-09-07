<?php

namespace AppBundle\Entity;

/**
 * Class Foo
 *
 * @Entity
 */
class Foo extends FooAssociation
{
    /**
     * bad
     */
    const SPECIAL_ID = 1;

    private $data;

    /**
     * on whitelist
     */
    public function __construct()
    {
        $this->doSomething();
    }

    /**
     * @param mixed $data
     *
     * good
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * good
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * good
     *
     * @param mixed $data
     */
    public function addData($data)
    {
        $this->data->add($data);
    }

    /**
     * @param mixed $data
     *
     * good
     *
     * @return $this
     */
    public function removeData($data)
    {
        $this->data->remove($data);

        return $this;
    }

    /**
     * bad
     *
     * @param mixed $data
     */
    public function setDataExtra($data)
    {
        $this->data = $data;
        $this->doSimpleExtra();
    }

    /**
     * bad
     *
     * @return mixed
     */
    public function doSimple()
    {
        return $this->data;
    }

    /**
     * bad
     *
     * @return $this
     */
    public function setSome()
    {
        if (1 == 1) {

        }

        return $this;
    }

    /**
     * bad
     */
    public function setMore()
    {
        foreach ($this->data as $data) {
            $this->doSimple();
        }
    }

    /**
     * good
     */
    public function addType($type)
    {
        $type->setFoo($this);
        $this->types->add($type);
    }

    /**
     * @param mixed $data
     *
     * good
     *
     * @return $this
     */
    public function setData2($data)
    {
        $this->data = $data;
        $data->setFoo($this);

        return $this;
    }
}
