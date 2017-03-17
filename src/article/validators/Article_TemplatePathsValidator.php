<?php

/**
 * Validates that a string refers to a valid templates directory.
 *
 * @package Craft
 * @author  Stephen Lewis <stephen@experiencehq.net>
 */

namespace Craft;

/**
 * Class Article_TemplatePathsValidator
 *
 * @package Craft
 */
class Article_TemplatePathsValidator extends \CValidator
{
    /**
     * The path validator.
     *
     * @var \Experience\Article\App\Helpers\TemplatePathValidator
     */
    protected $pathValidator;

    /**
     * The translation helper.
     *
     * @var \Experience\Article\App\Helpers\TranslationHelper
     */
    protected $translationHelper;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $container = ArticlePlugin::$container;
        $this->pathValidator = $container->get('TemplatePathValidator');
        $this->translationHelper = $container->get('TranslationHelper');
    }

    /**
     * Validates an attribute.
     *
     * @param \CModel $object
     * @param string  $attribute
     */
    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;

        if ($value && !$this->pathValidator->validatePath($value)) {
            $message = $this->translationHelper->translate('Invalid templates path.');
            $this->addError($object, $attribute, $message);
        }
    }
}
