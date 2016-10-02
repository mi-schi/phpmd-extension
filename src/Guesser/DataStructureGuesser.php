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
        if (!preg_match($this->getRegex('dataStructureNamespaceRegex'), $node->getNamespaceName())) {
            return false;
        }

        if (!preg_match($this->getRegex('dataStructureClassNameRegex'), $node->getName())) {
            return false;
        }

        return true;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    abstract protected function getRegex($name);
}
