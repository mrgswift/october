<?php namespace Cms\Database\Seeds;

use Seeder;

/**
 * SeedDemoTrafficData
 */
class SeedDemoTrafficData extends Seeder
{
    public function run()
    {
        \Cms\Classes\CmsDemoTrafficDataGenerator::instance()->generate();
    }
}
