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
        //
        Schema::table('products', function (Blueprint $table){
            // xoá default field status
            $table->boolean('status')->default(null)->change();

            // xóa null field content
            $table->text('content')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('products', function (Blueprint $table){
            // xoá default field status
            $table->boolean('status')->default(0)->change();

            // xóa null field content
            $table->text('content')->nullable()->change();
        });
    }
};
