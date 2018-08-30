<?php

namespace experience\article\models;

use craft\base\Model;
use experience\article\validators\TemplatePathsValidator;

class Settings extends Model
{
    public $templatesPath = '';

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['templatesPath', TemplatePathsValidator::class],
        ]);
    }
}
