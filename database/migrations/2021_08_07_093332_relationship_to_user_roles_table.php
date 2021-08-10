<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationshipToUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_roles', function (Blueprint $table) {
            if (Schema::hasColumn('user_roles', 'user_id')) {
                $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            }

            if (Schema::hasColumn('user_roles', 'role_id')) {
                $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
