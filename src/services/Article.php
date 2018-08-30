<?php

namespace experience\article\services;

use Craft;
use craft\elements\db\ElementQuery;
use craft\elements\db\MatrixBlockQuery;
use craft\elements\MatrixBlock;
use craft\web\View;
use Exception;
use experience\article\Article as Plugin;
use experience\smartdown\Smartdown;
use yii\base\Component;

class Article extends Component
{
    /** @var string */
    private $originalTemplatesPath;

    /** @var View */
    private $view;

    public function init()
    {
        parent::init();

        $this->view = Craft::$app->view;
        $this->originalTemplatesPath = $this->view->getTemplatesPath();
    }

    /**
     * Render the given Matrix field
     *
     * @param MatrixBlockQuery|MatrixBlock[] $matrix
     *
     * @return string
     */
    public function render($matrix): string
    {
        if ($matrix instanceof MatrixBlockQuery) {
            $matrix = $matrix->all();
        }

        $this->overrideTemplatesPath();
        $html = Smartdown::getInstance()->smartdown->parseAll($this->buildFieldMarkdown($matrix));
        $this->resetTemplatesPath();

        return $html;
    }

    /**
     * Override the default templates path
     */
    private function overrideTemplatesPath()
    {
        $this->view->setTemplatesPath(Craft::$app->path->getSiteTemplatesPath());
    }

    /**
     * Convert the given Matrix field into a Markdown string
     *
     * @param MatrixBlock[] $matrix
     *
     * @return string
     */
    private function buildFieldMarkdown(array $matrix): string
    {
        $blocks = array_map(function ($block) {
            return $this->buildBlockMarkdown($block);
        }, $matrix);

        return implode("\n\n", array_filter($blocks));
    }

    /**
     * Convert the given Matrix block into a Markdown string
     *
     * @param MatrixBlock $block
     *
     * @return string
     */
    private function buildBlockMarkdown(MatrixBlock $block): string
    {
        try {
            $templatePath = implode(
                DIRECTORY_SEPARATOR,
                [Plugin::getInstance()->getSettings()->templatesPath, $block->getType()->handle]
            );

            return $this->view->renderTemplate($templatePath, ['block' => $block]);
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * Reset the templates path to its original value
     */
    private function resetTemplatesPath()
    {
        $this->view->setTemplatesPath($this->originalTemplatesPath);
    }
}
