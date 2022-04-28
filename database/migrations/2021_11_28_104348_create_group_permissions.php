<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_permissions', function (Blueprint $table) {
            $table->id('ID');
            $table->string('Group_Name');
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_group_permission')->nullable()->after('description');
            $table->foreign('ID_group_permission')->references('ID')->on('group_permissions')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_permissions');
        // Schema::table('permissions', function($table) {
        //     $table->dropColumn('ID_group_permission');
        // });
    }
}
