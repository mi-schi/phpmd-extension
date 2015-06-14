<?php

namespace MS\PHPMD\Tests\Functional\Test;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class MethodNumberOfMocksTest
 *
 * @package MS\PHPMD\Tests\Functional\Test
 */
class MethodNumberOfMocksTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\Test\MethodNumberOfMocks
     */
    public function testRule()
    {
        $output = $this
            ->runPhpmd('Test.php', 'test.xml')
            ->getOutput();

        $this->assertContains('Test.php:29	4 mocks are found in this test. Try to reduce the mocks to 3 or less.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Test\MethodNumberOfMocks
     */
    public function testRuleNoTest()
    {
        $output = $this
            ->runPhpmd('Entity.php', 'test.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
