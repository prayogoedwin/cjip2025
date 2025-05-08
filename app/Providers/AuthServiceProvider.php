<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Cjip\PermintaanFileKajian;
use App\Policies\ActivityPolicy;
use App\Policies\Cjip\PermintaanFileKajianPolicy;
use App\Policies\FolderPolicy;
use App\Policies\MediaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use TomatoPHP\FilamentLogger\Models\Activity;
use TomatoPHP\FilamentMediaManager\Models\Folder;
use TomatoPHP\FilamentMediaManager\Models\Media;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Activity::class => ActivityPolicy::class,
        'App\Models\Cjip\Berita' => 'App\Policies\Cjip\BeritaPolicy',
        'App\Models\Cjip\BiayaAir' => 'App\Policies\Cjip\BiayaAirPolicy',
        'App\Models\Cjip\Faq' => 'App\Policies\Cjip\FaqPolicy',
        'App\Models\Cjip\JenisFaq' => 'App\Policies\Cjip\JenisFaqPolicy',
        'App\Models\Cjip\Pendidikan' => 'App\Policies\Cjip\PendidikanPolicy',
        'App\Models\Cjip\UpahMinimum' => 'App\Policies\Cjip\UpahMinimumPolicy',
        'App\Models\Cjip\JenisKawasan' => 'App\Policies\CjipInvestasi\JenisKawasanPolicy',
        'App\Models\Cjip\BiayaListrik' => 'App\Policies\Cjip\BiayaListrikPolicy',
        'App\Models\Cjip\Event' => 'App\Policies\Cjip\EventPolicy',
        'App\Models\Cjip\InfrastrukturPendukung' => 'App\Policies\Cjip\InfrastrukturPendukungPolicy',
        'App\Models\Cjip\KawasanIndustri' => 'App\Policies\Cjip\KawasanIndustriPolicy',
        'App\Models\Cjip\Loi' => 'App\Policies\Cjip\LoiPolicy',
        'App\Models\Cjip\PerformaInvestasi' => 'App\Policies\Cjip\PerformaInvestasiPolicy',
        'App\Models\Cjip\PertumbuhanInvestasi' => 'App\Policies\Cjip\PertumbuhanInvestasiPolicy',
        'App\Models\Cjip\ProyekInvestasi' => 'App\Policies\Cjip\ProyekInvestasiPolicy',
        'App\Models\Cjip\SektorCjibf' => 'App\Policies\Cjip\SektorCjibfPolicy',
        'App\Models\Cjip\PertumbuhanEkonomi' => 'App\Policies\Cjip\PertumbuhanEkonomiPolicy',
        'App\Models\Cjip\PrivacyPolicy' => 'App\Policies\Cjip\PrivacyPolicyPolicy',
        'App\Models\Cjip\Slider' => 'App\Policies\Cjip\SliderPolicy',
        'App\Models\Cjip\Partner' => 'App\Policies\Cjip\PartnerPolicy',
        'App\Models\Cjip\ProfileKabkota' => 'App\Policies\Cjip\ProfileKabkotaPolicy',
        'App\Models\Cjip\JenisPpp' => 'App\Policies\Cjip\JenisPppPolicy',
        'App\Models\Cjip\PermintaanFileKajian' => 'App\Policies\Cjip\PermintaanFileKajianPolicy',

        'App\Models\Cjibf\CjibfRegisterO3m' => 'App\Policies\Cjibf\CjibfRegisterO3mPolicy',
        'App\Models\Cjibf\Event' => 'App\Policies\Cjip\EventPolicy',

        'App\Models\SiMike\Proyek' => 'App\Policies\SiMike\ProyekPolicy',
        'App\Models\SiMike\RulesSimike' => 'App\Policies\SiMike\RulesSimikePolicy',

        'App\Models\SiRusa\Bap' => 'App\Policies\SiRusa\BapPolicy',
        'App\Models\SiRusa\Nib' => 'App\Policies\SiRusa\NibPolicy',
        'App\Models\SiRusa\Rilis' => 'App\Policies\SiRusa\RilisPolicy',

        'App\Models\Kepeminatan\Smtp' => 'App\Policies\Kepeminatan\SmtpPolicy',
        'App\Models\Kepeminatan\TemplateEmail' => 'App\Policies\Kepeminatan\TemplateEmailPolicy',

        'App\Models\Simike\Report' => 'App\Policies\Simike\ReportPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
