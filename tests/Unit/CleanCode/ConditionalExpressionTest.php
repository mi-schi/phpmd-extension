<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class ConditionalExpressionTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Try to avoid using inline ifs. They conceal the complexity of your code. Furthermore they obstruct the expandability. Refactor your code and increase the readability.';

    public function testConditionalExpressionRule()
    {
        $this->generateRuleViolations('Service/GeneralManager.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(17, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(27, self::DESCRIPTION));
    }
}
