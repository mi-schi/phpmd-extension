<?php

namespace MS\PHPMD\Guesser;

use PHPMD\Node\ClassNode;

/**
 */
trait TestGuesser
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
