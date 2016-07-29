<?php

namespace MS\PHPMD\Tests\Functional\Naming;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class ClassNameSuffixTest extends AbstractProcessTest
{
    public function testClassNameSuffixRule()
    {
        $output = $this
            ->runPhpmd('Service/GeneralManager.php', 'naming.xml')
            ->getOutput();

        $this->assertContains('Service/GeneralManager.php:8	Try to avoid general suffixes like Manager,Handler,Helper,Util,Utility,Information,Processor found Manager. It might violate of the single responsibility principle.', $output);
    }

    public function testRuleWithSuffixClass()
    {
        $output = $this
            ->runPhpmd('FooController.php', 'naming.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
