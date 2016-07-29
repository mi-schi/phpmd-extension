<?php

namespace MS\PHPMD\Rule\CleanCode;

use PDepend\Source\AST\ASTClass;
use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;

/**
 * Don't contain constants in your data structure. Important information are distribute throughout the project.
 * You reduce the reusability.
 */
class DataStructureConstants extends AbstractDataStructure
{
    /**
     * @param AbstractNode|ClassNode|ASTClass $node
     */
    public function apply(AbstractNode $node)
    {
        if (false === $this->isDataStructure($node)) {
            return;
        }

        if (0 !== count($node->getConstants())) {
            $this->addViolation($node);
        }
    }
}
