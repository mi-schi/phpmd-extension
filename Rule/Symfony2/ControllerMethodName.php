<?php

namespace MS\PHPMD\Rule\Symfony2;

use PDepend\Source\AST\ASTClass;
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
     * @param AbstractNode|ClassNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (false === $this->isController($node)) {
            return;
        }

        $allowedMethodNames = explode($this->getStringProperty('delimiter'), $this->getStringProperty('allowedMethodNames'));

        /** @var MethodNode $method */
        foreach ($node->getMethods() as $method) {
            // Check if method is whitelisted
            if (true === in_array($method->getImage(), $allowedMethodNames)) {
              continue;
            }

            if ('Action' !== substr($method->getImage(), -6, 6)) {
                $this->addViolation($method);
            }
        }
    }

    /**
     * @param ClassNode|ASTClass $node
     *
     * @return bool
     */
    private function isController(ClassNode $node)
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
