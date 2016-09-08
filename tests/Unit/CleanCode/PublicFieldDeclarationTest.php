<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class PublicFieldDeclarationTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Try to avoid public class variables. Use Getter to access the variable. It supports the principle of privacy.';

    public function testViolationForPublicVariables()
    {
        $this->generateRuleViolations('Service/MiddlewareService.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(7, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(11, self::DESCRIPTION));

        $this->assertFalse($this->hasLineAndDescription(8, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(9, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(12, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(13, self::DESCRIPTION));
    }
}
