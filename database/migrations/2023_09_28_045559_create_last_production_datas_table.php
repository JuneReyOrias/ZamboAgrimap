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
        Schema::create('last_production_datas', function (Blueprint $table) {
            $table->id('production_id');
            $table->foreignId('farmno_id')->unique()->nullable();
            $table->string('seeds_typed_used',50);
            $table->double('seeds_used_in_kg',15,4);
            $table->string('seed_source',50);
            $table->double('no_of_fertilizer_used_in_bags',15,4);
            $table->double('no_of_pesticides_used_in_l_per_kg',15,4);
            $table->double('no_of_insecticides_used_in_l',15,4);
            $table->string('area_planted',50);
            $table->string('date_planted',50);
            $table->string('date_harvested',50);
            $table->double('yield_tons_per_kg',15,4);
            $table->double('unit_price_palay_per_kg',15,4);
            $table->double('unit_price_rice_per_kg',15,4);
            $table->string('type_of_product',50);
            $table->string('sold_to',50);
            $table->string('if_palay_milled_where',50);
            $table->double('gross_income_palay',15,4);
            $table->double('gross_income_rice',15,4);
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('last_production_datas');
    }
};
