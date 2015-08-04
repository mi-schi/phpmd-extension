<?php

namespace MS\PHPMD\Rule\CleanCode;

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
     * @param AbstractNode $node
     */
    public function apply(AbstractNode $node)
    {
        if (!$node instanceof ClassNode) {
            return;
        }

        $percent = $this->getIntProperty('percent');

        $this->checkDocComment($node, $percent);

        foreach ($node->getMethods() as $method) {
            $this->checkDocComment($method, $percent);
        }
    }

    /**
     * @param AbstractNode $node
     * @param int $percent
     */
    private function checkDocComment($node, $percent)
    {
        $calculatedPercent = round($this->calculateNameToCommentSimilarityInPercent($node));

        if ($percent < $calculatedPercent) {
            $this->addViolation($node, [$node->getType(), $calculatedPercent]);
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
            strtolower($node->getName()),
            $this->getCommentDescription($docComment),
            $percent
        );

        return $percent;
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
            $line = strtolower($line);
            $line = preg_replace('/[^a-z0-9]/', '', $line);

            $description .= $line;
        }

        return $description;
    }
}
