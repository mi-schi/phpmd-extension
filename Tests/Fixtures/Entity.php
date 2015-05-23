<?php

/**
 * Class Entity
 *
 * @Entity
 */
class Entity
{
    private $data;

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
        $this->doSimple();
    }

    /**
     * bad
     *
     * @return $this
     */
    public function doSimple()
    {
        return $this;
    }

    /**
     * bad
     */
    public function doMore()
    {
        foreach ($this->data as $data) {
            $this->doSimple();
        }
    }
}
