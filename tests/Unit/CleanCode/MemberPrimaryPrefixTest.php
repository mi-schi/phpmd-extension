<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class MemberPrimaryPrefixTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Don\'t chain methods excessively. There are 2 concatenations allowed. The code becomes hard to test and violate the law of demeter.';

    public function testMethodChainCount()
    {
        $this->generateRuleViolations('Service/GeneralManager.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(56, self::DESCRIPTION));

        $this->assertFalse($this->hasLineAndDescription(51, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(52, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(64, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(65, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(67, self::DESCRIPTION));
    }
}
