<?php

namespace AppBundle\Utility;

/**
 * Class Maybe
 */
class Maybe
{
    /**
     * good
     */
    public function itWorks()
    {
        try {
        } catch (Exception $exception) {
        }
    }

    /**
     * good
     */
    public function itWorks2()
    {
        try {
            $this->tryMore();
            if (2 === 2) {

            }
        } catch (Exception $exception) {
        } catch (Exception $exception) {
        } finally {
        }
    }

    /**
     * bad
     */
    public function tryMore()
    {
        try {
        } catch (Exception $exception) {
        }

        try {
        } catch (Exception $exception) {
        }
    }

    /**
     * bad
     */
    public function tryOther()
    {
        $this->doSomething();

        try {
            $data = 'make';
        } catch (Exception $exception) {
        }

        if (1 === 1) {
            $data = 'truth';
        }
    }
}
