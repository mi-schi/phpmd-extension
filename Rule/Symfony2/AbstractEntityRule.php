<?php

namespace MS\PHPMD\Rule\Symfony2;

use PDepend\Source\AST\ASTClass;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;

/**
 * Class AbstractEntityRule
 *
 * @package MS\PHPMD\Rule\Symfony2
 */
abstract class AbstractEntityRule extends AbstractRule implements ClassAware
{
    /**
     * @param ClassNode|ASTClass $node
     *
     * @return bool
     */
    protected function isEntity(ClassNode $node)
    {
        $docComment = $node->getDocComment();

        if (0 < preg_match($this->getStringProperty('classIsEntityRegex'), $docComment)) {
            return true;
        }

        if (true === $node->isAbstract()) {
            return false;
        }

        if (0 < preg_match($this->getStringProperty('entityRegex'), $docComment)) {
            return true;
        }

        return false;
    }
}
