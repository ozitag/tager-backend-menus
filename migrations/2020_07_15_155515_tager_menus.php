<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagerMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tager_menus', function (Blueprint $table) {
            $table->id();

            $table->string('alias');
            $table->string('label')->nullable();

            $table->unique('alias');

            $table->softDeletes();
        });

        Schema::create('tager_menu_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('menu_id');

            $table->string('label');
            $table->string('url')->nullable();
            $table->boolean('open_new_tab')->default(false);
            $table->unsignedInteger('priority');

            $table->nestedSet();

            $table->foreign('menu_id')->references('id')->on('tager_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tager_menu_items');
        Schema::dropIfExists('tager_menus');
    }
}
