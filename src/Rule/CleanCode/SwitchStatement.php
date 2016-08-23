<?php

namespace MS\PHPMD\Rule\CleanCode;

/**
 * Try to avoid using switch-case statements. Use polymorphism instead.
 */
class SwitchStatement extends AbstractForbiddenNode
{
    /**
     * @return string
     */
    protected function getTypeName()
    {
        return 'SwitchStatement';
    }
}
