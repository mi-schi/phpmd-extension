<?php

namespace MS\PHPMD\Rule\Symfony2;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\ClassAware;

/**
 * Class ControllerMethodName
 *
 * When the class is concrete and ends with Controller, the method names have to end with Action.
 *
 * @package PHPMD\Rule\Symfony2
 */
class ControllerMethodName extends AbstractRule implements ClassAware
{
    /**
     * @param AbstractNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (!$node instanceof ClassNode) {
            return;
        }

        if (false === $this->isController($node)) {
            return;
        }

        /** @var MethodNode $method */
        foreach ($node->getMethods() as $method) {
            if ('Action' !== substr($method->getImage(), -6, 6)) {
                $this->addViolation($method, array($method->getImage()));
            }
        }
    }

    /**
     * @param AbstractNode $node
     *
     * @return bool
     */
    private function isController(AbstractNode $node)
    {
        if (true === $node->isAbstract()) {
            return false;
        }

        if ('Controller' === substr($node->getImage(), -10, 10)) {
            return true;
        }

        return false;
    }
}
