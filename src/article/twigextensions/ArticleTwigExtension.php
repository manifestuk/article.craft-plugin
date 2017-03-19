<?php namespace Craft;

use Twig_Extension;
use Twig_Markup;
use Twig_SimpleFilter;

class ArticleTwigExtension extends Twig_Extension
{
    /**
     * Returns the Twig extension name.
     *
     * @return string
     */
    public function getName()
    {
        return 'Article';
    }

    /**
     * Returns an associative array of Twig filters provided by the extension.
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            'renderArticle' => new Twig_SimpleFilter(
                'renderArticle',
                [$this, 'renderArticleFilter']
            )
        ];
    }

    /**
     * Converts the given "article" Matrix field to Markdown, parses it, and
     * returns the result.
     *
     * Usage:
     * {{ entry.articleBody|render }}
     *
     * @param ElementCriteriaModel|MatrixBlockModel[] $matrixField
     *
     * @return string
     */
    public function renderArticleFilter($matrixField)
    {
        return new Twig_Markup(
            craft()->article->render($matrixField),
            $this->getTwigCharset()
        );
    }

    /**
     * Returns the Twig character set.
     *
     * @return string
     */
    protected function getTwigCharset()
    {
        return craft()->templates->getTwig()->getCharset();
    }
}
