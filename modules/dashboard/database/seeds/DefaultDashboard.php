<?php namespace Dashboard\Database\Seeds;

use Dashboard\Models\Dashboard;
use Seeder;

/**
 * DefaultDashboard
 */
class DefaultDashboard extends Seeder
{
    public function run()
    {
        $content = file_get_contents(__DIR__.'/default-dashboard.json');
        Dashboard::import($content, null, true);
    }
}
