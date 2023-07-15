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
        Schema::create('seed', function (Blueprint $table) {
            $table->id('seed_id');
            $table->string('unit');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('total_rice_cost');
          
        
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed');
    }
};