<?php

namespace MS\PHPMD\Rule\CleanCode;

use PDepend\Source\AST\ASTClass;
use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;
use PDepend\Source\AST\AbstractASTArtifact;

/**
 * Class SuperfluousComment
 *
 * Don't write superfluous comments. It's adding by subtracting.
 *
 * @package MS\PHPMD\Rule\CleanCode
 */
class SuperfluousComment extends AbstractRule implements ClassAware
{
    /**
     * @var int
     */
    private $percent;

    /**
     * @param AbstractNode|ClassNode|ASTClass $node
     */
    public function apply(AbstractNode $node)
    {
        $this->percent = $this->getIntProperty('percent');

        $this->addViolationWithCondition(
            $node,
            $node->getType(),
            $this->calculateNameToCommentSimilarityInPercent($node)
        );

        foreach ($node->getProperties() as $property) {
            $this->addViolationWithCondition(
                $node,
                'property ' . $property->getName(),
                $this->calculateNameToCommentSimilarityInPercent($property)
            );
        }

        foreach ($node->getMethods() as $method) {
            $this->addViolationWithCondition(
                $method,
                $method->getType(),
                $this->calculateNameToCommentSimilarityInPercent($method)
            );
        }
    }

    /**
     * @param AbstractNode $node
     * @param string       $type
     * @param int          $percent
     */
    private function addViolationWithCondition($node, $type, $percent)
    {
        if ($this->percent < $percent) {
            $this->addViolation($node, [$type, $percent]);
        }
    }

    /**
     * @param AbstractNode|AbstractASTArtifact $node
     *
     * @return float
     */
    private function calculateNameToCommentSimilarityInPercent($node)
    {
        $docComment = $node->getDocComment();

        if (empty($docComment)) {
            return 0;
        }

        similar_text(
            $this->transformString($node->getName()),
            $this->getCommentDescription($docComment),
            $percent
        );

        return round($percent);
    }

    /**
     * @param string $docComment
     *
     * @return string
     */
    private function getCommentDescription($docComment)
    {
        $lines = explode(PHP_EOL, $docComment);

        $descriptionLines = [];

        foreach ($lines as $line) {
            if (false === strpos($line, '@')) {
                $descriptionLines[] = $line;
            }
        }

        return $this->transformDescriptionLines($descriptionLines);
    }

    /**
     * @param array $descriptionLines
     *
     * @return string
     */
    private function transformDescriptionLines(array $descriptionLines)
    {
        $description = '';

        foreach ($descriptionLines as $line) {
            $description .= $this->transformString($line);
        }

        return $description;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function transformString($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9]/', '', $string);

        return $string;
    }
}
