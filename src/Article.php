<?php

namespace experience\article;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use experience\article\models\Settings;
use experience\article\services\Article as ArticleService;
use experience\article\web\twig\Extension;
use yii\base\Event;

class Article extends Plugin
{
    public $hasCpSettings = true;

    public function init()
    {
        parent::init();

        $this->registerService();
        $this->registerTemplateService();
        $this->registerTwigExtension();
    }

    private function registerService()
    {
        $this->setComponents(['article' => ArticleService::class]);
    }

    private function registerTemplateService()
    {
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function (Event $event) {
            $event->sender->set('article', ArticleService::class);
        });
    }

    private function registerTwigExtension()
    {
        if (Craft::$app->request->getIsSiteRequest()) {
            Craft::$app->view->registerTwigExtension(new Extension());
        }
    }

    protected function createSettingsModel()
    {
        return new Settings();
    }

    protected function settingsHtml()
    {
        return Craft::$app->view->renderTemplate('article/settings', [
            'settings'           => $this->getSettings(),
            'templatesDirectory' => Craft::$app->path->getSiteTemplatesPath(),
        ]);
    }
}
