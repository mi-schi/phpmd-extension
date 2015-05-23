<?php

namespace MS\PHPMD\Tests\Unit\Symfony2;

use MS\PHPMD\Rule\Symfony2\ControllerMethodName;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class ControllerMethodNameTest
 *
 * @package MS\PHPMD\Tests\Unit\Symfony2
 */
class ControllerMethodNameTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\ControllerMethodName
     */
    public function testApplyNoClassNode()
    {
        $node = \Mockery::mock('PHPMD\Node\MethodNode');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ControllerMethodName
     */
    public function testApplyNoConcreteClass()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('isAbstract')->andReturn(true);

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ControllerMethodName
     */
    public function testApplyNoController()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('isAbstract')->andReturn(false);
        $node->shouldReceive('getImage')->andReturn('TestService');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ControllerMethodName
     */
    public function testApply()
    {
        $className = 'TestController';
        $validMethodName = 'testAction';
        $notValidMethodName = 'doSomething';

        $validMethodNode = \Mockery::mock('PHPMD\Node\MethodNode');
        $validMethodNode->shouldReceive('getImage')->andReturn($validMethodName);
        $validMethodNode->shouldReceive('getParentName')->andReturn($className);
        $validMethodNode->shouldReceive('getName')->andReturn($validMethodName);

        $notValidMethodNode = \Mockery::mock('PHPMD\Node\MethodNode');
        $notValidMethodNode->shouldReceive('getImage')->andReturn($notValidMethodName);
        $notValidMethodNode->shouldReceive('getParentName')->andReturn($className);
        $notValidMethodNode->shouldReceive('getName')->andReturn($notValidMethodName);

        $classNode = \Mockery::mock('PHPMD\Node\ClassNode');
        $classNode->shouldReceive('isAbstract')->andReturn(false);
        $classNode->shouldReceive('getImage')->andReturn($className);
        $classNode->shouldReceive('getMethods')->andReturn([$validMethodNode, $notValidMethodNode]);

        $this->assertRule($classNode, 1);
    }

    /**
     * @return ControllerMethodName
     */
    protected function getRule()
    {
        return new ControllerMethodName();
    }
}
