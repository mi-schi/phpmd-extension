<?php

namespace MS\PHPMD\Tests\Unit\Test;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class MethodNameTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Only 1 words are found in the method name. Try to describe your code as good as you can with 3 or more words.';

    public function testMethodNameUnderstandableRule()
    {
        $this->generateRuleViolations('Tests/Test.php', 'test.xml');

        $this->assertFalse($this->hasLineAndDescription(13, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(25, self::DESCRIPTION));

        $this->assertTrue($this->hasLineAndDescription(37, self::DESCRIPTION));
        $this->assertTrue($this->hasLineAndDescription(52, self::DESCRIPTION));
    }
}
