<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('farm_profiles', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('farmer_no')->unique()->nullable(); // Nullable foreign key
            $table->foreignId('personal_informations_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('polygons_id')->nullable();
            $table->string('tenurial_status',50);
            $table->string('rice_farm_address',50);
            $table->double('no_of_years_as_farmers',8,2);
            $table->double('gps_longitude',15,8);
            $table->double('gps_latitude',15,8);
            $table->double('total_physical_area_has',15,4);
            $table->double('rice_area_cultivated_has',15,4);
            $table->string('land_title_no',50);
            $table->string('lot_no',50);
            $table->string('area_prone_to',50);
            $table->string('ecosystem',50);
            $table->string('type_rice_variety',50);
            $table->string('prefered_variety',50);
            $table->string('plant_schedule_wetseason',50);
            $table->string('plant_schedule_dryseason',50);
            $table->string('no_of_cropping_yr',50);
            $table->double('yield_kg_ha',15,4);
            $table->string('rsba_register',50);
            $table->string('pcic_insured',50);
            $table->string('government_assisted',100);
           
            $table->string('source_of_capital',50);
            $table->string('remarks_recommendation',100);
            $table->string('oca_district_office',50);
            $table->string('name_technicians',50);
            $table->string('date_interview',50);
            $table->string('farm_images');
            
            $table->timestamps();
            
            
            // $table->id();
            // $table->string('tenurial_status',50);
            // $table->string('rice_farm_address',50);
            // $table->double('no_of_years_as_farmers',8,2);
            // $table->double('gps_longitude',15,8);
            // $table->double('gps_latitude',15,8);
            // $table->double('total_physical_area_has',15,4);
            // $table->double('rice_area_cultivated_has',15,4);
            // $table->string('land_title_no',50);
            // $table->string('lot_no',50);
            // $table->string('area_prone_to',50);
            // $table->string('ecosystem',50);
            // $table->string('type_rice_variety',50);
            // $table->string('prefered_variety',50);
            // $table->string('plant_schedule_wetseason',50);
            // $table->string('plant_schedule_dryseason',50);
            // $table->string('no_of_cropping_yr',50);
            // $table->double('yield_kg_ha',15,4);
            // $table->string('rsba_register',50);
            // $table->string('pcic_insured',50);
            // $table->string('source_of_capital',50);
            // $table->string('remarks_recommendation',100);
            // $table->string('oca_district_office',50);
            // $table->string('name_technicians',50);
            // $table->string('date_interview',50);
            // $table->foreignId('users_id')->nullable()->constrained('users');
            // $table->foreignId('personal_informations_id')->nullable()->constrained('personal_informations');
            // $table->timestamps();
            // ->references('id') // Assuming 'farmer_no' is the primary key in 'personal_informations'
            // ->on('personal_informations')
            ;
            //    $table->unsignedBigInteger('personal_informations_id');
            // $table->foreign('personal_informations_id')
            //     ->references('id')
            //     ->on('personal_informations');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_profiles');
       
        
    }
};
