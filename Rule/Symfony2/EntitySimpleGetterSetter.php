<?php

namespace MS\PHPMD\Rule\Symfony2;

use PDepend\Source\AST\ASTClass;
use PDepend\Source\AST\ASTMethod;
use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Node\MethodNode;
use PHPMD\Rule\ClassAware;

/**
 * Class EntitySimpleGetterSetter
 *
 * The entities have to contain only simple getter and setter.
 *
 * @package MS\PHPMD\Rule\Symfony2
 */
class EntitySimpleGetterSetter extends AbstractRule implements ClassAware
{
    /**
     * @var array
     */
    private $allowedPrefixes;

    /**
     * @var array
     */
    private $whitelist;

    /**
     * @param AbstractNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (!$node instanceof ClassNode) {
            return;
        }

        if (false === $this->isEntity($node)) {
            return;
        }

        $prefixes = $this->getStringProperty('prefixes');
        $this->allowedPrefixes = explode($this->getStringProperty('delimiter'), $prefixes);
        $this->whitelist = explode($this->getStringProperty('delimiter'), $this->getStringProperty('whitelist'));

        /** @var MethodNode $method */
        foreach ($node->getMethods() as $method) {
            if (true === $this->isMethodNameOnWhitelist($method)) {
                continue;
            }

            if (true === $this->hasCorrectPrefix($method) && true === $this->isSimpleMethod($method)) {
                continue;
            }

            $this->addViolation($method, [$prefixes]);
        }
    }

    /**
     * @param ClassNode|ASTClass $node
     *
     * @return bool
     */
    private function isEntity(ClassNode $node)
    {
        if (0 < preg_match($this->getStringProperty('entityRegex'), $node->getDocComment())) {
            return true;
        }

        return false;
    }

    /**
     * @param MethodNode $method
     *
     * @return bool
     */
    private function isMethodNameOnWhitelist(MethodNode $method)
    {
        return in_array($method->getImage(), $this->whitelist);
    }

    /**
     * @param MethodNode|ASTMethod $node
     *
     * @return bool
     */
    private function hasCorrectPrefix(MethodNode $node)
    {
        foreach ($this->allowedPrefixes as $prefix) {
            if ($prefix === substr($node->getImage(), 0, strlen($prefix))) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param MethodNode|ASTMethod $node
     *
     * @return bool
     */
    private function isSimpleMethod(MethodNode $node)
    {
        $countScope = count($node->findChildrenOfType('ScopeStatement'));

        if (0 !== $countScope) {
            return false;
        }

        $countReturn = count($node->findChildrenOfType('ReturnStatement'));
        $countThis = $this->countThis($node);

        if (1 < $countReturn) {
            return false;
        }

        if (($countReturn + 1) < $countThis) {
            return false;
        }

        return true;
    }

    /**
     * @param MethodNode $node
     *
     * @return int
     */
    private function countThis(MethodNode $node)
    {
        $count = 0;
        $variables = $node->findChildrenOfType('Variable');

        foreach ($variables as $variable) {
            if ($variable->getImage() === '$this') {
                $count++;
            }
        }

        return $count;
    }
}
