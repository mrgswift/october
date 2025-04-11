<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('backend_dashboards', 'owner_type')) {
            Schema::table('backend_dashboards', function(Blueprint $table) {
                $table->string('code')->nullable();
                $table->string('owner_type')->nullable();
                $table->string('owner_field')->nullable();
            });
        }

        if (!Schema::hasColumn('backend_dashboards', 'is_custom')) {
            Schema::table('backend_dashboards', function(Blueprint $table) {
                $table->boolean('is_custom')->default(false);
            });
        }

        if (!Schema::hasColumn('backend_dashboards', 'sort_order')) {
            Schema::table('backend_dashboards', function(Blueprint $table) {
                $table->integer('sort_order')->nullable();
            });
        }

        if (Schema::hasColumn('backend_dashboards', 'global_access')) {
            Schema::table('backend_dashboards', function (Blueprint $table) {
                $table->renameColumn('global_access', 'is_global');
            });
        }

        if (Schema::hasColumn('backend_dashboards', 'slug')) {
            Schema::table('backend_dashboards', function (Blueprint $table) {
                $table->dropUnique('dashboard_slug_unique');
            });

            Schema::table('backend_dashboards', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }

    public function down()
    {
    }
};
