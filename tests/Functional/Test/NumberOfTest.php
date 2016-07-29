<?php

namespace MS\PHPMD\Tests\Functional\Test;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class MethodNumberOfTest extends AbstractProcessTest
{
    public function testMethodNumberOfRule()
    {
        $output = $this
            ->runPhpmd('Tests/Test.php', 'test.xml')
            ->getOutput();

        $this->assertContains('Tests/Test.php:37	4 mocks are found in this test. Try to reduce the mocks to 3 or less.', $output);
        $this->assertContains('Tests/Test.php:52	6 asserts are found in this test. Try to reduce the asserts to 5 or less.', $output);
    }

    public function testRuleNoTest()
    {
        $output = $this
            ->runPhpmd('Entity/Entity.php', 'test.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
