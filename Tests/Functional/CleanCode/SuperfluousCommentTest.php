<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class SuperfluousCommentTest
 *
 * @package MS\PHPMD\Tests\Functional\CleanCode
 */
class SuperfluousCommentTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\SuperfluousComment
     */
    public function testRule()
    {
        $output = $this
            ->runPhpmd('Service/SuperfluousComment.php', 'cleancode.xml')
            ->getOutput();

        $this->assertNotContains('SuperfluousComment.php:42', $output);

        $this->assertContains('SuperfluousComment.php:10	It seems that this class has a superfluous comment description. It fits 88 percent with the name of the class.', $output);
        $this->assertContains('SuperfluousComment.php:24	It seems that this method has a superfluous comment description. It fits 100 percent with the name of the method.', $output);
        $this->assertContains('SuperfluousComment.php:34	It seems that this method has a superfluous comment description. It fits 82 percent with the name of the method.', $output);
    }
}
