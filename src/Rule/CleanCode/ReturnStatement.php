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
        $allowedChildren = $this->getStringProperty('allowedChildren');
        $allowedClasses = $this->getAllowedClasses($allowedChildren);
        $returnStatements = $node->findChildrenOfType('ReturnStatement');

        /** @var AbstractNode|ASTReturnStatement $returnStatement */
        foreach ($returnStatements as $returnStatement) {
            foreach ($returnStatement->getChildren() as $child) {
                $reflectChild = new \ReflectionClass($child);

                if (false === in_array($reflectChild->getShortName(), $allowedClasses)) {
                    $this->addViolation($returnStatement, [$allowedChildren]);
                }
            }
        }
    }

    /**
     * @param string $allowedChildren
     *
     * @return array
     */
    private function getAllowedClasses($allowedChildren)
    {
        $allowedClasses = explode($this->getStringProperty('delimiter'), $allowedChildren);

        foreach ($allowedClasses as &$allowedClass) {
            $allowedClass = 'AST'.$allowedClass;
        }

        return $allowedClasses;
    }
}

