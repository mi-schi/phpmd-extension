<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Rule\CleanCode\SuperfluousComment;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;
use PHPMD\AbstractNode;

/**
 * Class SuperfluousCommentTest
 *
 * @package MS\PHPMD\Tests\Unit\CleanCode
 */
class SuperfluousCommentTest extends AbstractApplyTest
{
    const CLASS_NAME = 'SuperfluousComment';

    /**
     * @covers MS\PHPMD\Rule\CleanCode\SuperfluousComment
     */
    public function testClassWithEmptyDocComment()
    {
        $this->assertRule($this->getClassNode(), 0);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\SuperfluousComment
     */
    public function testClassWithSuperfluousComment()
    {
        $this->assertRule($this->getClassNode(
            self::CLASS_NAME
        ), 1);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\SuperfluousComment
     */
    public function testMethodAndPropertyWithSuperfluousComment()
    {
        $propertyName = '$name';
        $methodName = 'getName';

        $propertyNode = \Mockery::mock('PDepend\Source\ASTVisitor\ASTVisitor\ASTProperty');
        $propertyNode->shouldReceive('getName')->andReturn($propertyName);
        $propertyNode->shouldReceive('getDocComment')->andReturn('the name');

        $methodNode = \Mockery::mock('PHPMD\Node\MethodNode');
        $methodNode->shouldReceive('getImage')->andReturn($methodName);
        $methodNode->shouldReceive('getName')->andReturn($methodName);
        $methodNode->shouldReceive('getParentName')->andReturn(self::CLASS_NAME);
        $methodNode->shouldReceive('getType')->andReturn('method');
        $methodNode->shouldReceive('getDocComment')->andReturn('get the name');

        $classNode = $this->getClassNode('', [$propertyNode], [$methodNode]);

        $this->assertRule($classNode, 2);
    }

    /**
     * @return SuperfluousComment
     */
    protected function getRule()
    {
        $rule =  new SuperfluousComment();
        $rule->addProperty('percent', '60');

        return $rule;
    }

    /**
     * @param string $docComment
     * @param array  $properties
     * @param array  $methods
     *
     * @return \Mockery\MockInterface|AbstractNode
     */
    private function getClassNode($docComment = '', $properties = [], $methods = [])
    {
        $classNode = \Mockery::mock('PHPMD\Node\ClassNode');

        $classNode->shouldReceive('getImage')->andReturn(self::CLASS_NAME);
        $classNode->shouldReceive('getName')->andReturn(self::CLASS_NAME);
        $classNode->shouldReceive('getType')->andReturn('class');
        $classNode->shouldReceive('getProperties')->andReturn($properties);
        $classNode->shouldReceive('getMethods')->andReturn($methods);
        $classNode->shouldReceive('getDocComment')->andReturn($docComment);

        return $classNode;
    }
}
