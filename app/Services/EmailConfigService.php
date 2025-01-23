<?php

// app/Services/EmailConfigService.php
namespace App\Services;

use App\Models\Kepeminatan\Smtp;
use Illuminate\Support\Facades\Config;

class EmailConfigService
{
    public function applyEmailConfig($modul)
    {
        // ambil config sesuai modul
        $emailConfig = Smtp::where('modul', $modul)->first();

        if (!$emailConfig) {
            throw new \Exception('Email configuration not found.');
        }

        // set config
        $config = [
            'transport'  => $emailConfig->mail_mailer,
            'host'       => $emailConfig->mail_host,
            'port'       => $emailConfig->mail_port,
            'username'   => $emailConfig->mail_username,
            'password'   => $emailConfig->mail_password,
            'encryption' => $emailConfig->mail_encryption,
        ];

        Config::set('mail.mailers.smtp', $config);
        Config::set('mail.default', 'smtp');
        Config::set('mail.from.address', $emailConfig->mail_from_address);
        Config::set('mail.from.name', $emailConfig->mail_from_name);
    }
}
