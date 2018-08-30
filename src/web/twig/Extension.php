<?php

namespace experience\article\web\twig;

use Craft;
use craft\elements\db\ElementQuery;
use craft\elements\MatrixBlock;
use experience\article\Article;
use Twig_Extension;
use Twig_Markup;
use Twig_SimpleFilter;

class Extension extends Twig_Extension
{
    /**
     * Return the extension name.
     *
     * @return string
     */
    public function getName()
    {
        return 'Article';
    }

    /**
     * Define the filters provided by the extension
     *
     * @return array
     */
    public function getFilters()
    {
        return ['renderArticle' => new Twig_SimpleFilter('renderArticle', [$this, 'renderArticleFilter'])];
    }

    /**
     * Convert the given "article" Matrix field to Markdown, parse it, and return the result
     *
     * Usage:
     * {{ entry.articleBody|render }}
     *
     * @param ElementQuery|MatrixBlock[] $matrix
     *
     * @return string
     */
    public function renderArticleFilter($matrix): string
    {
        return new Twig_Markup(
            Article::getInstance()->article->render($matrix),
            Craft::$app->view->getTwig()->getCharset()
        );
    }
}
