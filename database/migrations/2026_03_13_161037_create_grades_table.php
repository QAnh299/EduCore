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
        Schema::create('grades', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_id')->constrained()->cascadeOnDelete();
    $table->foreignId('class_id')->constrained('classrooms')->cascadeOnDelete();

    $table->foreignId('assignment_id')
        ->nullable()
        ->constrained('assignments')
        ->cascadeOnDelete();

    $table->string('grade_type'); // homework, minitest, monthly_exam
    $table->integer('score')->nullable();
    $table->text('feedback')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
