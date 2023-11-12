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
            // không tồn tại field content
            if(!Schema::hasColumn('products', 'content')){
                $table->text('content')
                    ->after('name')
                    ->nullable();
            }
        });
        Schema::table('products', function (Blueprint $table){
            // không tồn tại field status
            if(!Schema::hasColumn('products', 'status')){
                $table->boolean('status')
                    ->after('content')
                    ->default(0)
                    ->comment('Trạng thái: 0 - chưa xác thực; Trạng thái: 1 - đã xác thực');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('products', function (Blueprint $table){
            // nếu tồn tại column thì rollback sẽ drop column content
            if(Schema::hasColumn('products', 'content')){
                $table->dropColumn('content');
            }
            // nếu tồn tại column thì rollback sẽ drop column status
            if(Schema::hasColumn('products', 'status')){
                $table->dropColumn('status');
            }
        });
    }
};
