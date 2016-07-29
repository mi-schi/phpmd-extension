<?php

namespace MS\PHPMD\Rule\Naming;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * Try to avoid meaningless method names. You or other developers don't understand what the method does in a few month.
 */
class MethodName extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $meaninglessNames = $this->getStringProperty('meaninglessNames');
        $delimiter = $this->getStringProperty('delimiter');
        $methodName = $node->getImage();

        if (in_array(strtolower($methodName), explode($delimiter, strtolower($meaninglessNames)))) {
            $this->addViolation($node, [$methodName, $meaninglessNames]);
        }
    }
}
