<?php

namespace AppBundle\Service;

class SingleService
{
    private $variable25percent;

    private $variable50percent;

    private $variable75percent;

    public function doSomething($variable25percent)
    {
        $this->variable25percent = $this->variable50percent;

        if ($this->variable50percent && $this->variable75percent) {
            $this->variable25percent = 1;
        }
    }

    public function doOtherThings()
    {
        $this->variable50percent;
    }

    public function getData()
    {
        $this->variable75percent;
    }

    public function getType()
    {
        return $this->variable75percent;
    }
}
