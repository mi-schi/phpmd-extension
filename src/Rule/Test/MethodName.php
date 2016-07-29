<?php

namespace MS\PHPMD\Rule\Test;

use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;

/**
 * The method name in your test should describe what they will check. This works only with a few more words.
 */
class MethodName extends AbstractTest
{
    /**
     * @param AbstractNode|ClassNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (false === $this->isTest($node)) {
            return;
        }

        $regex = $this->getStringProperty('regex');
        $number = $this->getIntProperty('number');

        foreach ($node->getMethods() as $method) {
            if ('test' !== substr($method->getImage(), 0, 4)) {
                continue;
            }

            $wordsInclusiveTest = count(preg_split($regex, $method->getImage()));
            $words = $wordsInclusiveTest - 1;

            if ($number > $words) {
                $this->addViolation($method, [$words, $number]);
            }
        }
    }
}
