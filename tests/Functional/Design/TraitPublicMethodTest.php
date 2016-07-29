<?php

namespace MS\PHPMD\Tests\Functional\Design;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class TraitPublicMethodTest extends AbstractProcessTest
{
    public function testTraitPublicMethodRule()
    {
        $output = $this
            ->runPhpmd('Utility/UserComparator.php', 'design.xml')
            ->getOutput();

        $this->assertContains('UserComparator.php:22	The purpose of a trait should be the reuse of methods which help the basic classes. Make your code clearly and define interfaces of your class as public methods.', $output);
        $this->assertNotContains('UserComparator.php:15', $output);
    }
}
