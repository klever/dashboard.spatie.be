<?php

if (! function_exists('markdownToHtml')) {
    function markdownToHtml(string $markdown)
    {
        return (new Parsedown)->text($markdown);
    }
}

if (! function_exists('usingNodeServer')) {
    function usingNodeServer(): bool
    {
        return config('broadcasting.default') === 'laravel-echo-server';
    }
}

if (! function_exists('mixOrPlain')) {
    function mixOrPlain($name) {
        try {
            return mix($name);
        } catch (\Exception $e) {
            return $name;
        }
    }
}
