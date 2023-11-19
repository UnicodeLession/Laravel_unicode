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
        Schema::table('users', function (Blueprint $table){
            // không tồn tại field group_id
            if(!Schema::hasColumn('users', 'group_id')){
                $table->bigInteger('group_id')
                    ->after('email')
                    ->unsigned(); // tạo field group_id
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table){
            // nếu tồn tại column thì rollback sẽ drop column group_id
            if(Schema::hasColumn('users', 'group_id')){
                $table->dropColumn('group_id');
            }
        });
    }
};
