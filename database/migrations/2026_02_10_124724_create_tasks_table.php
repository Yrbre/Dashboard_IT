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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user');
            $table->string('priority');
            $table->string('category');
            $table->foreignId('assign_to')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects', 'id')->onDelete('cascade');
            $table->string('status');
            $table->string('delivered');
            $table->foreignId('department_id')->constrained('departments', 'id')->onDelete('cascade');
            $table->boolean('in_timeline')->default(true);
            $table->dateTime('start_task');
            $table->dateTime('end_task')->nullable();
            $table->text('problem')->nullable();
            $table->text('analyst')->nullable();
            $table->text('solution')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
