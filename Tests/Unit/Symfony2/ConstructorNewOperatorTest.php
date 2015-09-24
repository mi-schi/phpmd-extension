<?php

namespace MS\PHPMD\Tests\Unit\Symfony2;

use MS\PHPMD\Rule\Symfony2\ConstructorNewOperator;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class ConstructorNewOperatorTest
 *
 * @package MS\PHPMD\Tests\Unit\Symfony2
 */
class ConstructorNewOperatorTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\ConstructorNewOperator
     */
    public function testConstructorWithNewOperator()
    {
        $node = $this->getMethodNode('TestService', '__construct', [
            'ClassReference' => array_fill(0, 1, $this->getNode('Reader'))
        ]);

        $this->assertRule($node, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ConstructorNewOperator
     */
    public function testConstructorWithNewAllowedClassName()
    {
        $node = $this->getMethodNode('TestService', '__construct', [
            'ClassReference' => array_fill(0, 1, $this->getNode('DateTime'))
        ]);

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ConstructorNewOperator
     */
    public function testConstructorWithoutNewOperator()
    {
        $node = $this->getMethodNode('TestService', '__construct', [
            'ClassReference' => []
        ]);

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ConstructorNewOperator
     */
    public function testMethodWithNewOperator()
    {
        $node = $this->getMethodNode('TestService', 'doThings', [
            'ClassReference' => array_fill(0, 1, $this->getNode('Reader'))
        ]);

        $this->assertRule($node, 0);
    }

    /**
     * @return ConstructorNewOperator
     */
    protected function getRule()
    {
        $rule = new ConstructorNewOperator();
        $rule->addProperty('delimiter', ',');
        $rule->addProperty('allowedClassNames', 'DateTime');

        return $rule;
    }
}
