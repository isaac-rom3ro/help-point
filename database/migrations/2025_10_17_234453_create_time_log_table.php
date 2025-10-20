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

            $table->time('time-in')->nullable(true);
            $table->time('lunch-in')->nullable(true);
            $table->time('lunch-out')->nullable(true);
            $table->time('time-out')->nullable(true);
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
            //
        });
    }
};
