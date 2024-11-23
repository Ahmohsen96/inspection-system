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
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_form_id')->constrained()->onDelete('cascade');
            $table->string('manager_name');
            $table->string('manager_signature')->nullable();
            $table->date('manager_signed_at')->nullable();
            $table->string('store_name');
            $table->string('store_signature')->nullable();
            $table->date('store_signed_at')->nullable();
            $table->string('quality_inspector_name');
            $table->string('quality_inspector_signature')->nullable();
            $table->date('quality_inspector_signed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
