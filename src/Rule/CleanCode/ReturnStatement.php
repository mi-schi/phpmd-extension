<?php

namespace MS\PHPMD\Rule\CleanCode;

use PDepend\Source\AST\ASTReturnStatement;
use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * To easy understand a return statement line, it should only have simple allocations.
 * Don't write your logical code in the return line.
 */
class ReturnStatement extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $forbiddenChildTypes = explode(
            $this->getStringProperty('delimiter'),
            $this->getStringProperty('forbiddenChildren')
        );

        /** @var AbstractNode|ASTReturnStatement $returnStatement */
        foreach ($node->findChildrenOfType('ReturnStatement') as $returnStatement) {
            foreach ($forbiddenChildTypes as $forbiddenChildType) {
                $child = $returnStatement->getFirstChildOfType($forbiddenChildType);

                if (null === $child) {
                    continue;
                }

                $reflectChild = new \ReflectionClass($child->getNode());

                if ('AST' . $forbiddenChildType === $reflectChild->getShortName()) {
                    $this->addViolation($returnStatement, [$forbiddenChildType]);
                }
            }
        }
    }
}

