<?php

namespace MS\PHPMD\Tests\Functional\Design;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class ConstructorNewOperatorTest extends AbstractProcessTest
{
    public function testConstructorNewOperatorRule()
    {
        $output = $this
            ->runPhpmd('Service/UserConverter.php', 'design.xml')
            ->getOutput();

        $this->assertContains('Service/UserConverter.php:17	With a new operator in the constructor you have a strong dependency. Make your class flexible and inject the new instance via DI.', $output);
        $this->assertNotContains('Service/UserConverter.php:20', $output);
        $this->assertNotContains('Service/UserConverter.php:21', $output);
        $this->assertNotContains('Service/UserConverter.php:29', $output);
    }

    public function testConstructorWithoutNewOperatorRule()
    {
        $output = $this
            ->runPhpmd('Entity/Foo.php', 'design.xml')
            ->getOutput();

        $this->assertNotContains('Entity/Foo.php:24', $output);
    }
}
