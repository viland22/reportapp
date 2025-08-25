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
        Schema::create('progressactivity', function (Blueprint $table) {
            $table->id();
            $table->string('ActivityId')->unique();
            $table->date('ProgressDate')->nullable();
            $table->integer('ProgressPercent')->default(0);
            $table->string('ProgressNote')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progressactivity');
    }
};
