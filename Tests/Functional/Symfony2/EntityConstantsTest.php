<?php

namespace MS\PHPMD\Tests\Functional\Symfony2;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class EntityConstantsTest
 *
 * @package MS\PHPMD\Tests\Functional\Symfony2
 */
class EntityConstantsTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntityConstants
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
     */
    public function testEntityConstantsRule()
    {
        $output = $this
            ->runPhpmd('Entity/Foo.php', 'symfony2.xml')
            ->getOutput();

        $this->assertContains('Entity/Foo.php:10	Don\'t contain constants in your entity. Important information are distribute throughout the project. You reduce the reusability.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntityConstants
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
     */
    public function testRuleWithFinalStaticClass()
    {
        $output = $this
            ->runPhpmd('Statics/Identifier.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
