<?php

namespace MS\PHPMD\Tests\Functional\Symfony2;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

/**
 * Class EntitySimpleGetterSetterTest
 *
 * @package MS\PHPMD\Tests\Functional\Symfony2
 */
class EntitySimpleGetterSetterTest extends AbstractProcessTest
{
    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testRule()
    {
        $output = $this
            ->runPhpmd('Entity.php', 'symfony2.xml')
            ->getOutput();

        $this->assertContains('Entity.php:65	The method should only be a simple get,set,is,has,add,remove in this entity. The found tokens to allowed tokens are 20/18.', $output);
        $this->assertContains('Entity.php:76	The method should only be a simple get,set,is,has,add,remove in this entity. The found tokens to allowed tokens are 10/20.', $output);
        $this->assertContains('Entity.php:84	The method should only be a simple get,set,is,has,add,remove in this entity. The found tokens to allowed tokens are 23/18.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testRuleWithModel()
    {
        $output = $this
            ->runPhpmd('Model.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
