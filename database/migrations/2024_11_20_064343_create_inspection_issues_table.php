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
        Schema::create('inspection_issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_form_id')->constrained('inspection_forms')->onDelete('cascade');
            $table->string('description');
            $table->integer('quantity_affected');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_issues');
    }
};