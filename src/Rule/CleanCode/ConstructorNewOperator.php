<?php

namespace MS\PHPMD\Rule\CleanCode;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * Resolve strong dependency by simply inject the new instance via DI. So your class is more flexible.
 */
class ConstructorNewOperator extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $classReferences = $node->findChildrenOfType('ClassReference');

        if ('__construct' !== $node->getImage() || 0 === count($classReferences)) {
            return;
        }

        $allowedClassNames = explode($this->getStringProperty('delimiter'), $this->getStringProperty('allowedClassNames'));

        foreach ($classReferences as $classReference) {
            if (false === $this->containsClassName($classReference->getImage(), $allowedClassNames)) {
                $this->addViolation($classReference);
            }
        }
    }

    /**
     * @param string $className
     * @param array  $allowedClassNames
     *
     * @return bool
     */
    private function containsClassName($className, array $allowedClassNames)
    {
        foreach ($allowedClassNames as $allowedClassName) {
            if (false !== stripos($className, $allowedClassName)) {
                return true;
            }
        }

        return false;
    }
}
