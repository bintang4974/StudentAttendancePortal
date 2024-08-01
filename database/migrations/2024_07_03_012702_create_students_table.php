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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('activity_id')->unique();
            $table->string('nim');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('university');
            $table->string('gender');
            $table->text('placement');
            $table->string('photo')->nullable();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('position_id')->constrained();
            $table->foreignId('mentor_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
