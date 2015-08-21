<?php

namespace MS\PHPMD\Rule\Symfony2;

use PDepend\Source\AST\ASTClass;
use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;

/**
 * Class EntityConstants
 *
 * Don't contain constants in your entity. Important information are distribute throughout the project. You reduce the reusability.
 *
 * @package MS\PHPMD\Rule\Symfony2
 */
class EntityConstants extends AbstractEntityRule
{
    /**
     * @param AbstractNode|ClassNode|ASTClass $node
     */
    public function apply(AbstractNode $node)
    {
        if (false === $this->isEntity($node)) {
            return;
        }

        if (0 !== count($node->getConstants())) {
            $this->addViolation($node);
        }
    }
}
