<?php namespace Dashboard\Controllers;

use Lang;
use Flash;
use Backend\Classes\SettingsController;
use Dashboard\Models\TrafficStatisticsPageview;
use Dashboard\Classes\TrafficLogger;

/**
 * Internal Traffic Statistics settings controller
 *
 * @package october\dashboard
 * @author Alexey Bobkov, Samuel Georges
 */
class InternalTrafficStatisticsSettings extends SettingsController
{
    /**
     * @var array requiredPermissions required to view this page.
     */
    public $requiredPermissions = ['cms.internal_traffic_statistics'];

    /**
     * @var string settingsItemCode determines the settings code
     */
    public $settingsItemCode = 'internal_traffic_statistics';

    /**
     * __construct
     */
    public function __construct()
    {
        $this->addCss('/modules/system/assets/css/settings/settings.css', 'global');

        parent::__construct();
    }

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
    }

    /**
     * index_onPurgeData
     */
    public function index_onPurgeData()
    {
        TrafficStatisticsPageview::purgeAllRecords();

        Flash::success(Lang::get('dashboard::lang.internal_traffic_statistics.purge_success'));
    }
}
