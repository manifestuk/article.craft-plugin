<?php namespace Experience\Article\App\ServiceProviders;

use Craft\ArticlePlugin;
use Experience\Article\App\Helpers\TemplatesHelper;
use Experience\Article\App\Helpers\TranslationHelper;
use League\Container\ContainerInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Experience\Article\App\Utilities\Logger;

class PluginServiceProvider extends AbstractServiceProvider
{
    /**
     * The keys stored in the IoC container.
     *
     * @var array
     */
    protected $provides = ['Logger', 'TemplatesHelper', 'TranslationHelper'];

    /**
     * The IoC container.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * The Craft application.
     *
     * @var \Craft\ConsoleApp|\Craft\WebApp
     */
    protected $craft;

    /**
     * The main plugin.
     *
     * @var ArticlePlugin
     */
    protected $plugin;

    /**
     * Constructor.
     *
     * @param \Craft\ConsoleApp|\Craft\WebApp $craft
     * @param ArticlePlugin                   $plugin
     */
    public function __construct($craft, ArticlePlugin $plugin)
    {
        $this->craft = $craft;
        $this->plugin = $plugin;
    }

    /**
     * Registers items with the container.
     */
    public function register()
    {
        $this->initializeLogger();
        $this->initializeTemplatesHelper();
        $this->initializeTranslationHelper();
    }

    /**
     * Initialises the logger.
     */
    protected function initializeLogger()
    {
        $this->container->add('Logger', new Logger);
    }

    /**
     * Initialises the path validator.
     */
    protected function initializeTemplatesHelper()
    {
        $this->container->add(
            'TemplatesHelper',
            new TemplatesHelper(
                $this->craft->templates,
                $this->plugin->getSettings()
            )
        );
    }

    /**
     * Initialises the translation helper.
     */
    protected function initializeTranslationHelper()
    {
        $this->container->add('TranslationHelper', new TranslationHelper);
    }
}
