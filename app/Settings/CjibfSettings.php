<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CjibfSettings extends Settings
{

    public string $site_title;
    public string $site_desc;
    public string $site_tagline;
    public string $logo;
    public array $image;
    public array $button;

    public static function group(): string
    {
        return 'cjibf';
    }

    public static function casts(): array
    {
        return [
            '$button',
            '$image'
        ];
    }
}