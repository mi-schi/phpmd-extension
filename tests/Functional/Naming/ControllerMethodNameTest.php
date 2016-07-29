<?php

namespace MS\PHPMD\Tests\Functional\Naming;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class ControllerMethodNameTest extends AbstractProcessTest
{
    public function testControllerMethodNameRule()
    {
        $output = $this
            ->runPhpmd('Controller/FooController.php', 'naming.xml')
            ->getOutput();

        $this->assertNotContains('Controller/FooController.php:18	The method name should end with Action in this controller.', $output);
        $this->assertContains('Controller/FooController.php:33	The method name should end with Action in this controller.', $output);
    }

    public function testRuleWithAbstractClass()
    {
        $output = $this
            ->runPhpmd('Controller/AbstractFooController.php', 'naming.xml')
            ->getOutput();

        $this->assertNotContains('The method name should end with Action in this controller.', $output);
    }
}
