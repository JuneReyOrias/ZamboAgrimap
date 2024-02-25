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
        Schema::create('coco_farm_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coco_personal_informations_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('polygons_id')->nullable();
            $table->foreignId('parcellary_boundaries_id')->nullable();
            
            $table->string('tenurial_status',50);
            $table->string('rice_farm_address',50);
            $table->double('no_of_years_as_farmers',8,2);
            $table->double('gps_latitude',15,8);
            $table->double('gps_longitude',15,8);
            $table->string('land_title_no',50);
            $table->string('lot_no',50);
            $table->double('total_land_area')->comment('in hectares');
            $table->integer('number_of_coconut_trees');
            $table->text('varieties_cultivated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coco__farm__profile');
    }
};
