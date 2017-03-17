<?php

/**
 * The Article settings model.
 *
 * @package Craft
 * @author Stephen Lewis <stephen@experiencehq.net>
 */

namespace Craft;

/**
 * Class Article_SettingsModel
 *
 * @package Craft
 */
class Article_SettingsModel extends Model
{
    /**
     * Returns the string representation of this model instance.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getAttribute('templatesPath');
    }

    /**
     * Adds a custom validator to the `templatesPath` attribute.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['templatesPath', 'Craft\Article_TemplatePathsValidator'];
        return $rules;
    }
}
