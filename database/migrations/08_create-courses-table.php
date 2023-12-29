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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->integer('estimated_students')->nullable();
            $table->integer('actual_students')->nullable();
            $table->integer('fee');
            $table->date('opening_date');
            $table->date('ending_date');
            $table->string('status', 10)->default('NEW');
            $table->string('schedule_dates')->nullable();;
            $table->integer('total_session');
            // Foreign keys
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
