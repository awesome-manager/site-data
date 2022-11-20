<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    private $tables = [
        'menu_items',
        'site_pages',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                continue;
            }

            if (method_exists($this, $method = Str::camel("up_{$table}"))) {
                $this->{$method}();
            }
        }
    }

    private function upMenuItems()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255)->nullable();
            $table->uuid('site_page_id');
            $table->string('icon', 100)->nullable();
            $table->boolean('is_active')->default(false);
            $table->smallInteger('sort')->default(500);
            $table->timestamps();
        });
    }

    private function upSitePages()
    {
        Schema::create('site_pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->string('code', 100)->unique();
            $table->string('link')->unique();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
