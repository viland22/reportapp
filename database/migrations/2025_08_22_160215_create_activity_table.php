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
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->string('ActivityId')->unique();
            $table->integer('ActivityName')->nullable();
            $table->integer('BLDuration')->nullable();
            $table->integer('ActualDuration')->nullable();
            $table->date('BLProjectStart')->nullable();
            $table->date('BLProjectFinish')->nullable();
            $table->date('ActualStart')->nullable();
            $table->date('ActualFinish')->nullable();
            $table->integer('ActivityStatus')->default(0);
            $table->integer('Department')->nullable();
            $table->string('remarks')->nullable();
            $table->string('WoNumber')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity');
    }
};
