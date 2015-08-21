<?php

namespace MS\PHPMD\Tests\Unit\Symfony2;

use MS\PHPMD\Rule\Symfony2\EntityConstants;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class EntityConstantsTest
 *
 * @package MS\PHPMD\Tests\Unit\Symfony2
 */
class EntityConstantsTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntityConstants
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
     */
    public function testApplyNoEntity()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getDocComment')->andReturn('');
        $node->shouldReceive('isAbstract')->andReturn(false);

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntityConstants
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
     */
    public function testApplyEntityHasConstants()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getDocComment')->andReturn('* @isEntity');
        $node->shouldReceive('getConstants')->andReturn([1]);
        $node->shouldReceive('getName')->andReturn('Entity');

        $this->assertRule($node, 1);
    }

    /**
     * @return EntityConstants
     */
    protected function getRule()
    {
        $rule = new EntityConstants();
        $rule->addProperty('entityRegex', '(\*\s*@\S*Entity)i');
        $rule->addProperty('classIsEntityRegex', '(\*\s*@isEntity)i');

        return $rule;
    }
}
