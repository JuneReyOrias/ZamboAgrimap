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
        Schema::create('polygons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agri_districts_id')->nullable();
            $table->string('strokecolor',50);
            $table->double('verone_latitude',15,8);
            $table->double('verone_longitude',15,8);
            $table->double('vertwo_latitude',15,8);
            $table->double('vertwo_longitude',15,8);
            $table->double('verthree_latitude',15,8);
            $table->double('verthree_longitude',15,8);
            $table->double('vertfour_latitude',15,8);
            $table->double('vertfour_longitude',15,8);
            $table->double('verfive_latitude',15,8);
            $table->double('verfive_longitude',15,8);
            $table->double('versix_latitude',15,8);
            $table->double('versix_longitude',15,8);
            $table->double('verseven_latitude',15,8);
            $table->double('verseven_longitude',15,8);
            $table->double('vereight_latitude',15,8);
            $table->double('verteight_longitude',15,8);
            $table->json('coordinates')->nullable();
            $table->double('area',8,4)->nullable();
            $table->double('perimeter',8,4)->nullable();
   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polygons');
    }
};
