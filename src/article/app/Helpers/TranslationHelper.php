<?php

/**
 * TranslationHelper
 *
 * @package Experience\Article\App\Helpers
 */

namespace Experience\Article\App\Helpers;

/**
 * Provides a simple wrapper around the `Craft::t` static method.
 */
class TranslationHelper
{
    /**
     * Wrapper for Craft's `t` static method. Makes other classes a bit more
     * unit-testable, in theory at least.
     *
     * @return string
     */
    public function translate()
    {
        return forward_static_call_array(
            ['\\Craft\\Craft', 't'],
            func_get_args()
        );
    }
}
