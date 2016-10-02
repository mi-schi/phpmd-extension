<?php

namespace AppBundle\Service;

class GoodReturner
{
    /**
     * good
     *
     * @return mixed
     */
    public function returnNiceThings()
    {
        return $this->doOtherThings()->getThings();
        return $this->value;
        return $this->variable->getOne();
        return $this->doOtherThings->getOne($this->returnNiceThings());
        return $this->getType()->doSomething(self::class);
        return $this->getType()->doSomething('1', [self::class]);
        return true;
        return is_array($a);
        return [];
        return;
        return self::CONSTANT;
        return CONSTANT::VALUE;
        return 10;
        return 'name';
        return null;
        return new GoodClass();
        return $data[$field];
        return (string) $this->name;
        return clone $this;
        return $object instanceOf OneClass;
    }
}
