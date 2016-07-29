<?php

namespace MS\PHPMD\Tests\Functional\Naming;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class MethodNameTest extends AbstractProcessTest
{
    public function testMethodNameRule()
    {
        $output = $this
            ->runPhpmd('Service/GeneralManager.php', 'naming.xml')
            ->getOutput();

        $this->assertContains('GeneralManager.php:15	Try to avoid meaningless method names like getData. Also getData,getInformation,setData,setInformation are meaningless. Find a name which is not so general.', $output);
        $this->assertNotContains('GeneralManager.php:25	Try to avoid meaningless method names', $output);
    }
}
