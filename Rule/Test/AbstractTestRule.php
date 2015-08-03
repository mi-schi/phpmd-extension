<?php

namespace MS\PHPMD\Rule\Test;

use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;
use PHPMD\Node\ClassNode;

/**
 * Class AbstractTestRule
 *
 * @package MS\PHPMD\Rule\Test
 */
abstract class AbstractTestRule extends AbstractRule implements ClassAware
{
    /**
     * @param ClassNode $node
     *
     * @return bool
     */
    protected function isTest(ClassNode $node)
    {
        if ('Test' === substr($node->getImage(), -4, 4)) {
            return true;
        }

        return false;
    }
}
