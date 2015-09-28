<?php

namespace MS\PHPMD\Tests\Functional\Symfony2;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class ConstructorNewOperatorTest
 *
 * @package MS\PHPMD\Tests\Functional\Symfony2
 */
class ConstructorNewOperatorTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\ConstructorNewOperator
     */
    public function testConstructorNewOperatorRule()
    {
        $output = $this
            ->runPhpmd('Service/UserConverter.php', 'symfony2.xml')
            ->getOutput();

        $this->assertContains('Service/UserConverter.php:17	With a new operator in the constructor you have a strong dependency. Make your class flexible and inject the new instance via DI.', $output);
        $this->assertNotContains('Service/UserConverter.php:20', $output);
        $this->assertNotContains('Service/UserConverter.php:21', $output);
        $this->assertNotContains('Service/UserConverter.php:29', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\ConstructorNewOperator
     */
    public function testConstructorWithoutNewOperatorRule()
    {
        $output = $this
            ->runPhpmd('Entity/Foo.php', 'symfony2.xml')
            ->getOutput();

        $this->assertNotContains('Entity/Foo.php:24', $output);
    }
}
