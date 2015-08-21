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

        $this->assertContains('Entity/Foo.php:75	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:86	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:96	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);
        $this->assertContains('Entity/Foo.php:108	The method should only be a simple get,set,is,has,add,remove in this entity.', $output);

        $this->assertNotContains('Entity/Foo.php:17', $output);
        $this->assertNotContains('Entity/Foo.php:29', $output);
        $this->assertNotContains('Entity/Foo.php:41', $output);
        $this->assertNotContains('Entity/Foo.php:51', $output);
        $this->assertNotContains('Entity/Foo.php:63', $output);
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
