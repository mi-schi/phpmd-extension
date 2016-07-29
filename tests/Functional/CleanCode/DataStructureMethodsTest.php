<?php

namespace MS\PHPMD\Tests\Functional\CleanCode;

use MS\PHPMD\Tests\Functional\AbstractProcessTest;

class DataStructureMethodsTest extends AbstractProcessTest
{
    public function testDataStructureMethodsRule()
    {
        $output = $this
            ->runPhpmd('Entity/Foo.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('Entity/Foo.php:80	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);
        $this->assertContains('Entity/Foo.php:91	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);
        $this->assertContains('Entity/Foo.php:101	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);
        $this->assertContains('Entity/Foo.php:113	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);

        $this->assertNotContains('Entity/Foo.php:22', $output);
        $this->assertNotContains('Entity/Foo.php:34', $output);
        $this->assertNotContains('Entity/Foo.php:46', $output);
        $this->assertNotContains('Entity/Foo.php:56', $output);
        $this->assertNotContains('Entity/Foo.php:68', $output);
    }

    public function testForceDataStructureMethodsRule()
    {
        $output = $this
            ->runPhpmd('Entity/FooAssociation.php', 'cleancode.xml')
            ->getOutput();

        $this->assertContains('Entity/FooAssociation.php:79	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);
        $this->assertContains('Entity/FooAssociation.php:90	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);
        $this->assertContains('Entity/FooAssociation.php:100	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);
        $this->assertContains('Entity/FooAssociation.php:112	The method should only be a simple get,set,is,has,add,remove in this data structure.', $output);
    }

    public function testRuleWithModel()
    {
        $output = $this
            ->runPhpmd('Model/Foo.php', 'cleancode.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }

    public function testRuleWithTestForDataStructure()
    {
        $output = $this
            ->runPhpmd('Tests/Test.php', 'cleancode.xml')
            ->getOutput();

        $this->assertEmpty(trim($output));
    }
}
