<?php

namespace App\Providers\Filament;


use App\Filament\Pages\General\Profile;
use App\Livewire\Cjibf\Dashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Navigation\MenuItem;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\SpatieLaravelTranslatablePlugin;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Awcodes\LightSwitch\Enums\Alignment;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use lockscreen\FilamentLockscreen\Lockscreen;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use Filament\Navigation\NavigationItem;
use App\Filament\Pages\Dashboard as PagesDashboard;
use Kenepa\Banner\BannerPlugin;
use TomatoPHP\FilamentLogger\FilamentLoggerPlugin;
use TomatoPHP\FilamentMediaManager\FilamentMediaManagerPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->sidebarWidth('17rem')
            ->brandName('Central Java Investment Platform')
            ->brandLogo(asset('images/cjip-small.svg'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/cjip-small.svg'))
            ->maxContentWidth('full')
            ->sidebarFullyCollapsibleOnDesktop()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->breadcrumbs(true)
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profile')
                    ->url(fn(): string => Profile::getUrl())
                    ->icon('heroicon-s-user'),
                // ...
            ])
            ->colors([
                'primary' => '#16a34a',
            ])
            ->plugin(new Lockscreen())
            ->plugins([
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 2
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
                BannerPlugin::make()
                    ->persistsBannersInDatabase()
                    ->navigationGroup('Super Admin')
                    ->bannerManagerAccessPermission('banner-manager')
                    ->navigationIcon('')->navigationSort(10),
                SpotlightPlugin::make(),
                // FilamentProgressbarPlugin::make()->color('#16a34a'),
                SpatieLaravelTranslatablePlugin::make()->defaultLocales(['id', 'en']),
                FilamentLoggerPlugin::make(),
                FilamentApexChartsPlugin::make(),
                LightSwitchPlugin::make()->position(Alignment::TopCenter),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                PagesDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Super Admin')
                    ->icon('heroicon-o-cog-8-tooth')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make('Website')
                    ->label('Website')
                    ->icon('heroicon-s-computer-desktop')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Graph')
                    ->icon('heroicon-o-presentation-chart-bar')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Si-Mike')
                    ->icon('heroicon-o-squares-2x2')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Si-Rusa')
                    ->icon('heroicon-o-squares-2x2')
                    ->collapsed()
                    ->collapsible(),
            ])
            ->authMiddleware([
                Authenticate::class,
                Locker::class,
            ]);
    }
}
