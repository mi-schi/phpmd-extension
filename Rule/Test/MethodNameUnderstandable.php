<?php

namespace MS\PHPMD\Rule\Test;

use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;

/**
 * Class MethodNameUnderstandable
 *
 * The method names in your test should describe what they will check. This work only with a few more words.
 *
 * @package MS\PHPMD\Rule\Test
 */
class MethodNameUnderstandable extends AbstractTestRule
{
    /**
     * @param AbstractNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (!$node instanceof ClassNode) {
            return;
        }

        if (false === $this->isTest($node)) {
            return;
        }

        $match = $this->getBooleanProperty('match');
        $number = $this->getIntProperty('number');

        foreach ($node->getMethods() as $method) {
            $words = count(preg_split($match, $method->getImage()));

            if ($number > $words) {
                $this->addViolation($method, [$number, $words]);
            }
        }
    }
}
