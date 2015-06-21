<?php

namespace MS\PHPMD\Tests\Unit;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Report;

/**
 * Class AbstractApplyTest
 *
 * @package MS\PHPMD\Tests\Unit
 */
abstract class AbstractApplyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * close Mockery
     */
    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @param AbstractNode $node
     * @param int          $violationNumber
     */
    protected function assertRule(AbstractNode $node, $violationNumber)
    {
        $rule = $this->getRule();
        $rule->setReport($this->getReport($violationNumber));
        $rule->apply($node);
    }

    /**
     * @param int $violationNumber
     *
     * @return \Mockery\MockInterface|Report
     */
    protected function getReport($violationNumber)
    {
        $report = \Mockery::mock('PHPMD\Report');
        $report->shouldReceive('addRuleViolation')->times($violationNumber);

        return $report;
    }

    /**
     * @param string $className
     * @param string $methodName
     * @param array  $findChildrenOfType
     *
     * @return \Mockery\MockInterface
     */
    protected function getMethodNode($className, $methodName, array $findChildrenOfType = [])
    {
        $methodNode = \Mockery::mock('PHPMD\Node\MethodNode');
        $methodNode->shouldReceive('getImage')->andReturn($methodName);
        $methodNode->shouldReceive('getParentName')->andReturn($className);
        $methodNode->shouldReceive('getName')->andReturn($methodName);

        foreach ($findChildrenOfType as $argument => $return) {
            $methodNode->shouldReceive('findChildrenOfType')->with($argument)->andReturn($return);
        }

        return $methodNode;
    }

    /**
     * @param string $name
     *
     * @return \Mockery\MockInterface
     */
    protected function getNode($name)
    {
        $node = \Mockery::mock('PHPMD\AbstractNode');
        $node->shouldReceive('getName')->andReturn($name);
        $node->shouldReceive('getImage')->andReturn($name);

        return $node;
    }

    /**
     * @return AbstractRule
     */
    abstract protected function getRule();
}
