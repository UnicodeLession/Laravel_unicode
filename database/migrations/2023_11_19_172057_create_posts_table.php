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
                $table->id();
                $table->string('title', 200);
                $table->text('content');
                $table->boolean('status'); // giá trị mặc định là 0 và sau khi sửa là 1
                $table->timestamp('published_at'); // chú ý timestamp không có s thì sẽ tạo 1 cột có datatype là timestamp
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
