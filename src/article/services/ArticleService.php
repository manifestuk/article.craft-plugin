<?php

/**
 * The Article plugin API.
 *
 * @package Craft
 * @author  Stephen Lewis <stephen@experiencehq.net>
 */

namespace Craft;

use Experience\Article\App\Helpers\TemplatesHelper;

/**
 * Class ArticleService
 *
 * @package Craft
 */
class ArticleService extends BaseApplicationComponent
{
    /**
     * The templates helper.
     *
     * @var TemplatesHelper
     */
    protected $templatesHelper;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->templatesHelper = ArticlePlugin::$container->get('TemplatesHelper');
    }

    /**
     * Renders the given Matrix field. Expect an array of MatrixBlockModels, or
     * an ElementCriteriaModel which returns the same.
     *
     * @param ElementCriteriaModel|MatrixBlockModel[] $matrixField
     *
     * @return string
     */
    public function render($matrixField)
    {
        $this->templatesHelper->overrideTemplatesPath();
        $markdown = $this->buildFieldMarkdown($matrixField);
        $this->templatesHelper->resetTemplatesPath();

        return craft()->smartdown->parseAll($markdown);
    }

    /**
     * Converts the given Matrix field into a Markdown string.
     *
     * @param ElementCriteriaModel|MatrixBlockModel[] $matrixField
     *
     * @return string
     */
    protected function buildFieldMarkdown($matrixField)
    {
        $blocks = [];

        foreach ($matrixField as $block) {
            $blocks[] = $this->buildBlockMarkdown($block);
        }

        return implode("\n\n", array_filter($blocks));
    }

    /**
     * Converts the given Matrix block into a Markdown string.
     *
     * @param MatrixBlockModel $block
     *
     * @return string
     */
    protected function buildBlockMarkdown(MatrixBlockModel $block)
    {
        return craft()->templates->render(
            $this->getBlockTemplate($block),
            $this->getBlockContent($block)
        );
    }

    /**
     * Returns the path to the template that will be used to render to the
     * given block.
     *
     * @param MatrixBlockModel $block
     *
     * @return string
     */
    protected function getBlockTemplate(MatrixBlockModel $block)
    {
        return $this->templatesHelper->getBlockTemplatePath(
            $block->getType()->getAttribute('handle'));
    }

    /**
     * Returns an associative array of the given block's content.
     *
     * @param MatrixBlockModel $block
     *
     * @return array
     */
    protected function getBlockContent(MatrixBlockModel $block)
    {
        return ['block' => $block];
    }
}
