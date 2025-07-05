<?php

namespace App\Providers\Filament;

use App\Filament\AvatarProviders\GetAvatarProvider;
use App\Filament\Pages\Profile;
use App\Http\Middleware\RedirectIfNotFilamentAdmin;
use App\Livewire\Auth\LoginPage;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Enums\Platform;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(LoginPage::class)
            ->colors([
                'primary' => Color::hex('#0105da'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                    // Authenticate::class,
                RedirectIfNotFilamentAdmin::class,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Home')
                    ->icon('heroicon-o-home')
                    ->url('/', shouldOpenInNewTab: true)
            ])
            ->defaultAvatarProvider(GetAvatarProvider::class)
            // ->spa()
            // ->spaUrlExceptions(fn(): array => [
            //     '*/admin/products/*',
            //     '*/admin/articles/*',
            //     '*/admin/trainings/*',
            // ])
            ->unsavedChangesAlerts()
            ->profile(Profile::class, isSimple: false)
            ->breadcrumbs(false)
            ->databaseNotifications()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->globalSearchDebounce('750ms')
            ->globalSearchFieldSuffix(fn(): ?string => match (Platform::detect()) {
                Platform::Windows, Platform::Linux => 'CTRL+K',
                Platform::Mac => '⌘K',
                default => null,
            })
            ->navigationItems([
                NavigationItem::make('Ubah Profil')
                    ->sort(20)
                    ->isActiveWhen(fn() => request()->routeIs('filament.admin.auth.profile'))
                    ->url(fn() => route('filament.admin.auth.profile', absolute: true))
                    ->icon('heroicon-o-user'),
            ])
            ->plugins([
                EasyFooterPlugin::make()
                    ->withFooterPosition('footer')
                    ->withLoadTime('Halaman ini dimuat pada'),
            ])
        ;
    }
}
