<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Rule\CleanCode\MeaninglessMethodName;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class MeaninglessMethodNameTest
 *
 * @package MS\PHPMD\Tests\Unit\CleanCode
 */
class MeaninglessMethodNameTest extends AbstractApplyTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\MeaninglessMethodName
     */
    public function testFindMeaninglessMethodName()
    {
        $node = $this->getMethodNode('TestClass', 'getData');

        $this->assertRule($node, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\MeaninglessMethodName
     */
    public function testFindNoMeaninglessMethodName()
    {
        $node = $this->getMethodNode('TestClass', 'getStatisticData');

        $this->assertRule($node, 0);
    }

    /**
     * @return MeaninglessMethodName
     */
    protected function getRule()
    {
        $rule = new MeaninglessMethodName();
        $rule->addProperty('delimiter', ',');
        $rule->addProperty('meaninglessNames', 'getData');

        return $rule;
    }
}
