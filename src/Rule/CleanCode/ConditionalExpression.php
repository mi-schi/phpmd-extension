<?php

namespace MS\PHPMD\Rule\CleanCode;

/**
 * Try to avoid using inline ifs. They conceal the complexity of your code.
 * Furthermore they obstruct the expandability. Refactor your code and increase the readability.
 */
class ConditionalExpression extends AbstractForbiddenNode
{
    /**
     * @return string
     */
    protected function getTypeName()
    {
        return 'ConditionalExpression';
    }
}
