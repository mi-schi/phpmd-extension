<?php

namespace MS\PHPMD\Rule\CleanCode;

use PDepend\Source\AST\ASTMethod;
use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Node\TraitNode;
use PHPMD\Rule\MethodAware;

/**
 * The purpose of a trait should be the reuse of methods which help the basic classes.
 * Make your code clearly and define interfaces of your class as public methods.
 */
class TraitPublicMethod extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode|ASTMethod $node
     */
    public function apply(AbstractNode $node)
    {
        if ($node->getParentType() instanceof TraitNode && true === $node->isPublic()) {
            $this->addViolation($node);
        }
    }
}
