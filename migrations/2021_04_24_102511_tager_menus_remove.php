<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TagerMenusRemove extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $menusDb = DB::select('SELECT * FROM tager_menus');
        $menus = [];
        foreach ($menusDb as $menu) {
            $menus[$menu->id] = $menu->alias;
        }

        $itemsDb = DB::select('SELECT * FROM tager_menu_items');

        Schema::table('tager_menu_items', function (Blueprint $table) {
            $table->dropForeign('tager_menu_items_menu_id_foreign');
        });

        Schema::table('tager_menu_items', function (Blueprint $table) {
            $table->dropColumn('menu_id');
            $table->string('menu_alias')->after('id');
            $table->index('menu_alias');
        });

        foreach($itemsDb as $item){
            if(!isset($menus[$item->menu_id]))continue;

            DB::update('UPDATE tager_menu_items SET menu_alias = :menu_alias WHERE id = :id', [
                ':menu_alias' => $menus[$item->menu_id],
                ':id' => $item->id
            ]);
        }

        Schema::dropIfExists('tager_menus');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
