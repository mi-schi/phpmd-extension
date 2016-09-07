<?php

/**
 * Class Test
 *
 * @coversEntity
 */
class Test extends \PHPUnit_Framework_TestCase
{
    /**
     * good
     */
    public function testIsCorrectForMockAndAssert()
    {
        $mock = $this
            ->getMockBuilder('Class')
            ->getMock();

        $this->assertTrue(true);
    }

    /**
     * good
     */
    public function testMockeryFitsAssert()
    {
        $mock = \Mockery::mock('Class');

        $this->assertTrue(true);
        $this->assertFalse(true);
        $this->assertNotContains(true);
    }

    /**
     * bad
     */
    public function testExcessive()
    {
        $mock = $this
            ->getMockBuilder('Class')
            ->getMock();
        $mock = $this
            ->getMockBuilder('Class')
            ->getMock();
        $mock = \Mockery::mock('Class');
        $mock = \Mockery::mock('Class');
    }

    /**
     * bad
     */
    public function testExcessive2()
    {
        $this->assertTrue(true);
        $this->assertFalse(true);
        $this->assertCount(true);
        $this->assertContains(true);
        $this->assertContains(true);
        $this->assertContains(true);
    }
}
