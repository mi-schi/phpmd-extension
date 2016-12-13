<?php

namespace MS\PHPMD\Rule\Naming;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * When the class is concrete and ends with Controller, the method names have to end with Action.
 */
class ControllerMethodName extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (false === $this->isController($node->getParentType())) {
            return;
        }

        $allowedMethodNames = explode($this->getStringProperty('delimiter'), $this->getStringProperty('allowedMethodNames'));

        if (true === in_array($node->getImage(), $allowedMethodNames)) {
            return;
        }

        if ('Action' !== substr($node->getImage(), -6, 6)) {
            $this->addViolation($node);
        }
    }

    /**
     * @param AbstractNode $node
     *
     * @return bool
     */
    private function isController(AbstractNode $node)
    {
        if (false === $node instanceof ClassNode) {
            return false;
        }

        if (true === $node->isAbstract()) {
            return false;
        }

        if ('Controller' === substr($node->getImage(), -10, 10)) {
            return true;
        }

        return false;
    }
}
