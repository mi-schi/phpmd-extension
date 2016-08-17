<?php

namespace MS\PHPMD\Tests\Unit\Design;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class TryStatementTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'This method contains more than one try statement. Swap out the try statement in an extra method. It increase the readability.';

    public function testTryStatementRule()
    {
        $this->generateRuleViolations('Utility/TryThings.php', 'design.xml');

        $this->assertTrue($this->hasLineAndDescription(39, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(53, self::DESCRIPTION));
    }

    public function testRuleWithoutTry()
    {
        $this->generateRuleViolations('Entity/Foo.php', 'design.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }
}
