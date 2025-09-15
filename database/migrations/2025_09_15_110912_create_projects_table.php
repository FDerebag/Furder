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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->text('detailed_description')->nullable();
            $table->string('client')->nullable();
            $table->string('category'); // e.g., 'web', 'mobile', 'desktop'
            $table->json('technologies'); // JSON array of tech stack
            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('image_path')->nullable();
            $table->json('gallery')->nullable(); // JSON array of image paths
            $table->integer('duration_days')->nullable();
            $table->date('completed_at')->nullable();
            $table->string('status')->default('completed'); // completed, ongoing, paused
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
