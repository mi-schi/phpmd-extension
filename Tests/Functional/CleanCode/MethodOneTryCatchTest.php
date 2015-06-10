<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class MethodOneTryCatchTest
 *
 * @package MS\PHPMD\Tests\Functional\CleanCode
 */
class MethodOneTryCatchTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\MethodOneTryCatch
     */
    public function testRule()
    {
        $output = $this
            ->runPhpmd('TryThings.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('TryThings.php:37	This method contains more than one try statement. Swap out the try statement in an extra method. It increase the readability.', $output);
        $this->assertContains('TryThings.php:51	This method contains more than one try statement. Swap out the try statement in an extra method. It increase the readability.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\CleanCode\MethodOneTryCatch
     */
    public function testRuleWithoutTry()
    {
        $output = $this
            ->runPhpmd('Entity.php', 'cleancode.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
