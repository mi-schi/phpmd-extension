<?php

namespace MS\PHPMD\Tests\Functional\Design;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class SwitchStatementTest extends AbstractProcessTest
{
    public function testSwitchStatementRule()
    {
        $output = $this
            ->runPhpmd('Service/Switcher.php', 'design.xml')
            ->getOutput();

        $this->assertContains('Switcher.php:17	Try to avoid using switch-case statements. Use polymorphism instead.', $output);
    }
}
