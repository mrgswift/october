<?php namespace Dashboard\Controllers;

use Lang;
use Flash;
use Backend\Classes\SettingsController;
use Dashboard\Models\TrafficStatisticsPageview;
use Dashboard\Classes\TrafficLogger;
use Dashboard\Models\DashSetting;

/**
 * DashSettings controller
 *
 * @todo these items need to be retrofitted
 * - internal_traffic_statistics_enabled / cms.internal_traffic_statistics.enabled
 * - internal_traffic_statistics_timezone / cms.internal_traffic_statistics.timezone
 * - internal_traffic_statistics_retention / cms.internal_traffic_statistics.retention
 *
 * @package october\dashboard
 * @author Alexey Bobkov, Samuel Georges
 */
class DashSettings extends SettingsController
{
    /**
     * @var array Extensions implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
    ];

    /**
     * @var array `FormController` configuration.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var array requiredPermissions required to view this page.
     */
    public $requiredPermissions = ['cms.internal_traffic_statistics'];

    /**
     * @var string settingsItemCode determines the settings code
     */
    public $settingsItemCode = 'dash_settings';

    /**
     * index
     */
    public function index()
    {
        $this->pageTitle = 'dashboard::lang.internal_traffic_statistics.label';

        $enabled = TrafficLogger::isEnabled();
        $this->vars['featureEnabled'] = $enabled;

        if ($enabled) {
            $this->vars['timezone'] = TrafficLogger::getTimezone();

            $retention = TrafficLogger::getRetentionMonths();
            if (!strlen($retention)) {
                $retention = Lang::get('dashboard::lang.internal_traffic_statistics.retention_indefinite');
            }
            else {
                $retention = Lang::get('dashboard::lang.internal_traffic_statistics.retention_mon', ['retention'=>$retention]);
            }

            $this->vars['retention'] = $retention;
        }

        $this->create();
    }

    /**
     * index_onSave
     */
    public function index_onSave()
    {
        return $this->create_onSave();
    }

    /**
     * index_onPurgeData
     */
    public function index_onPurgeData()
    {
        TrafficStatisticsPageview::purgeAllRecords();

        Flash::success(Lang::get('dashboard::lang.internal_traffic_statistics.purge_success'));
    }

    /**
     * formFindModelObject always returns the dash setting instance
     */
    public function formFindModelObject($recordId)
    {
        return DashSetting::instance();
    }
}
