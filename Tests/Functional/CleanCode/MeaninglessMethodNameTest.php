<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class MeaninglessMethodNameTest
 *
 * @package MS\PHPMD\Tests\Functional\CleanCode
 */
class MeaninglessMethodNameTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\CleanCode\MeaninglessMethodName
     */
    public function testMeaninglessMethodNameRule()
    {
        $output = $this
            ->runPhpmd('Service/GeneralManager.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('GeneralManager.php:15	Try to avoid meaningless method names like getData. Also getData,getInformation,setData,setInformation are meaningless. Find a name which is not so general.', $output);
        $this->assertNotContains('GeneralManager.php:25	Try to avoid meaningless method names', $output);
    }
}
