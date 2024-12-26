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
        Schema::create('course_assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_registration_id')->constrained('course_registrations')->onDelete('cascade')->unique();
            $table->float('continuous_assesment')->nullable();
            $table->float('mid_term_exam')->nullable();
            $table->float('final_exam')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_assesments');
    }
};
