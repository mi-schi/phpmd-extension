<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class ConstructorNewOperatorTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'With a new operator in the constructor you have a strong dependency. Make your class flexible and inject the new instance via DI.';

    public function testConstructorNewOperatorRule()
    {
        $this->generateRuleViolations('Service/UserConverter.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(17, self::DESCRIPTION));

        $this->assertFalse($this->hasLineAndDescription(20, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(21, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(29, self::DESCRIPTION));
    }

    public function testConstructorWithoutNewOperatorRule()
    {
        $this->generateRuleViolations('Entity/Foo.php', 'cleancode.xml');

        $this->assertFalse($this->hasLineAndDescription(24, self::DESCRIPTION));
    }
}
