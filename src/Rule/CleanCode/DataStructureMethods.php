<?php

namespace MS\PHPMD\Rule\CleanCode;

use MS\PHPMD\Guesser\TestGuesser;
use PDepend\Source\AST\ASTMethod;
use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;
use PHPMD\Node\MethodNode;

/**
 * The data structure have to contain only simple getter and setter.
 */
class DataStructureMethods extends AbstractDataStructure
{
    use TestGuesser;

    /**
     * @var array
     */
    private $allowedPrefixes;

    /**
     * @var array
     */
    private $whitelist;

    /**
     * @param AbstractNode|ClassNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (false === $this->isDataStructure($node) || true === $this->isTest($node)) {
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
        $countSetter = $this->countSetter($node);

        if (1 < $countReturn) {
            return false;
        }

        if (($countReturn + 1) < $countThis - $countSetter) {
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
            if ('$this' === $variable->getImage()) {
                $count++;
            }
        }

        return $count;
    }

    private function countSetter(MethodNode $node)
    {
        $count = 0;
        $methods = $node->findChildrenOfType('MethodPostfix');

        foreach ($methods as $method) {
            if ('set' === substr($method->getImage(), 0, 3)) {
                $child = $method->getFirstChildOfType('Variable');
                if($child && '$this' === $child->getImage()) {
                    $count++;
                }
            }
        }

        return $count;
    }
}
