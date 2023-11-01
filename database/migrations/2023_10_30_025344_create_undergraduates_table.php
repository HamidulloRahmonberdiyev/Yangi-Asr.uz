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
        Schema::create('undergraduates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->string('title_uz');
            $table->string('title_ru');
            $table->string('title_en');
            $table->text('text_uz')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_en')->nullable();
            $table->text('duration_uz')->nullable();
            $table->text('duration_ru')->nullable();
            $table->text('duration_en')->nullable();
            $table->text('video')->nullable();
            $table->string('contract_amount');
            $table->string('course_type');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undergraduates');
    }
};
