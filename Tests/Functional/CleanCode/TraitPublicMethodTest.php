<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class TraitPublicMethodTest
 *
 * @package MS\PHPMD\Tests\Functional\CleanCode
 */
class TraitPublicMethodTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\TraitPublicMethod
     */
    public function testTraitPublicMethodRule()
    {
        $output = $this
            ->runPhpmd('Utility/UserComparator.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('UserComparator.php:22	The purpose of a trait should be the reuse of methods which help the basic classes. Make your code clearly and define interfaces of your class as public methods.', $output);
        $this->assertNotContains('UserComparator.php:15', $output);
    }
}
