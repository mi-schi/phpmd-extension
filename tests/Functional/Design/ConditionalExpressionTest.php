<?php

namespace MS\PHPMD\Tests\Functional\Design;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class ConditionalExpressionTest extends AbstractProcessTest
{
    public function testConditionalExpressionRule()
    {
        $output = $this
            ->runPhpmd('Service/GeneralManager.php', 'design.xml')
            ->getOutput();

        $this->assertContains('GeneralManager.php:17	Try to avoid using inline ifs. They conceal the complexity of your code. Furthermore they obstruct the expandability. Refactor your code and increase the readability.', $output);
        $this->assertContains('GeneralManager.php:27	Try to avoid using inline ifs. They conceal the complexity of your code. Furthermore they obstruct the expandability. Refactor your code and increase the readability.', $output);
    }
}
