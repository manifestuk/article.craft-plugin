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
     * The "article" templates path, as configured in the plugin settings.
     *
     * @var string
     */
    protected $articleTemplatesPath;

    /**
     * The original templates path.
     *
     * @var string
     */
    protected $originalTemplatesPath;

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
        $this->articleTemplatesPath = $pluginSettings->getAttribute('templatesPath');
        $this->originalTemplatesPath = $this->templatesService->getTemplatesPath();
    }

    /**
     * Overrides the default templates path.
     */
    public function overrideTemplatesPath()
    {
        $this->templatesService->setTemplatesPath($this->getSiteTemplatesPath());
    }

    /**
     * Returns the full path to the site templates.
     *
     * @return string
     */
    protected function getSiteTemplatesPath()
    {
        return CRAFT_TEMPLATES_PATH;
    }

    /**
     * Resets the template path to its original value.
     */
    public function resetTemplatesPath()
    {
        $this->templatesService->setTemplatesPath($this->originalTemplatesPath);
    }

    /**
     * Returns the path to the template identified by the given handle,
     * relative to the site templates directory.
     *
     * @param string $handle
     *
     * @return string
     */
    public function getBlockTemplatePath($handle)
    {
        return implode('/', [$this->articleTemplatesPath, $handle]);
    }
}
