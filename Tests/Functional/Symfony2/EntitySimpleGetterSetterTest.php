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

        $this->assertContains('Entity/Foo.php:77	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:88	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:98	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:110	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testRuleWithModel()
    {
        $output = $this
            ->runPhpmd('Model/Foo.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testRuleWithTestForEntity()
    {
        $output = $this
            ->runPhpmd('Tests/Test.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
