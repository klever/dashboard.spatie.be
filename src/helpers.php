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
