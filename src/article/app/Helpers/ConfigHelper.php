<?php namespace Experience\Article\App\Helpers;

use Craft\JsonHelper;

class ConfigHelper
{
    /**
     * Retrieves the JSON file at the given path, and returns it as an object.
     *
     * @param string $path
     *
     * @return array
     */
    public function getConfig($path)
    {
        return JsonHelper::decode($this->loadConfig($path), false);
    }

    /**
     * Loads and returns the config file contents.
     *
     * @param string $path
     *
     * @return string
     */
    protected function loadConfig($path)
    {
        return file_get_contents($path);
    }
}
