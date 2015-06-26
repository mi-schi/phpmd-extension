<?php

namespace MS\PHPMD\Tests\Functional\Test;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class MethodNumberOfTest
 *
 * @package MS\PHPMD\Tests\Functional\Test
 */
class MethodNumberOfTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\Test\MethodNumberOfAsserts
     * @covers MS\PHPMD\Rule\Test\MethodNumberOfMocks
     * @covers MS\PHPMD\Rule\Test\AbstractMethodNumberOf
     */
    public function testRule()
    {
        $output = $this
            ->runPhpmd('Tests/Test.php', 'test.xml')
            ->getOutput();

        $this->assertContains('Tests/Test.php:35	4 mocks are found in this test. Try to reduce the mocks to 3 or less.', $output);
        $this->assertContains('Tests/Test.php:50	5 asserts are found in this test. Try to reduce the asserts to 3 or less.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Test\MethodNumberOfAsserts
     * @covers MS\PHPMD\Rule\Test\MethodNumberOfMocks
     * @covers MS\PHPMD\Rule\Test\AbstractMethodNumberOf
     */
    public function testRuleNoTest()
    {
        $output = $this
            ->runPhpmd('Entity/Entity.php', 'test.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
