<?php

namespace MS\PHPMD\Rule\CleanCode;

use MS\PHPMD\Guesser\TestGuesser;
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

        foreach ($node->getMethods() as $method) {
            foreach ($method->findChildrenOfType('MemberPrimaryPrefix') as $memberPrimaryPrefix) {
                if (null !== $this->getMemberPrimaryPrefixWithChainCount($memberPrimaryPrefix, $maxChainCount)) {
                    $this->addViolation($memberPrimaryPrefix, [$maxChainCount]);
                }
            }
        }
    }

    /**
     * @param AbstractNode $memberPrimaryPrefix
     * @param int          $chainCount
     *
     * @return null|AbstractNode
     */
    private function getMemberPrimaryPrefixWithChainCount(AbstractNode $memberPrimaryPrefix, $chainCount)
    {
        for ($chain = 0; $chain < $chainCount; $chain++) {
            if (null === $memberPrimaryPrefix) {
                return null;
            }

            $memberPrimaryPrefix = $memberPrimaryPrefix->getFirstChildOfType('MemberPrimaryPrefix');
        }

        return $memberPrimaryPrefix;
    }
}
