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
        Schema::disableForeignKeyConstraints();

        Schema::create('inventory_out', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_in_id')->constrained();
            $table->string('batch_code');
            $table->timestamp('transaction_date');
            $table->string('shelf_name');
            $table->integer('stock_out');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_out');
    }
};
