<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus_tables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("menu_id");
            $table->bigInteger("sales_id");
            $table->foreign("menu_id")->references("id")->on("menus")->onDelete("cascade");
            $table->foreign("sales_id")->references("id")->on("sales")->onDelete("cascade");
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
        Schema::dropIfExists('menus_tables');
    }
}
