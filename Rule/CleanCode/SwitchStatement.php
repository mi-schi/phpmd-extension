<?php

namespace MS\PHPMD\Rule\CleanCode;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * Class SwitchStatement
 *
 * Try to avoid using switch-case statements. Use polymorphism instead.
 *
 * @package MS\PHPMD\Rule\CleanCode
 */
class SwitchStatement extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $switchStatements = $node->findChildrenOfType('SwitchStatement');

        foreach ($switchStatements as $switchStatement) {
            $this->addViolation($switchStatement);
        }
    }
} 