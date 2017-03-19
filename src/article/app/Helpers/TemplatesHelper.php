<?php

/**
 * TemplatePathValidator
 *
 * @package Experience\Article\App\Helpers
 */

namespace Experience\Article\App\Helpers;

use Craft\BaseModel;
use Craft\TemplatesService;

/**
 * Provides utility functions for working with Article templates.
 */
class TemplatesHelper
{
    /**
     * The original templates path.
     *
     * @var string
     */
    protected $originalTemplatesPath;

    /**
     * The plugin settings model.
     *
     * @var BaseModel
     */
    protected $pluginSettings;

    /**
     * The Craft TemplatesService.
     *
     * @var TemplatesService
     */
    protected $templatesService;

    /**
     * Constructor.
     *
     * @param TemplatesService $templatesService
     * @param BaseModel        $pluginSettings
     */
    public function __construct(
        TemplatesService $templatesService,
        BaseModel $pluginSettings
    ) {
        $this->templatesService = $templatesService;
        $this->pluginSettings = $pluginSettings;
        $this->originalTemplatesPath = $this->templatesService->getTemplatesPath();
    }

    /**
     * Overrides the default templates path.
     */
    public function overrideTemplatesPath()
    {
        $path = $this->getConfiguredTemplatesPath();
        $this->templatesService->setTemplatesPath($path);
    }

    /**
     * Returns the full templates path, as configured in the plugin settings.
     *
     * @return string
     */
    protected function getConfiguredTemplatesPath()
    {
        $path = [
            CRAFT_TEMPLATES_PATH,
            $this->pluginSettings->getAttribute('templatesPath'),
        ];

        return realpath(implode('/', $path));
    }

    /**
     * Resets the template path to its original value.
     */
    public function resetTemplatesPath()
    {
        $this->templatesService->setTemplatesPath($this->originalTemplatesPath);
    }
}
