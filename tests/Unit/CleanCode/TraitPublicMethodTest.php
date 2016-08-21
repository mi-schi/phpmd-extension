<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class TraitPublicMethodTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'The purpose of a trait should be the reuse of methods which help the basic classes. Make your code clearly and define interfaces of your class as public methods.';

    public function testTraitPublicMethodRule()
    {
        $this->generateRuleViolations('Utility/UserComparator.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(22, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(15, self::DESCRIPTION));
    }
}
