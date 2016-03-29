<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class SwitchStatementTest
 *
 * @package MS\PHPMD\Tests\Functional\CleanCode
 */
class SwitchStatementTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\SwitchStatement
     */
    public function testSwitchStatementRule()
    {
        $output = $this
            ->runPhpmd('Service/Switcher.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('GeneralManager.php:17	Try to avoid using switch-case statements. Use polymorphism instead.', $output);
    }
}
