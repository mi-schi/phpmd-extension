<?php

namespace MS\PHPMD\Rule\CleanCode;

use PDepend\Source\AST\ASTClass;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;

/**
 */
abstract class AbstractDataStructure extends AbstractRule implements ClassAware
{
    /**
     * @param ClassNode|ASTClass $node
     *
     * @return bool
     */
    protected function isDataStructure(ClassNode $node)
    {
        if (0 < preg_match($this->getStringProperty('dataStructureNamespaceRegex'), $node->getNamespaceName())) {
            return true;
        }

        if (0 < preg_match($this->getStringProperty('dataStructureCommentRegex'), $node->getComment())) {
            return true;
        }

        return false;
    }
}
