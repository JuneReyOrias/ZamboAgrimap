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
        Schema::create('poultry_farmers', function (Blueprint $table) {
            $table->id();
            $table->string('last_name',50);
            $table->string('first_name',50);
            $table->string('middle_name',50);
            $table->string('extension_name',50);
            $table->string('home_address',50);
            $table->string('sex',50);
            $table->string('religion',50);
            $table->string('date_of_birth',30);
            $table->string('place_of_birth',50);
            $table->string('contact_no',30);
            $table->string('civil_status',50);
            $table->string('name_legal_spouse',50);
            $table->string('no_of_children',);
            $table->string('mothers_maiden_name',50);
            $table->string('highest_formal_education',50);
            $table->string('farm_name',50);
            $table->string('farm_address',50);
            $table->string('gps_latitude',50);
            $table->string('gps_longitude',50);
            $table->string('farm_type', 50);
            $table->unsignedInteger('year_established');
            $table->string('certifications', 100);
            $table->string('poultry_type', 50); // Layers, Broilers, etc.
            $table->unsignedInteger('total_birds');
            $table->decimal('annual_egg_production', 10, 2);
            $table->decimal('annual_meat_production', 10, 2);
            $table->string('feeding_method', 100);
            $table->string('sustainability', 100);
            $table->string('community_engagement', 100);
            $table->text('additional_info')->nullable();
            $table->string('personal_photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poultry_farmers');
    }
};
