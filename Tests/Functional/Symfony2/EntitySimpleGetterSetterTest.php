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
            ->runPhpmd('Entity/Foo.php', 'symfony2.xml')
            ->getOutput();

        $this->assertContains('Entity/Foo.php:69	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:80	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:90	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:102	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testRuleWithModel()
    {
        $output = $this
            ->runPhpmd('Modle/Foo.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
