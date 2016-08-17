<?php

namespace MS\PHPMD\Tests\Unit\Test;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class MethodNumberOfTest extends AbstractPhpmdTest
{
    const DESCRIPTION_1 = '4 mocks are found in this test. Try to reduce the mocks to 3 or less.';
    const DESCRIPTION_2 = '6 asserts are found in this test. Try to reduce the asserts to 5 or less.';

    public function testMethodNumberOfRule()
    {
        $this->generateRuleViolations('Tests/Test.php', 'test.xml');

        $this->assertTrue($this->hasLineAndDescription(37, self::DESCRIPTION_1));
        $this->assertTrue($this->hasLineAndDescription(52, self::DESCRIPTION_2));
    }

    public function testRuleNoTest()
    {
        $this->generateRuleViolations('Entity/Foo.php', 'test.xml');

        $this->assertFalse($this->containsDescription('are found in this test. Try to reduce the'));
    }
}
