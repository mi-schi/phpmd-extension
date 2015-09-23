<?php

namespace MS\PHPMD\Rule\Symfony2;

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
        if ('__construct' === $node->getImage() && 0 < count($node->findChildrenOfType('ClassReference'))) {
            $this->addViolation($node);
        }
    }
}
