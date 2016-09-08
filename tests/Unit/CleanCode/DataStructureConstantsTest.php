<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class DataStructureConstantsTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Don\'t contain constants in your data structure. Important information are distribute throughout the project. You reduce the reusability.';

    public function testDataStructureConstantsRule()
    {
        $this->generateRuleViolations('Entity/Foo.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(10, self::DESCRIPTION));
    }

    public function testRuleWithFinalStaticClass()
    {
        $this->generateRuleViolations('Statics/Identifier.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }

    public function testRuleWithTestClass()
    {
        $this->generateRuleViolations('Tests/Entity/FooTest.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }

    public function testRuleWithServiceClass()
    {
        $this->generateRuleViolations('Service/EntityConverter.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }
}
