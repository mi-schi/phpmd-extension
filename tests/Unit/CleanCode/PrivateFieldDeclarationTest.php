<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class PrivateFieldDeclarationTest extends AbstractPhpmdTest
{
    const DESCRIPTION_0 = 'The variable is used in 0 percent of the class methods. To have a high cohesion it should be more than 50 percent. Split the class based on the single-responsibility principle.';
    const DESCRIPTION_25 = 'The variable is used in 25 percent of the class methods. To have a high cohesion it should be more than 50 percent. Split the class based on the single-responsibility principle.';
    const DESCRIPTION_50 = 'The variable is used in 50 percent of the class methods. To have a high cohesion it should be more than 50 percent. Split the class based on the single-responsibility principle.';
    const DESCRIPTION_75 = 'The variable is used in 75 percent of the class methods. To have a high cohesion it should be more than 50 percent. Split the class based on the single-responsibility principle.';

    public function testPrivateFieldDeclarationsWithNoMethods()
    {
        $this->generateRuleViolations('Service/MiddlewareService.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(9, self::DESCRIPTION_0));
        $this->assertFalse($this->hasLineAndDescription(13, self::DESCRIPTION_0));
    }

    public function testThresholdOfPrivateFieldDeclarations()
    {
        $this->generateRuleViolations('Service/SingleService.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(7, self::DESCRIPTION_25));
        $this->assertTrue($this->hasLineAndDescription(9, self::DESCRIPTION_50));

        $this->assertFalse($this->hasLineAndDescription(11, self::DESCRIPTION_75));
    }

    public function testIsPrivateFieldDeclarationInEntity()
    {
        $this->generateRuleViolations('Entity/Bar.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription('To have a high cohesion it should be more than 50 percent. Split the class based on the single-responsibility principle.'));
    }

    public function testStaticProperty()
    {
        $this->generateRuleViolations('Service/StaticAccess.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(12, self::DESCRIPTION_0));
    }
}
