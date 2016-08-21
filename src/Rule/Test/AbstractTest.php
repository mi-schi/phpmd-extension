<?php

namespace MS\PHPMD\Rule\Test;

use MS\PHPMD\Guesser\TestGuesser;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;

/**
 */
abstract class AbstractTest extends AbstractRule implements ClassAware
{
    use TestGuesser;
}
