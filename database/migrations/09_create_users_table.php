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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('password');
            $table->string('gender', 6);
            $table->date('birthday');
            $table->string('phone_number', 11)->unique();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('hometown')->nullable();
            $table->string('address')->nullable();
            $table->string('workplace')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->rememberToken();

            // Foreign keys
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
