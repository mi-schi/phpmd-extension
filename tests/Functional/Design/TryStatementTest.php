<?php

namespace MS\PHPMD\Tests\Functional\Design;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class TryStatementTest extends AbstractProcessTest
{
    public function testTryStatementRule()
    {
        $output = $this
            ->runPhpmd('Utility/TryThings.php', 'design.xml')
            ->getOutput();

        $this->assertContains('Utility/TryThings.php:39	This method contains more than one try statement. Swap out the try statement in an extra method. It increase the readability.', $output);
        $this->assertContains('Utility/TryThings.php:53	This method contains more than one try statement. Swap out the try statement in an extra method. It increase the readability.', $output);
    }

    public function testRuleWithoutTry()
    {
        $output = $this
            ->runPhpmd('Entity.php', 'design.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
