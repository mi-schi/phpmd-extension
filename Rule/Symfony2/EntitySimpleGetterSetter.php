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

        $this->allowedPrefixes = explode(
            $this->getStringProperty('delimiter'),
            $this->getStringProperty('prefixes')
        );

        /** @var MethodNode $method */
        foreach ($node->getMethods() as $method) {
            $this->checkMethod($method);
        }
    }

    /**
     * @param ClassNode|ASTClass $node
     *
     * @return bool
     */
    private function isEntity(ClassNode $node)
    {
        return (preg_match('(\*\s*@(.)*Entity)i', $node->getDocComment()) > 0);
    }

    /**
     * @param MethodNode|ASTMethod $node
     */
    private function checkMethod(MethodNode $node)
    {
        $ok = false;

        foreach ($this->allowedPrefixes as $prefix) {
            if ($prefix === substr($node->getImage(), 0, strlen($prefix))) {
                $ok = true;
                break;
            }
        }

        $allowedTokens = $this->getAllowedTokens($node);
        $foundTokens = count($node->getTokens());

        if ($foundTokens > $allowedTokens) {
            $ok = false;
        }

        if (false === $ok) {
            $this->addViolation($node, [
                implode(',', $this->allowedPrefixes),
                $foundTokens,
                $allowedTokens
            ]);
        }
    }

    /**
     * @param MethodNode $node
     *
     * @return int
     */
    private function getAllowedTokens(MethodNode $node)
    {
        $allowedTokens = $this->getIntProperty('tokens');
        $countReturn = count($node->findChildrenOfType('ReturnStatement'));

        if ($countReturn > 0) {
            $allowedTokens += 2;
        }

        return $allowedTokens;
    }
}
