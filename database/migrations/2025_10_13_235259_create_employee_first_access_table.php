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
        Schema::create('employee_first_access', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['PENDING', 'DONE'])->nullable(false)->default('PENDING');

            $table->uuid('company_id');
            $table->uuid('employee_id');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_first_access');
    }
};
