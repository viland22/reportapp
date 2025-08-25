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
        Schema::table('activity', function (Blueprint $table) {
            $table->renameColumn('Holiday', 'BLHoliday');
            $table->renameColumn('Remarks', 'RemarkStart');

            $table->integer('ActualHoliday')->default(0)->after('BLHoliday');
            $table->string('RemarkFinish', 255)->nullable()->after('RemarkStart');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity', function (Blueprint $table) {
             $table->renameColumn('BLHoliday', 'Holiday');
            $table->renameColumn('RemarkStart', 'Remarks');

            $table->dropColumn('ActualHoliday');
            $table->dropColumn('RemarkFinish');
        });
    }
};
