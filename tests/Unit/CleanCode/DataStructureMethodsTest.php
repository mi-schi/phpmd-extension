<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class DataStructureMethodsTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'The method should only be a simple get,set,is,has,add,remove in this data structure.';

    public function testDataStructureMethodsRule()
    {
        $this->generateRuleViolations('Entity/Foo.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(80, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(101, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(113, self::DESCRIPTION));

        $this->assertFalse($this->hasLineAndDescription(22, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(34, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(46, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(56, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(68, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(123, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(136, self::DESCRIPTION));
    }

    public function testForceDataStructureMethodsRule()
    {
        $this->generateRuleViolations('Entity/FooAssociation.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(79, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(90, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(100, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(112, self::DESCRIPTION));
    }

    public function testRuleWithModel()
    {
        $this->generateRuleViolations('Model/Foo.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }

    public function testRuleWithTestForDataStructure()
    {
        $this->generateRuleViolations('Tests/Test.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }

    public function testRuleWithTestClass()
    {
        $this->generateRuleViolations('Tests/Entity/FooTest.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }

    public function testRuleWithRepositoryClass()
    {
        $this->generateRuleViolations('Entity/FooRepository.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }

    public function testRuleWithServiceClass()
    {
        $this->generateRuleViolations('Service/EntityConverter.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription(self::DESCRIPTION));
    }
}
