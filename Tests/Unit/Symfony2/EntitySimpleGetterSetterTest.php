<?php

namespace MS\PHPMD\Tests\Unit\Symfony2;

use MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter;
use MS\PHPMD\Tests\Unit\AbstractApplyTest;

/**
 * Class EntitySimpleGetterSetterTest
 *
 * @package MS\PHPMD\Tests\Unit\Symfony2
 */
class EntitySimpleGetterSetterTest extends AbstractApplyTest
{
    const CLASS_NAME = 'TestEntity';

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testApplyNoClassNode()
    {
        $node = \Mockery::mock('PHPMD\Node\MethodNode');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testApplyNoEntity()
    {
        $node = \Mockery::mock('PHPMD\Node\ClassNode');
        $node->shouldReceive('getDocComment')->andReturn('');

        $this->assertRule($node, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testValidEntity()
    {
        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'getData', [
            'ScopeStatement' => [],
            'ReturnStatement' => array_fill(0, 1, $this->getNode('return')),
            'Variable' => array_fill(0, 1, $this->getNode('$this')),
        ]);
        $classNode = $this->getClassNode([$methodNode]);

        $this->assertRule($classNode, 0);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testWrongMethodPrefix()
    {
        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'doSomething');
        $classNode = $this->getClassNode([$methodNode]);

        $this->assertRule($classNode, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testForbiddenScope()
    {
        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'getData', [
            'ScopeStatement' => array_fill(0, 1, $this->getNode('if')),
        ]);
        $classNode = $this->getClassNode([$methodNode]);

        $this->assertRule($classNode, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testMultipleReturns()
    {
        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'getData', [
            'ScopeStatement' => [],
            'ReturnStatement' => array_fill(0, 2, $this->getNode('return')),
            'Variable' => array_fill(0, 1, $this->getNode('$this')),
        ]);
        $classNode = $this->getClassNode([$methodNode]);

        $this->assertRule($classNode, 1);
    }

    /**
     * @covers MS\PHPMD\Rule\Symfony2\EntitySimpleGetterSetter
     */
    public function testRelationReturnToThis()
    {
        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'getData', [
            'ScopeStatement' => [],
            'ReturnStatement' => [],
            'Variable' => array_fill(0, 2, $this->getNode('$this')),
        ]);
        $classNode = $this->getClassNode([$methodNode]);

        $this->assertRule($classNode, 1);

        $methodNode = $this->getMethodNode(self::CLASS_NAME, 'getData', [
            'ScopeStatement' => [],
            'ReturnStatement' => array_fill(0, 1, $this->getNode('return')),
            'Variable' => array_fill(0, 3, $this->getNode('$this')),
        ]);
        $classNode = $this->getClassNode([$methodNode]);

        $this->assertRule($classNode, 1);
    }

    /**
     * @param array $methodNodes
     *
     * @return \Mockery\MockInterface
     */
    private function getClassNode(array $methodNodes)
    {
        $classNode = \Mockery::mock('PHPMD\Node\ClassNode');
        $classNode->shouldReceive('getDocComment')->andReturn('* @ORM\Entity()');
        $classNode->shouldReceive('getImage')->andReturn(self::CLASS_NAME);
        $classNode->shouldReceive('getMethods')->andReturn($methodNodes);

        return $classNode;
    }

    /**
     * @return EntitySimpleGetterSetter
     */
    protected function getRule()
    {
        $rule = new EntitySimpleGetterSetter();
        $rule->addProperty('delimiter', ',');
        $rule->addProperty('prefixes', 'get,set');

        return $rule;
    }
}
