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
        Schema::table('progressactivity', function (Blueprint $table) {
            $table->dropUnique(['ActivityId']);
            $table->dropSoftDeletes();
            $table->renameColumn('ActivityId', 'Activity_Id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progressactivity', function (Blueprint $table) {
            $table->unique('ActivityId');
            $table->softDeletes();
            $table->renameColumn('Activity_Id', 'ActivityId');
        });
    }
};
