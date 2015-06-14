<?php

namespace MS\PHPMD\Rule\Test;

use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\ClassAware;
use PHPMD\AbstractNode;

/**
 * Class AbstractMethodNumberOf
 *
 * @package MS\PHPMD\Rule\CleanCode
 */
abstract class AbstractMethodNumberOf extends AbstractRule implements ClassAware
{
    /**
     * @param AbstractNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (!$node instanceof ClassNode) {
            return;
        }

        if (false === $this->isTest($node)) {
            return;
        }

        $number = $this->getIntProperty('number');
        $names = $this->getStringProperty('names');

        foreach ($node->getMethods() as $method) {
            $count = $this->count($method, $names);

            if ($number < $count) {
                $this->addViolation($method, [$count, $number]);
            }
        }
    }

    /**
     * @param ClassNode $node
     *
     * @return bool
     */
    private function isTest(ClassNode $node)
    {
        if ('Test' === substr($node->getImage(), -4, 4)) {
            return true;
        }

        return false;
    }

    /**
     * @param MethodNode $node
     * @param string     $names
     *
     * @return int
     */
    private function count(MethodNode $node, $names)
    {
        $count = 0;
        $methodPostfixes = $node->findChildrenOfType('MethodPostfix');

        foreach ($methodPostfixes as $methodPostfix) {
            if (false !== strpos($names, $methodPostfix->getImage())) {
                $count++;
            }
        }

        return $count;
    }
}
