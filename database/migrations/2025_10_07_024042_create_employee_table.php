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
        Schema::create('employee', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name')->nullable(false);
            $table->string('cpf')->nullable(false)->unique();
            $table->string('email')->nullable(true)->unique();
            $table->string('whatsapp')->nullable(true)->unique();
            $table->string('password')->nullable(false);
            
            $table->string('role')->nullable(false);
            $table->integer('assigned_hours')->nullable(false)->default(0);
            
            $table->uuid('company_id');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
