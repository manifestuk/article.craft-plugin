<?php

/**
 * Article template variables.
 *
 * @package Craft
 * @author  Stephen Lewis <stephen@experiencehq.net>
 */

namespace Craft;

/**
 * Class ArticleVariable
 *
 * @package Craft
 */
class ArticleVariable
{
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
        return craft()->article->render($matrixField);
    }
}
