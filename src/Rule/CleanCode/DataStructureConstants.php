<?php

namespace MS\PHPMD\Rule\CleanCode;

use MS\PHPMD\Guesser\TestGuesser;
use PDepend\Source\AST\ASTClass;
use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;

/**
 * Don't contain constants in your data structure. Important information are distribute throughout the project.
 * You reduce the reusability.
 */
class DataStructureConstants extends AbstractDataStructure
{
    use TestGuesser;

    /**
     * @param AbstractNode|ClassNode|ASTClass $node
     */
    public function apply(AbstractNode $node)
    {
        if (false === $this->isDataStructure($node) || true === $this->isTest($node)) {
            return;
        }

        if (0 !== count($node->getConstants())) {
            $this->addViolation($node);
        }
    }
}
