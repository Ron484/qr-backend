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
        Schema::create('scan_logs', function (Blueprint $table) {
            $table->id();
            $table->string('registration_id', 8);
            $table->boolean('is_scanned')->default(false);
            $table->dateTime('scan_time')->nullable();
            $table->timestamps(); 
            $table->foreign('registration_id')
            ->references('registration_id')
            ->on('registered_users')
            ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scan_logs');
    }
};
