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
            $table->string('ActivityName')->nullable();
            $table->integer('BLDuration')->default(0);
            $table->integer('ActualDuration')->default(0);
            $table->integer('Holiday')->default(0);
            $table->date('BLProjectStart')->nullable();
            $table->date('BLProjectFinish')->nullable();
            $table->date('ActualStart')->nullable();
            $table->date('ActualFinish')->nullable();
            $table->integer('ActivityStatus')->default(0);

            $table->foreignId('department_id')
                  ->nullable()
                  ->constrained('departments')
                  ->onDelete('set null');

            $table->foreignId('wo_number_id')
                  ->nullable()
                  ->constrained('wo_numbers')
                  ->onDelete('set null');

            $table->string('Remarks')->nullable();
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
