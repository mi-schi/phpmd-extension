<?php

namespace MS\PHPMD\Tests\Unit;

use PHPMD\ParserFactory;
use PHPMD\PHPMD;
use PHPMD\Report;
use PHPMD\RuleSetFactory;
use PHPMD\RuleViolation;

abstract class AbstractPhpmdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RuleViolation[]|\Iterator
     */
    private $ruleViolations = [];

    /**
     * @param string $filename
     * @param string $ruleSet
     */
    protected function generateRuleViolations($filename, $ruleSet)
    {
        $filenamePath = __DIR__ . '/../Fixtures/AppBundle/' . $filename;
        $ruleSetPath = __DIR__ . '/../../rulesets/' . $ruleSet;

        $phpmd = \Mockery::mock(PHPMD::class)->makePartial();
        $phpmd->shouldReceive('getInput')->andReturn($filenamePath);

        $factory = new ParserFactory();
        $parser = $factory->create($phpmd);

        $ruleSetFactory = new RuleSetFactory();
        $parser->addRuleSet($ruleSetFactory->createSingleRuleSet($ruleSetPath));

        $report = new Report();
        $parser->parse($report);

        $this->ruleViolations = $report->getRuleViolations();
    }

    /***
     * @param int    $line
     * @param string $description
     *
     * @return bool
     */
    protected function hasLineAndDescription($line, $description)
    {
        foreach ($this->ruleViolations as $ruleViolation) {
            if ($line === $ruleViolation->getBeginLine() && $description === $ruleViolation->getDescription()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $description
     *
     * @return bool
     */
     protected function containsDescription($description)
     {
         foreach ($this->ruleViolations as $ruleViolation) {
             if (false !== strpos($ruleViolation->getDescription(), $description)) {
                 return true;
             }
         }

         return false;
     }
}
