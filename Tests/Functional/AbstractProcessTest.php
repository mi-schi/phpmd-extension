<?php

namespace MS\PHPMD\Tests\Functional;

use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Process;

/**
 * Class AbstractProcessTest
 *
 * @package MS\PHPMD\Tests\Functional
 */
abstract class AbstractProcessTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $filename
     * @param $ruleset
     *
     * @return Process
     */
    protected function runPhpmd($filename, $ruleset)
    {
        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix(__DIR__ . '/../../vendor/bin/phpmd');

        $processBuilder
            ->add(__DIR__ . '/../Fixtures/' . $filename)
            ->add('text')
            ->add(__DIR__ . '/../../Rulesets/' . $ruleset);

        $process = $processBuilder->getProcess();
        $process->run();

        return $process;
    }
}
