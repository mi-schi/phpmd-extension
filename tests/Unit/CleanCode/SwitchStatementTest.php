<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class SwitchStatementTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Try to avoid using switch-case statements. Use polymorphism instead.';

    public function testSwitchStatementRule()
    {
        $this->generateRuleViolations('Service/Switcher.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(17, self::DESCRIPTION));
    }
}
