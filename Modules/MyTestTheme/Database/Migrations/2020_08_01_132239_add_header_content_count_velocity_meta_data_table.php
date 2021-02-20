<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeaderContentCountMyTestThemeMetaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_test_theme_meta_data', function (Blueprint $table) {
            $table->text('header_content_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_test_theme_meta_data', function (Blueprint $table) {
            $table->dropColumn('header_content_count');
        });
    }
}
