<?php namespace Experience\Article\App\ServiceProviders;

use Experience\Article\App\Helpers\TemplatePathValidator;
use Experience\Article\App\Helpers\TranslationHelper;
use League\Container\ContainerInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Experience\Article\App\Utilities\Logger;

class PluginServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        'Logger',
        'TemplatePathValidator',
        'TranslationHelper',
    ];

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Craft\ConsoleApp|\Craft\WebApp
     */
    protected $craft;

    /**
     * Constructor.
     *
     * @param \Craft\ConsoleApp|\Craft\WebApp $craft
     */
    public function __construct($craft)
    {
        $this->craft = $craft;
    }

    /**
     * Registers items with the container.
     */
    public function register()
    {
        $this->initializeLogger();
        $this->initializeTemplatePathValidator();
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
    protected function initializeTemplatePathValidator()
    {
        $this->container->add(
            'TemplatePathValidator',
            new TemplatePathValidator(CRAFT_TEMPLATES_PATH)
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
