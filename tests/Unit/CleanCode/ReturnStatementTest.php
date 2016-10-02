<?php

namespace MS\PHPMD\Tests\Unit\CleanCode;

use MS\PHPMD\Tests\Unit\AbstractPhpmdTest;

class ReturnStatementTest extends AbstractPhpmdTest
{
    const DESCRIPTION = 'Don\'t write your logical code containing %s in the return statement line. It increase the reading rate.';

    public function testIsReturnStatementComplex()
    {
        $this->generateRuleViolations('Service/BadReturner.php', 'cleancode.xml');

        $this->assertTrue($this->hasLineAndDescription(14, sprintf(self::DESCRIPTION, 'UnaryExpression')));
        $this->assertTrue($this->hasLineAndDescription(24, sprintf(self::DESCRIPTION, 'BooleanAndExpression')));
        $this->assertTrue($this->hasLineAndDescription(34, sprintf(self::DESCRIPTION, 'BooleanOrExpression')));
    }

    public function testAllReturnStatementsAreOk()
    {
        $this->generateRuleViolations('Service/GoodReturner.php', 'cleancode.xml');

        $this->assertFalse($this->containsDescription('in the return statement line. It increase the reading rate.'));
    }
}
