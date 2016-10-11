<?php

namespace MS\PHPMD\Rule\CleanCode;

use MS\PHPMD\Guesser\DataStructureGuesser;
use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;

/**
 * To have a high cohesion the private variables of a class should be used in many methods. Otherwise the class probably does more than one thing.
 */
class PrivateFieldDeclaration extends AbstractDataStructure
{
    use DataStructureGuesser;

    /**
     * @param AbstractNode|ClassNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (true === $this->isDataStructure($node)) {
            return;
        }

        $minPercent = $this->getIntProperty('percent');
        $methods = $node->getMethods();

        foreach ($node->findChildrenOfType('FieldDeclaration') as $fieldDeclaration) {
            if (false === $fieldDeclaration->isPrivate() || true === $fieldDeclaration->isStatic()) {
                continue;
            }

            $variableDeclarator = $fieldDeclaration->getFirstChildOfType('VariableDeclarator');

            $variableName = substr($variableDeclarator->getName(), 1);
            $methodPercent = $this->calculateVariablePercentOfMethods($methods, $variableName);

            if ($minPercent >= $methodPercent) {
                $this->addViolation($fieldDeclaration, [$methodPercent, $minPercent]);
            }
        }
    }

    /**
     * @param array  $methods
     * @param string $variableName
     *
     * @return float
     */
    private function calculateVariablePercentOfMethods(array $methods, $variableName)
    {
        $methodCount = count($methods);

        if (0 === $methodCount) {
            return 0;
        }

        $methodsWithVariable = $this->getMethodsContainsVariable($methods, $variableName);

        return round(count($methodsWithVariable) / $methodCount * 100);
    }

    /**
     * @param AbstractNode[] $methods
     * @param string         $variableName
     *
     * @return AbstractNode[]
     */
    private function getMethodsContainsVariable(array $methods, $variableName)
    {
        $methodsWithVariable = [];

        foreach ($methods as $method) {
            $propertyPostfixes = $method->findChildrenOfType('PropertyPostfix');

            /** @var AbstractNode $propertyPostfix */
            foreach ($propertyPostfixes as $propertyPostfix) {
                $identifier = $propertyPostfix->getFirstChildOfType('Identifier');

                if (null === $identifier) {
                    continue;
                }

                if ($variableName === $identifier->getName()) {
                    $methodsWithVariable[] = $method;

                    break;
                }
            }
        }

        return $methodsWithVariable;
    }
}
