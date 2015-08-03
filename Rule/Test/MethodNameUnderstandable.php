<?php

namespace MS\PHPMD\Rule\Test;

use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;

/**
 * Class MethodNameUnderstandable
 *
 * The method name in your test should describe what they will check. This works only with a few more words.
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

        $regex = $this->getStringProperty('regex');
        $number = $this->getIntProperty('number');

        foreach ($node->getMethods() as $method) {
            $wordsInclusiveTest = count(preg_split($regex, $method->getImage()));
            $words = $wordsInclusiveTest - 1;

            if ($number > $words) {
                $this->addViolation($method, [$words, $number]);
            }
        }
    }
}
