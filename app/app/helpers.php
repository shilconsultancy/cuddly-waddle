<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    /**
     * Get a setting value from the database.
     * Caches the settings for performance.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        $settings = Cache::rememberForever('settings', function () {
            // Use the fully qualified namespace here to avoid scope issues
            return \App\Models\Setting::all()->pluck('value', 'key')->all();
        });

        return $settings[$key] ?? $default;
    }
}