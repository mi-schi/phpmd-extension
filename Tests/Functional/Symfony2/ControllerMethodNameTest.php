<?php

namespace MS\PHPMD\Tests\Functional\Symfony2;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class ControllerMethodNameTest
 *
 * @package PHPMD\Tests\Functional\Symfony2
 */
class ControllerMethodNameTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\ControllerMethodName
     */
    public function testControllerMethodNameRule()
    {
        $output = $this
            ->runPhpmd('Controller/FooController.php', 'symfony2.xml')
            ->getOutput();

        $this->assertNotContains('Controller/FooController.php:18	The method name should end with Action in this controller.', $output);
        $this->assertContains('Controller/FooController.php:33	The method name should end with Action in this controller.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ControllerMethodName
     */
    public function testRuleWithAbstractClass()
    {
        $output = $this
            ->runPhpmd('Controller/AbstractFooController.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
