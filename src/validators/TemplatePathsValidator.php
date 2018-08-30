<?php

namespace experience\article\validators;

use Craft;
use craft\helpers\FileHelper;
use yii\validators\Validator;

class TemplatePathsValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $path = FileHelper::normalizePath(implode(DIRECTORY_SEPARATOR, [
            Craft::$app->path->getSiteTemplatesPath(),
            $model->$attribute,
        ]));

        if (! is_readable($path)) {
            $this->addError($model, $attribute, Craft::t('article', 'Invalid templates path'));
        }
    }
}
