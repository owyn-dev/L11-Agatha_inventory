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

        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_user_id')->constrained('users');
            $table->timestamp('production_request_date');
            $table->foreignId('production_user_id')->nullable()->constrained('users');
            $table->timestamp('production_date')->nullable();
            $table->enum('status', ["waiting_for_response","in_progress","pending_approval","approval","rejected"])->default('waiting_for_response');
            $table->string('note');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
