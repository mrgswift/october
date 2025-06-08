<?php namespace Dashboard\Models;

use App;
use System\Models\SettingModel;

/**
 * DashSetting model
 *
 * @package october\dashboard
 * @author Alexey Bobkov, Samuel Georges
 */
class DashSetting extends SettingModel
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string settingsCode is a unique code for these settings
     */
    public $settingsCode = 'dashboard_dash_settings';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    /**
     * initSettingsData for this model. This only executes when the
     * model is first created or reset to default.
     * @return void
     */
    public function initSettingsData()
    {
        $config = App::make('config');
        $this->traffic_stats_enabled = $config->get('cms.internal_traffic_statistics.enabled', true);
        $this->traffic_stats_retention = $config->get('cms.internal_traffic_statistics.retention');
    }
}
