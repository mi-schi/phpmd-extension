<?php

namespace MS\PHPMD\Tests\Unit\Naming;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class ControllerMethodNameTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'The method name should end with Action in this controller.';

    public function testControllerMethodNameRule()
    {
        $this->generateRuleViolations('Controller/FooController.php', 'naming.xml');

        $this->assertFalse($this->hasLineAndDescription(18, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(33, self::DESCRIPTION));
    }

    public function testRuleWithAbstractClass()
    {
        $this->generateRuleViolations('Controller/AbstractFooController.php', 'naming.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }
}
