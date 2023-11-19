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
        Schema::create('products', function (Blueprint $table) {
//            $table->id(); // bigint; autoincrement; primarykey, tên field = id
            $table->increments('id'); // int, auto_increment, primary_key, tên field = id
            $table->string('name', 200);//varchar(200)
            $table->text('description')->nullable(); // kiểu text, cho phép null
            $table->timestamps(); // tạo created_at và updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
