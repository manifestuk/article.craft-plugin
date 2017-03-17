<?php namespace Experience\Article\App\ServiceProviders;

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
    }

    /**
     * Initialises the logger.
     */
    protected function initializeLogger()
    {
        $this->container->add('Logger', new Logger);
    }
}
