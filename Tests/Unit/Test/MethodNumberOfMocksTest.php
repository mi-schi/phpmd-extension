<?php

namespace MS\PHPMD\Tests\Unit\Test;

use MS\PHPMD\Rule\Test\MethodNumberOfMocks;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class MethodNumberOfMocksTest
 *
 * @package MS\PHPMD\Tests\Unit\Test
 */
class MethodNumberOfMocksTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\Test\MethodNumberOfMocks
     * @covers MS\PHPMD\Rule\Test\AbstractMethodNumberOf
     */
    public function testMoreMocks()
    {
        $methodNode = \Mockery::mock('PHPMD\Node\MethodNode');
        $methodNode->shouldReceive('getParentName')->andReturn('FooControllerTest');
        $methodNode->shouldReceive('getName')->andReturn('FooControllerTest');
        $methodNode->shouldReceive('findChildrenOfType')->andReturn(
            array_merge(
                array_fill(0, 3, $this->getNode('mock')),
                array_fill(0, 1, $this->getNode('getMock'))
            )
        );

        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getImage')->andReturn('FooControllerTest');
        $node->shouldReceive('getMethods')->andReturn([$methodNode]);

        $this->assertRule($node, 1);
    }

    /**
     * @return MethodNumberOfMocks
     */
    protected function getRule()
    {
        $rule =  new MethodNumberOfMocks();
        $rule->addProperty('number', '3');
        $rule->addProperty('names', 'getMock,mock');
        $rule->addProperty('delimiter', ',');
        $rule->addProperty('match', '1');

        return $rule;
    }
}
