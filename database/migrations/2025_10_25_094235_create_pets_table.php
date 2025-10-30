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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->json('images');
            $table->string('name');
            $table->string('species')->nullable();
            $table->string('breed')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('color')->nullable();
            $table->decimal('weight', 5)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'adopted'])->default('available');
            $table->boolean('vaccinated')->default(false);
            $table->decimal('price', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
