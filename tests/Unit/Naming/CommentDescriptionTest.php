<?php

namespace MS\PHPMD\Tests\Unit\Naming;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class CommentDescriptionTest extends AbstractPhpmdTest
{
    const DESCRIPTION_1 = 'It seems that the class has a superfluous comment description. It fits 88 percent with the name of that.';
    const DESCRIPTION_2 = 'It seems that the property $name has a superfluous comment description. It fits 73 percent with the name of that.';
    const DESCRIPTION_3 = 'It seems that the method has a superfluous comment description. It fits 100 percent with the name of that.';
    const DESCRIPTION_4 = 'It seems that the method has a superfluous comment description. It fits 82 percent with the name of that.';

    public function testSuperfluousCommentRule()
    {
        $this->generateRuleViolations('Service/SuperfluousComment.php', 'naming.xml');

        //$this->assertFalse($this->hasLineAndDescription(42, self::DESCRIPTION));

        $this->assertTrue($this->hasLineAndDescription(10, self::DESCRIPTION_1));
        $this->assertTrue($this->hasLineAndDescription(10, self::DESCRIPTION_2));
        $this->assertTrue($this->hasLineAndDescription(24, self::DESCRIPTION_3));
        $this->assertTrue($this->hasLineAndDescription(34, self::DESCRIPTION_4));
    }
}
