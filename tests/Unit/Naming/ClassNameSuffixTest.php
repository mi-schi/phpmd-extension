<?php

namespace MS\PHPMD\Tests\Unit\Naming;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class ClassNameSuffixTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Try to avoid general suffixes like Manager,Handler,Helper,Util,Utility,Information,Processor found Manager. It might violate of the single responsibility principle.';

    public function testClassNameSuffixRule()
    {
        $this->generateRuleViolations('Service/GeneralManager.php', 'naming.xml');

        $this->assertTrue($this->hasLineAndDescription(8, self::DESCRIPTION));
    }

    public function testRuleWithSuffixClass()
    {
        $this->generateRuleViolations('Controller/FooController.php', 'naming.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }
}
