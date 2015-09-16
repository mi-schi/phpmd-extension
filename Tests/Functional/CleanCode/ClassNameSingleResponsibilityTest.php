<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class ClassNameSingleResponsibility
 *
 * @package PHPMD\Tests\Functional\CleanCode
 */
class ClassNameSingleResponsibilityTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\ClassNameSingleResponsibility
     */
    public function testClassNameSingleResponsibilityRule()
    {
        $output = $this
            ->runPhpmd('Service/GeneralManager.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('Service/GeneralManager.php:8	Try to avoid general suffixes like Manager,Handler,Helper,Util,Utility,Information,Processor found Manager. It might violate of the single responsibility principle.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\ClassNameSingleResponsibility
     */
    public function testRuleWithSingleResponsibilityClass()
    {
        $output = $this
            ->runPhpmd('FooController.php', 'cleancode.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
