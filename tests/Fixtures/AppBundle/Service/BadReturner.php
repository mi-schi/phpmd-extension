<?php

namespace AppBundle\Service;

class BadReturner
{
    /**
     * UnaryExpression: !
     *
     * @return bool
     */
    public function notSupports()
    {
        return !$object instanceOf OneClass;
    }

    /**
     * BooleanAndExpression: &&
     *
     * @return bool
     */
    public function getComplexAnd()
    {
        return $object instanceOf OneClass && count($data);
    }

    /**
     * BooleanOrExpression: ||
     *
     * @return bool
     */
    public function getComplexOr()
    {
        return $object instanceOf OneClass || count($data);
    }
}
