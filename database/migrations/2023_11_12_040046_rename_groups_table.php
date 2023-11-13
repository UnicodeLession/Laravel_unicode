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
        // sau khi chạy migration
        Schema::rename('groups_after_rename', 'groups');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // nếu rollback thì làm gì
        Schema::rename('groups', 'groups_after_rename');

    }
};
