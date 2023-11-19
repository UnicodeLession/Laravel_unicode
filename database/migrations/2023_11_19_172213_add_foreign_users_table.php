<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // thiết lập khóa ngoại
        Schema::table('users', function (Blueprint $table){
            $table->foreign('group_id')
                ->references('id')
                ->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // xóa khóa ngoại: <table>_<field>_foreign
        Schema::table('users', function (Blueprint $table){
            $table->dropForeign('users_group_id_foreign');
        });
    }
};
