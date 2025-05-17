<?php namespace Dashboard;

use Backend;
use System\Classes\MailManager;
use System\Classes\SettingsManager;
use Backend\Models\UserRole;
use Backend\Models\BrandSetting;
use Dashboard\Models\Dashboard;
use October\Rain\Support\ModuleServiceProvider;

/**
 * ServiceProvider for Backend module
 */
class ServiceProvider extends ModuleServiceProvider
{
    /**
     * register the service provider.
     */
    public function register()
    {
        parent::register('dashboard');

        $this->registerSingletons();
    }

    /**
     * boot the module events.
     */
    public function boot()
    {
        parent::boot('backend');
    }

    /**
     * registerSingletons
     */
    protected function registerSingletons()
    {
        $this->app->singleton('dashboard.dashboards', \Dashboard\Classes\DashManager::class);
    }

    /**
     * registerNavigation
     */
    public function registerNavigation()
    {
        return [
            'dashboard' => [
                'label' => 'backend::lang.dashboard.menu_label',
                'icon' => 'icon-dashboard',
                'iconSvg' => 'modules/backend/assets/images/dashboard-icon.svg',
                'url' => Backend::url('dashboard'),
                'permissions' => ['dashboard.*', 'dashboard'],
                'order' => 10
            ]
        ];
    }

    /**
     * registerPermissions
     */
    public function registerPermissions()
    {
        return [
            // Dashboard
            'dashboard' => [
                'label' => 'Access the Dashboard',
                'comment' => 'backend::lang.permissions.access_dashboard',
                'tab' => 'Dashboard',
                'order' => 600
            ],
            'dashboard.manage' => [
                'label' => 'Manage Dashboards',
                'comment' => 'backend::lang.permissions.create_edit_dashboards',
                'tab' => 'Dashboard',
                'order' => 600
            ],
        ];
    }

    /**
     * registerSettings
     */
    public function registerSettings()
    {
        return [];
    }
}
