<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Rule\CleanCode\InlineIf;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class InlineIfTest
 *
 * @package MS\PHPMD\Tests\Unit\CleanCode
 */
class InlineIfTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\InlineIf
     */
    public function testFindOneInlineIf()
    {
        $node = $this->getMethodNode('TestClass', 'doSomething', [
            'ConditionalExpression' => [$this->getNode('?')]
        ]);

        $this->assertRule($node, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\InlineIf
     */
    public function testFindNoInlineIf()
    {
        $node = $this->getMethodNode('TestClass', 'tryMore', [
            'ConditionalExpression' => []
        ]);

        $this->assertRule($node, 0);
    }

    /**
     * @return InlineIf
     */
    protected function getRule()
    {
        $rule = new InlineIf();

        return $rule;
    }
}
