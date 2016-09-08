<?php

namespace MS\PHPMD\Rule\CleanCode;

use MS\PHPMD\Guesser\TestGuesser;
use PDepend\Source\AST\ASTMemberPrimaryPrefix;
use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;

/**
 * Don't chain methods excessively. The code becomes hard to test and violate the law of demeter.
 */
class MemberPrimaryPrefix extends AbstractRule implements ClassAware
{
    use TestGuesser;

    /**
     * @param AbstractNode|ClassNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (true === $this->isTest($node)) {
            return;
        }

        $maxChainCount = $this->getIntProperty('maxChainCount');
        $allowedPrefixes = explode($this->getStringProperty('delimiter'), $this->getStringProperty('allowedPrefixes'));

        foreach ($node->getMethods() as $method) {
            foreach ($method->findChildrenOfType('MemberPrimaryPrefix') as $memberPrimaryPrefix) {
                if (false === $this->hasMethodsChainAllowedPrefixes($memberPrimaryPrefix, $allowedPrefixes) && true === $this->isMethodsChainExcessively($memberPrimaryPrefix, $maxChainCount)) {
                    $this->addViolation($memberPrimaryPrefix, [$maxChainCount]);
                }
            }
        }
    }

    /**
     * @param AbstractNode $memberPrimaryPrefix
     * @param array        $allowedPrefixes
     *
     * @return bool
     */
    private function hasMethodsChainAllowedPrefixes(AbstractNode $memberPrimaryPrefix, array $allowedPrefixes)
    {
        $methodPostfixes = $memberPrimaryPrefix->findChildrenOfType('MethodPostfix');

        foreach ($methodPostfixes as $methodPostfix) {
            foreach ($allowedPrefixes as $allowedPrefix) {
                if ($allowedPrefix === substr($methodPostfix->getName(), 0, strlen($allowedPrefix))) {
                    continue 2;
                }
            }

            return false;
        }

        return true;
    }

    /**
     * @param AbstractNode $memberPrimaryPrefix
     * @param int          $chainCount
     *
     * @return bool
     */
    private function isMethodsChainExcessively(AbstractNode $memberPrimaryPrefix, $chainCount)
    {
        for ($chain = 0; $chain < $chainCount; $chain++) {
            $children = $memberPrimaryPrefix->getChildren();

            if (false === isset($children[1]) || !$children[1] instanceof ASTMemberPrimaryPrefix) {
                return false;
            }

            $memberPrimaryPrefix = $children[1];
        }

        return true;
    }
}
