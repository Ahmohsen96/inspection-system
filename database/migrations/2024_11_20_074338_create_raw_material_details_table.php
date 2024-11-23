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
        Schema::create('raw_material_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('raw_material_id')->constrained()->onDelete('cascade'); // Foreign key to raw_materials table
        $table->string('material_name'); // E.g., G.I. Coil, Black Sheet
        $table->string('grade')->nullable();
        $table->integer('quantity')->nullable();
        $table->enum('status', ['Checked', 'Rejected'])->nullable();
        $table->text('remarks')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_material_details');
    }
};
