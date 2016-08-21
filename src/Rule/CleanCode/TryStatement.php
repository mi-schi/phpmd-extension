<?php

namespace MS\PHPMD\Rule\CleanCode;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * Methods should only have one try statement. If not, swap out the try statement in an extra method. It increase the readability.
 */
class TryStatement extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $countTry = count($node->findChildrenOfType('TryStatement'));

        if (1 < $countTry) {
            $this->addViolation($node);
        }

        if (1 === $countTry &&  true === $this->hasNotAllowedChildren($node)) {
            $this->addViolation($node);
        }
    }

    /**
     * @param MethodNode $node
     *
     * @return bool
     */
    private function hasNotAllowedChildren(MethodNode $node)
    {
        $children = $node->findChildrenOfType('ScopeStatement');

        $allowedChildren = explode(
            $this->getStringProperty('delimiter'),
            $this->getStringProperty('allowedChildren')
        );

        /** @var AbstractNode $child */
        foreach ($children as $child) {
            if (true === in_array($child->getImage(), $allowedChildren) || true === $this->isChildOfTry($child)) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * @param AbstractNode $node
     *
     * @return bool
     */
    private function isChildOfTry(AbstractNode $node)
    {
        $parent = $node->getParent();

        while (is_object($parent)) {
            if ($parent->isInstanceOf('TryStatement')) {
                return true;
            }

            $parent = $parent->getParent();
        }

        return false;
    }
}
