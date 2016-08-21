<?php

namespace MS\PHPMD\Rule\CleanCode;

use MS\PHPMD\Guesser\DataStructureGuesser;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;

/**
 */
abstract class AbstractDataStructure extends AbstractRule implements ClassAware
{
    use DataStructureGuesser;

    /**
     * @param string $name
     *
     * @return string
     */
    protected function getRegex($name)
    {
        return $this->getStringProperty($name);
    }
}
