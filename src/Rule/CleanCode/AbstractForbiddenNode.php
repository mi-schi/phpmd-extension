<?php

namespace MS\PHPMD\Rule\CleanCode;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 */
abstract class AbstractForbiddenNode extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $forbiddenNodes = $node->findChildrenOfType($this->getTypeName());

        foreach ($forbiddenNodes as $forbiddenNode) {
            $this->addViolation($forbiddenNode);
        }
    }

    /**
     * @return string
     */
    abstract protected function getTypeName();
}
