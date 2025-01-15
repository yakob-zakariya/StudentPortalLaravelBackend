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
        Schema::create('teacher_allocations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')->constrained('teachers')
                ->onDelete('cascade');

            $table->foreignId('course_allocation_id')->constrained('batch_course_semesters');
            $table->foreignId('section_id')->cnstrained('sections');

            $table->unique(['teacher_id', 'course_allocation_id', 'section_id'], 'teacher_course_section_unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_course_section_allocations');
    }
};
