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
        Schema::create('time_log', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('company_id');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
            
            $table->uuid('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');

            $table->string('time-in')->nullable(true);
            $table->string('lunch-in')->nullable(true);
            $table->string('lunch-out')->nullable(true);
            $table->string('time-out')->nullable(true);
            $table->json('other')->nullable(true);


            $table->enum('status', ['ACTIVE', 'CLOSED'])->default('ACTIVE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_log', function (Blueprint $table) {
            Schema::dropIfExists('time_log');
        });
    }
};
