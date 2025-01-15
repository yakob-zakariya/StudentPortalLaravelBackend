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
        Schema::create('semester_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');

            $table->float('total_credit_hours')->nullable();
            $table->float('cummulative_credit_hours')->nullable();

            $table->float('total_etcs')->nullable();
            $table->float('cummulative_etcs')->nullable();

            $table->float('total_grade_points')->nullable();
            $table->float('cummulative_grade_points')->nullable();

            $table->float('semester_gpa')->nullable();
            $table->float('cumulative_gpa')->nullable();

            $table->string('status')->default('Not Determined');

            $table->unique(['student_id', 'semester_id'], 'student_semester_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_registrations');
    }
};
