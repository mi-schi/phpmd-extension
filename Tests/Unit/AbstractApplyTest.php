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
     * @param $violationNumber
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
     * @return AbstractRule
     */
    abstract protected function getRule();
}
