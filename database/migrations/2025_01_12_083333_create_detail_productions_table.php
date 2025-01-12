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

        Schema::create('detail_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->string('batch_code')->unique();
            $table->timestamp('expiration_date');
            $table->string('shelf_name');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_productions');
    }
};
