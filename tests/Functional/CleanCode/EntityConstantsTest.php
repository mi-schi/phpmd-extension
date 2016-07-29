<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class DataStructureConstants extends AbstractProcessTest
{
    public function testDataStructureConstantsRule()
    {
        $output = $this
            ->runPhpmd('Entity/Foo.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('Entity/Foo.php:10	Don\'t contain constants in your data structure. Important information are distribute throughout the project. You reduce the reusability.', $output);
    }

    public function testRuleWithFinalStaticClass()
    {
        $output = $this
            ->runPhpmd('Statics/Identifier.php', 'cleancode.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
