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
        Schema::create('leave_form', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id'); // foreign key to employees table
        $table->string('type_leave'); // Sick, Vacation, Emergency, etc.
        $table->string('designation'); // Designation of the employee
        $table->string('department'); // Department of the employee
        $table->date('start_date');
        $table->date('end_date');
        $table->integer('total_days');
        $table->string('reason')->nullable();
        $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
        $table->timestamps();

        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_form');
    }
};
