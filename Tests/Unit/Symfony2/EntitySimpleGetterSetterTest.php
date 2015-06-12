<?php

namespace MS\PHPMD\Tests\Unit\Symfony2;

use MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class EntitySimpleGetterSetterTest
 *
 * @package MS\PHPMD\Tests\Unit\Symfony2
 */
class EntitySimpleGetterSetterTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testApplyNoClassNode()
    {
        $node = \Mockery::mock('PHPMD\Node\MethodNode');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testApplyNoEntity()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getDocComment')->andReturn('');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testApply()
    {
        $className = 'TestController';
        $validMethodName = 'getData';
        $notValidMethodName = 'doSomething';

        $validMethodNode = \Mockery::mock('PHPMD\Node\MethodNode');
        $validMethodNode->shouldReceive('getImage')->andReturn($validMethodName);
        $validMethodNode->shouldReceive('getParentName')->andReturn($className);
        $validMethodNode->shouldReceive('getName')->andReturn($validMethodName);
        $validMethodNode->shouldReceive('findChildrenOfType')->andReturn(0);

        $notValidMethodNode = \Mockery::mock('PHPMD\Node\MethodNode');
        $notValidMethodNode->shouldReceive('getImage')->andReturn($notValidMethodName);
        $notValidMethodNode->shouldReceive('getParentName')->andReturn($className);
        $notValidMethodNode->shouldReceive('getName')->andReturn($notValidMethodName);
        $notValidMethodNode->shouldReceive('findChildrenOfType')->andReturn(1);

        $classNode = \Mockery::mock('PHPMD\Node\ClassNode');
        $classNode->shouldReceive('getDocComment')->andReturn('* @ORM\Entity()');
        $classNode->shouldReceive('getImage')->andReturn($className);
        $classNode->shouldReceive('getMethods')->andReturn([$validMethodNode, $notValidMethodNode]);

        $this->assertRule($classNode, 2);
    }

    /**
     * @return EntitySimpleGetterSetter
     */
    protected function getRule()
    {
        $rule = new EntitySimpleGetterSetter();
        $rule->addProperty('delimiter', ',');
        $rule->addProperty('prefixes', 'get,set');
        $rule->addProperty('tokens', '18');

        return $rule;
    }
}
