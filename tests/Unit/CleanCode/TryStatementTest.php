<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class TryStatementTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'This method contains more than one try statement. Swap out the try statement in an extra method. It increases the readability.';

    public function testTryStatementRule()
    {
        $this->generateRuleViolations('Utility/TryThings.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(39, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(53, self::DESCRIPTION));
    }

    public function testRuleWithoutTry()
    {
        $this->generateRuleViolations('Entity/Foo.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }
}
