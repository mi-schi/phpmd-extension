<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Rule\CleanCode\ClassNameSingleResponsibility;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class ClassNameSingleResponsibilityTest
 *
 * @package MS\PHPMD\Tests\Unit\CleanCode
 */
class ClassNameSingleResponsibilityTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\ClassNameSingleResponsibility
     */
    public function testApplyNoClassNode()
    {
        $node = \Mockery::mock('PHPMD\Node\MethodNode');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\ClassNameSingleResponsibility
     */
    public function testApplyWithSingleResponsibilityClass()
    {
        $className = 'UserConverter';

        $classNode = \Mockery::mock('PHPMD\Node\ClassNode');
        $classNode->shouldReceive('getImage')->andReturn($className);
        $classNode->shouldReceive('getName')->andReturn($className);

        $this->assertRule($classNode, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\ClassNameSingleResponsibility
     */
    public function testApply()
    {
        $className = 'UserManager';

        $classNode = \Mockery::mock('PHPMD\Node\ClassNode');
        $classNode->shouldReceive('getImage')->andReturn($className);
        $classNode->shouldReceive('getName')->andReturn($className);

        $this->assertRule($classNode, 1);
    }

    /**
     * @return ClassNameSingleResponsibility
     */
    protected function getRule()
    {
        $rule =  new ClassNameSingleResponsibility();
        $rule->addProperty('delimiter', ',');
        $rule->addProperty('suffixes', 'Manager,Handler');

        return $rule;
    }
}
