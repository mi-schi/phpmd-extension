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
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
     */
    public function testRule()
    {
        $output = $this
            ->runPhpmd('Entity/Foo.php', 'symfony2.xml')
            ->getOutput();

        $this->assertContains('Entity/Foo.php:80	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:91	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:101	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:113	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);

        $this->assertNotContains('Entity/Foo.php:22', $output);
        $this->assertNotContains('Entity/Foo.php:34', $output);
        $this->assertNotContains('Entity/Foo.php:46', $output);
        $this->assertNotContains('Entity/Foo.php:56', $output);
        $this->assertNotContains('Entity/Foo.php:68', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
     */
    public function testForceRule()
    {
        $output = $this
            ->runPhpmd('Entity/FooAssociation.php', 'symfony2.xml')
            ->getOutput();

        $this->assertContains('Entity/FooAssociation.php:79	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/FooAssociation.php:90	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/FooAssociation.php:100	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/FooAssociation.php:112	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
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
     * @covers MS\PHPMD\Rule\Symfony2\AbstractEntityRule
     */
    public function testRuleWithTestForEntity()
    {
        $output = $this
            ->runPhpmd('Tests/Test.php', 'symfony2.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
