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
        Schema::create('output_temporaries', function (Blueprint $table) {
            $table->string('date')->nullable();
            $table->string('bpm_no')->nullable();
            $table->string('project_no')->nullable();
            $table->string('description')->nullable();
            $table->string('item_no')->nullable();
            $table->string('item_description')->nullable();
            $table->string('qty_out')->nullable();
            $table->string('unit')->nullable();
            $table->string('warehouse_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('output_temporaries');
    }
};
