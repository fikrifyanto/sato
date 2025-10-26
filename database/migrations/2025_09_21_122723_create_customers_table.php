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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 120);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable()->unique();
            $table->string('profile_photo')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->text('bio')->nullable();
            $table->timestamp('banned_until')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
