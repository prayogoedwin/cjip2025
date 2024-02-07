<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    // id

    public string $site_name;
    public string $site_tagline;
    public string $site_desc;
    public string $logo;

    public array $slider;

    public string $opening_title;
    public string $opening_desc;
    public string $opening_image;
    public array $opening_button;

    public string $graph_title_pert;
    public string $graph_desc_pert;
    public string $graph_title_perf;
    public string $graph_desc_perf;

    public string $peluang_title;
    public string $peluang_desc;
    public array $peluang_button;
    public string $peluang_image;

    public string $jateng_title;
    public string $jateng_desc;
    public string $jateng_image;

    public string $sdm_title;
    public string $sdm_desc;
    public string $sdm_image;

    public string $umk_title;
    public string $umk_desc;
    public string $umk_image;

    public string $biaya_title;
    public string $biaya_desc;
    public string $biaya_image;

    // end

    public string $site_name_en;
    public string $site_tagline_en;
    public string $site_desc_en;
    public string $logo_en;

    // public array $slider_en;

    public string $opening_title_en;
    public string $opening_desc_en;
    public string $opening_image_en;
    public array $opening_button_en;

    public string $graph_title_pert_en;
    public string $graph_desc_pert_en;
    public string $graph_title_perf_en;
    public string $graph_desc_perf_en;

    public string $peluang_title_en;
    public string $peluang_desc_en;
    public array $peluang_button_en;
    public string $peluang_image_en;

    public string $jateng_title_en;
    public string $jateng_desc_en;
    public string $jateng_image_en;

    public string $sdm_title_en;
    public string $sdm_desc_en;
    public string $sdm_image_en;

    public string $umk_title_en;
    public string $umk_desc_en;
    public string $umk_image_en;

    public string $biaya_title_en;
    public string $biaya_desc_en;
    public string $biaya_image_en;

    public string $body;
    public string $body_en;

    public array $services;
    public array $services_en;

    public static function group(): string
    {
        return 'general';
    }

    public static function casts(): array
    {
        return [
            '$slider', // not active
            '$opening_button',
            '$peluang_button',
            '$opening_button_en',
            '$peluang_button_en',
            '$services',
            '$services_en',

        ];
    }
}
