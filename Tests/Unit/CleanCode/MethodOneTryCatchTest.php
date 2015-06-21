<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Rule\CleanCode\MethodOneTryCatch;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class MethodOneTryCatchTest
 *
 * @package MS\PHPMD\Tests\Unit\CleanCode
 */
class MethodOneTryCatchTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\MethodOneTryCatch
     */
    public function testApplyNoMethodNode()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\MethodOneTryCatch
     */
    public function testMoreTryStatements()
    {
        $node = $this->getMethodNode('TestClass', 'tryMore', [
            'TryStatement' => array_fill(0, 2, $this->getNode('try'))
        ]);

        $this->assertRule($node, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\MethodOneTryCatch
     */
    public function testOneTryStatementWithCatchFinally()
    {
        $node = $this->getMethodNode('TestClass', 'tryMore', [
            'TryStatement' => array_fill(0, 1, $this->getNode('try')),
            'ScopeStatement' => array_merge(
                array_fill(0, 2, $this->getNode('catch')),
                array_fill(0, 1, $this->getNode('finally'))
            )
        ]);

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\MethodOneTryCatch
     */
    public function testOneTryStatementWithScopeStatements()
    {
        $tryNode = \Mockery::mock('PHPMD\AbstractNode');
        $tryNode->shouldReceive('isInstanceOf')->andReturn(true);

        $proxyNode = \Mockery::mock('PHPMD\AbstractNode');
        $proxyNode->shouldReceive('getImage')->andReturn('while');
        $proxyNode->shouldReceive('isInstanceOf')->andReturn(false);
        $proxyNode->shouldReceive('getParent')->andReturn($tryNode);

        $notAllowedNode = \Mockery::mock('PHPMD\AbstractNode');
        $notAllowedNode->shouldReceive('getImage')->andReturn('if');
        $notAllowedNode->shouldReceive('getParent')->andReturn(null);

        $allowedNode = \Mockery::mock('PHPMD\AbstractNode');
        $allowedNode->shouldReceive('getImage')->andReturn('if');
        $allowedNode->shouldReceive('getParent')->andReturn($proxyNode);

        $node = $this->getMethodNode('TestClass', 'tryMore', [
            'TryStatement' => array_fill(0, 1, $this->getNode('try')),
            'ScopeStatement' => [
                $allowedNode,
                $notAllowedNode
            ]
        ]);

        $this->assertRule($node, 1);
    }

    /**
     * @return MethodOneTryCatch
     */
    protected function getRule()
    {
        $rule =  new MethodOneTryCatch();
        $rule->addProperty('delimiter', ',');
        $rule->addProperty('allowedChildren', 'catch,finally');

        return $rule;
    }
}
