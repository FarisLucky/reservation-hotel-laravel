<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("rooms", function (Blueprint $table) {
            $table->unsignedTinyInteger("category_id")->nullable();
            $table->foreign("category_id")->references("category_id")->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('rooms', function (Blueprint $table) {
//            $table->dropColumn('category_id');
//            $table->dropForeign('category_id');
//        });
//        Schema::dropIfExists('categories');
    }
}
