<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Rule\CleanCode\SwitchStatement;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class SwitchStatementTest
 *
 * @package MS\PHPMD\Tests\Unit\CleanCode
 */
class SwitchStatementTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\SwitchStatement
     */
    public function testFindOneSwitchStatement()
    {
        $node = $this->getMethodNode('TestClass', 'doSomething', [
            'SwitchStatement' => [$this->getNode('switch')]
        ]);

        $this->assertRule($node, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\SwitchStatement
     */
    public function testFindNoSwitchStatement()
    {
        $node = $this->getMethodNode('TestClass', 'doSomething', [
            'SwitchStatement' => []
        ]);

        $this->assertRule($node, 0);
    }

    /**
     * @return SwitchStatement
     */
    protected function getRule()
    {
        $rule = new SwitchStatement();

        return $rule;
    }
}
