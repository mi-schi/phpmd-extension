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
    public function testRule()
    {
        $output = $this
            ->runPhpmd('FooController.php', 'symfony2.xml')
            ->getOutput();

        $this->assertContains('FooController.php:19	The method name should end with Action in this controller.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ControllerMethodName
     */
    public function testRuleWithAbstractClass()
    {
        $output = $this
            ->runPhpmd('AbstractFooController.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
