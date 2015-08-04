<?php

namespace MS\PHPMD\Rule\CleanCode;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\MethodAware;

/**
 * Class InlineIf
 *
 * Try to avoid using inline ifs. They conceal the complexity of your code.
 * Furthermore they obstruct the expandability. Refactor your code and increase the readability.
 *
 * @package MS\PHPMD\Rule\CleanCode
 */
class InlineIf extends AbstractRule implements MethodAware
{
    /**
     * @param AbstractNode|MethodNode $node
     */
    public function apply(AbstractNode $node)
    {
        $conditionalExpressions = $node->findChildrenOfType('ConditionalExpression');

        foreach ($conditionalExpressions as $conditionalExpression) {
            $this->addViolation($conditionalExpression);
        }
    }
}
