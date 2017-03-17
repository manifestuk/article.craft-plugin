<?php

/**
 * TemplatePathValidator
 *
 * @package Experience\Article\App\Helpers
 */

namespace Experience\Article\App\Helpers;

/**
 * Validates that a path exists.
 */
class TemplatePathValidator
{
    /**
     * The path to the templates directory.
     *
     * @var string
     */
    protected $templatesPath;

    /**
     * Constructor.
     *
     * @param string $templatesPath
     */
    public function __construct($templatesPath)
    {
        $this->templatesPath = rtrim($templatesPath, '/') . '/';
    }

    /**
     * Returns a boolean indicating whether the given path exists within the
     * templates directory.
     *
     * @param string $path
     *
     * @return bool
     */
    public function validatePath($path)
    {
        $path = $this->templatesPath . trim($path, '/');
        return is_dir($path);
    }
}
