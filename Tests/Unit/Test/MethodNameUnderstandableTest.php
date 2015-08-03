<?php

namespace MS\PHPMD\Tests\Unit\Test;

use MS\PHPMD\Rule\Test\MethodNameUnderstandable;

/**
 * Class MethodNameUnderstandableTest
 *
 * @package MS\PHPMD\Tests\Unit\Test
 */
class MethodNameUnderstandableTest extends AbstractClassTest
{
    /**
     * @covers MS\PHPMD\Rule\Test\MethodNameUnderstandable
     * @covers MS\PHPMD\Rule\Test\AbstractTestRule
     */
    public function testMoreWordsInMethod()
    {
        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'testCanAddTwoNumbers');

        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getImage')->andReturn(self::CLASS_NAME);
        $node->shouldReceive('getMethods')->andReturn([$methodNode]);

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Test\MethodNameUnderstandable
     * @covers MS\PHPMD\Rule\Test\AbstractTestRule
     */
    public function testLessWordsInMethod()
    {
        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'testAdd');

        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getImage')->andReturn(self::CLASS_NAME);
        $node->shouldReceive('getMethods')->andReturn([$methodNode]);

        $this->assertRule($node, 1);
    }

    /**
     * @return MethodNameUnderstandable
     */
    protected function getRule()
    {
        $rule =  new MethodNameUnderstandable();
        $rule->addProperty('number', '3');
        $rule->addProperty('regex', '([A-Z])');

        return $rule;
    }
}
