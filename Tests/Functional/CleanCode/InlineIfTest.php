<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class InlineIfTest
 *
 * @package MS\PHPMD\Tests\Functional\CleanCode
 */
class InlineIfTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\InlineIf
     */
    public function testRule()
    {
        $output = $this
            ->runPhpmd('Service/GeneralManager.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('GeneralManager.php:17	Try to avoid using inline ifs. They conceal the complexity of your code. Furthermore they obstruct the expandability. Refactor your code and increase the readability.', $output);
        $this->assertContains('GeneralManager.php:27	Try to avoid using inline ifs. They conceal the complexity of your code. Furthermore they obstruct the expandability. Refactor your code and increase the readability.', $output);
    }
}
