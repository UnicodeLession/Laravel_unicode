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
        if(!Schema::hasTable('posts')){
            // nếu không tồn tại thì tạo
            Schema::create('posts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->integer('user_id')->unsigned(); //phải có người đăng bài
                $table->timestamps(); // còn timestamps có s cuối thì sẽ tạo created_at và updated_at
            });
        }
        if(!Schema::hasColumn('posts', 'title')){
            Schema::create('posts', function (Blueprint $table) {
                $table->string('title', 200);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
