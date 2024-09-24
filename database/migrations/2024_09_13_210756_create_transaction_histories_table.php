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
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->text('transaction_id');
            $table->string('product');
            $table->integer('quantity');
            $table->enum('status', ['in','out','return']);
            $table->string('supplier')->nullable();
            $table->date('transaction_date');
            $table->string('create_by_user');
            $table->text('description')->nullable();
            $table->text('return_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};
