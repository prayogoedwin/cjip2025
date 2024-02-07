<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{
    // id
    public string $copyright;
    public string $contact;
    public string $alamat;
    public string $email;
    public array $links;
    public array $medsos;
    // en
    public string $copyright_en;
    public string $contact_en;
    public string $alamat_en;
    public string $email_en;
    public array $links_en;
    public array $medsos_en;

    public static function group(): string
    {
        return 'footer';
    }

    public static function casts(): array
    {
        return [
            '$links',
            '$medsos',
            '$links_en',
            '$medsos_en',
        ];
    }
}
