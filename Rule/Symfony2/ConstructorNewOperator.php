<?php

namespace MS\PHPMD\Rule\Symfony2;

use PDepend\Source\AST\ASTNode;
use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * Class ConstructorNewOperator
 *
 * Resolve strong dependency by simply inject the new instance via DI. So your class is more flexible.
 *
 * @package MS\PHPMD\Rule\Symfony2
 */
class ConstructorNewOperator extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $classReferences = $node->findChildrenOfType('ClassReference');

        if ('__construct' === $node->getImage() && 0 < count($classReferences) && false === $this->isClassNameAllowed($classReferences)) {
            $this->addViolation($node);
        }
    }

    /**
     * @param ASTNode[] $classReferences
     *
     * @return bool
     */
    private function isClassNameAllowed(array $classReferences)
    {
        $allowedClassNames = explode($this->getStringProperty('delimiter'), $this->getStringProperty('allowedClassNames'));

        foreach ($classReferences as $classReference) {
            if (false === in_array($classReference->getImage(), $allowedClassNames)) {
                return false;
            }
        }

        return true;
    }
}
