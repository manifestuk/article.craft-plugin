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
        $this->translationHelper = ArticlePlugin::$container->get('TranslationHelper');
    }

    /**
     * Validates an attribute.
     *
     * @param \CModel $object
     * @param string  $attribute
     */
    protected function validateAttribute($object, $attribute)
    {
        $templatesPath = $object->$attribute;
        $fullPath = implode('/', [CRAFT_TEMPLATES_PATH, $templatesPath]);

        if (!IOHelper::folderExists($fullPath)) {
            $message = $this->translationHelper->translate('Invalid templates path.');
            $this->addError($object, $attribute, $message);
        }
    }
}
