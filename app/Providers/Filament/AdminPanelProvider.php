<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard as PagesDashboard;
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
use lockscreen\FilamentLockscreen\Lockscreen;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use Filament\Navigation\NavigationItem;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('CJIP V3')
            ->brandLogo(asset('https://cjip.jatengprov.go.id/storage/DarFhfrwapwXjwwpQFljtO1wzoTTEs-metaZXNyMEM4SG1Rc3M3OEFBbmxhdWUucG5n-.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('https://cjip.jatengprov.go.id/storage/DarFhfrwapwXjwwpQFljtO1wzoTTEs-metaZXNyMEM4SG1Rc3M3OEFBbmxhdWUucG5n-.png'))
            ->maxContentWidth('full')
            ->sidebarFullyCollapsibleOnDesktop()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->breadcrumbs(true)
            ->userMenuItems([
                MenuItem::make()
                    ->label('Setting')
                    ->url(fn(): string => Profile::getUrl())
                    ->icon('heroicon-o-cog-8-tooth'),
                // ...
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['id', 'en']),

            )
            ->plugin(FilamentProgressbarPlugin::make()->color('#fbbf24'))
            ->plugin(new Lockscreen())
            ->plugins([
                FilamentApexChartsPlugin::make(),
                LightSwitchPlugin::make()
                    ->position(Alignment::TopCenter),
                SpotlightPlugin::make(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
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
                    ->label('Graph')
                    ->icon('heroicon-o-presentation-chart-bar')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-8-tooth')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make('Website')
                    ->label('Website')
                    ->icon('heroicon-s-computer-desktop')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Kepeminatan')
                    ->icon('heroicon-o-window')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Kemitraan')
                    ->icon('heroicon-o-window')
                    ->collapsed()
                    ->collapsible(),
                NavigationGroup::make()
                    ->label('Cjibf')
                    ->icon('heroicon-o-bars-3'),
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
