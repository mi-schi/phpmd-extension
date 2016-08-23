<?php

namespace MS\PHPMD\Rule\CleanCode;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;

/**
 * Try to avoid public class variables. Use Getter to access the variable.
 */
class PublicFieldDeclaration extends AbstractRule implements ClassAware
{
    /**
     * @param AbstractNode|ClassNode $node
     */
    public function apply(AbstractNode $node)
    {
        foreach ($node->findChildrenOfType('FieldDeclaration') as $field) {
            if (true === $field->isPublic()) {
                $this->addViolation($field);
            }
        }
    }
}
