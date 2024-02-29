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
        Schema::create('banana_farmers', function (Blueprint $table) {
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
            $table->string('person_with_disability',50);
            $table->string('pwd_id_no',30);
            $table->string('government_issued_id',50);
            $table->string('id_type',50);
            $table->string('gov_id_no',30);
            $table->string('member_ofany_ass_org_coop',50);
            $table->string('nameof_ass_org_coop',50);
            $table->string('farm_name',50);
            $table->string('farm_address',50);
            $table->string('gps_latitude',50);
            $table->string('gps_longitude',50);
            $table->string('farm_size_acre',50);
            $table->string('farm_type',50);
            $table->string('year_established',50);
            $table->string('certifications',50);
            $table->string('banana_varieties',50);
            $table->string('annual_productions',50);
            $table->string('farm_size_acres',50);
            $table->string('planting_season',50);
            $table->string('harvesting_season',50);
            $table->string('harvesting_method',50);
            $table->string('processing_method',50);
            $table->string('sustainability',50);
            $table->string('name_contact_person',50);
            $table->string('cp_tel_no,50');
            $table->string('personal_photo')->nullable;
            $table->longText('add_farm_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banana_farmers');
    }
};
