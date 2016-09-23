<?php

namespace MS\PHPMD\Tests\Unit\Naming;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class MethodNameTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Try to avoid meaningless method names like getData. Also getData,getInformation,setData,setInformation,calculateData are meaningless. Find a name which is more specific.';

    public function testMethodNameRule()
    {
        $this->generateRuleViolations('Service/GeneralManager.php', 'naming.xml');

        $this->assertTrue($this->hasLineAndDescription(15, self::DESCRIPTION));
        $this->assertFalse($this->hasLineAndDescription(25, self::DESCRIPTION));
    }
}
