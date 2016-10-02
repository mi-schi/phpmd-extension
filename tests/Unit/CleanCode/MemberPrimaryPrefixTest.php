<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class MemberPrimaryPrefixTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Don\'t chain methods excessively. There are 2 concatenations allowed. The code becomes hard to test and violates the law of demeter.';

    public function testMethodChainCount()
    {
        $this->generateRuleViolations('Service/GeneralManager.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(50, self::DESCRIPTION));

        $this->assertFalse($this->hasLineAndDescription(37, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(38, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(39, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(40, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(41, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(42, self::DESCRIPTION));
    }
}
