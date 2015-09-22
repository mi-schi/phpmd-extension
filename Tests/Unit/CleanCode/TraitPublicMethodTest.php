<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Rule\CleanCode\TraitPublicMethod;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class TraitPublicMethodTest
 *
 * @package MS\PHPMD\Tests\Unit\CleanCode
 */
class TraitPublicMethodTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\TraitPublicMethod
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testFindOnePublicMethodInTrait()
    {
        $traitNode = \Mockery::mock('PHPMD\Node\TraitNode');
        $node = $this->getPublicMethodNode($traitNode);

        $this->assertRule($node, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\TraitPublicMethod
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testFindNoViolation()
    {
        $classNode = \Mockery::mock('PHPMD\Node\ClassNode');
        $node = $this->getPublicMethodNode($classNode);

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\TraitPublicMethod
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testFindPrivateMethodInTrait()
    {
        $classNode = \Mockery::mock('PHPMD\Node\TraitNode');
        $node = $this->getPrivateMethodNode($classNode);

        $this->assertRule($node, 0);
    }

    /**
     * @return TraitPublicMethod
     */
    protected function getRule()
    {
        $rule = new TraitPublicMethod();

        return $rule;
    }

    /**
     * @param mixed $parentType
     *
     * @return \Mockery\MockInterface
     */
    protected function getPublicMethodNode($parentType)
    {
        $node = parent::getMethodNode('UserComparator', 'doThings');
        $node->shouldReceive('getParentType')->andReturn($parentType);
        $node->shouldReceive('isPublic')->andReturn(true);

        return $node;
    }

    /**
     * @param mixed $parentType
     *
     * @return \Mockery\MockInterface
     */
    protected function getPrivateMethodNode($parentType)
    {
        $node = parent::getMethodNode('UserComparator', 'doThings');
        $node->shouldReceive('getParentType')->andReturn($parentType);
        $node->shouldReceive('isPublic')->andReturn(false);

        return $node;
    }
}
