<?php

namespace MS\PHPMD\Tests\Unit\Symfony2;

use MS\PHPMD\Rule\Symfony2\ControllerMethodName;
use PHPMD\AbstractNode;
use PHPMD\Report;

/**
 * Class ControllerMethodNameTest
 *
 * @package MS\PHPMD\Tests\Unit\Symfony2
 */
class ControllerMethodNameTest extends \PHPUnit_Framework_TestCase
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
     * @param AbstractNode $node
     * @param int          $violationNumber
     */
    private function assertRule(AbstractNode $node, $violationNumber)
    {
        $rule = new ControllerMethodName();
        $rule->setReport($this->getReport($violationNumber));
        $rule->apply($node);
    }

    /**
     * @param $violationNumber
     *
     * @return \Mockery\MockInterface|Report
     */
    private function getReport($violationNumber)
    {
        $report = \Mockery::mock('PHPMD\Report');
        $report->shouldReceive('addRuleViolation')->times($violationNumber);

        return $report;
    }

    /**
     * close Mockery
     */
    public function tearDown()
    {
        \Mockery::close();
    }
}
