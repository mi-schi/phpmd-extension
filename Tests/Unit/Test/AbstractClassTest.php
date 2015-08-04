<?php

namespace MS\PHPMD\Tests\Unit\Test;

use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class AbstractClassTest
 *
 * @package MS\PHPMD\Tests\Unit\Test
 */
abstract class AbstractClassTest extends AbstractApplyTest
{
    const CLASS_NAME = 'FooControllerTest';

    /**
     * @covers MS\PHPMD\Rule\Test\AbstractMethodNumberOf
     * @covers MS\PHPMD\Rule\Test\MethodNameUnderstandable
     * @covers MS\PHPMD\Rule\Test\AbstractTestRule
     */
    public function testClassIsNoTest()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getImage')->andReturn('FooController');

        $this->assertRule($node, 0);
    }
}
