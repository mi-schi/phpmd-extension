<?php

namespace MS\PHPMD\Guesser;

use PDepend\Source\AST\ASTClass;
use PHPMD\Node\ClassNode;

/**
 */
trait DataStructureGuesser
{
    /**
     * @param ClassNode|ASTClass $node
     *
     * @return bool
     */
    protected function isDataStructure(ClassNode $node)
    {
        if (0 < preg_match($this->getRegex('dataStructureNamespaceRegex'), $node->getNamespaceName())) {
            return true;
        }

        if (0 < preg_match($this->getRegex('dataStructureCommentRegex'), $node->getComment())) {
            return true;
        }

        return false;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    abstract protected function getRegex($name);
}
