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
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('crop_categories_id')->nullable();
            $table->foreignId('livestock_categories_id')->nullable();
            $table->foreignId('fisheries_categories_id')->nullable();
            $table->string('first_name',50);
            $table->string('middle_name',50);
            $table->string('last_name',50);
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
            $table->string('member_ofany_farmers_ass_org_coop',50);
            $table->string('nameof_farmers_ass_org_coop',50);
            $table->string('name_contact_person',50);
            $table->string('cp_tel_no,50');
            $table->string('personal_photo');
            $table->timestamps();
            
            // $table->id();
            // $table->foreignId('agri_id')->unique()->nullable();
            // $table->foreignId('crop_cat_id')->unique()->nullable();
            // $table->foreignId('livestock_id')->unique()->nullable();
            // $table->foreignId('fish_cat_id')->unique()->nullable();
            // $table->string('first_name',50);
            // $table->string('middle_name',50);
            // $table->string('last_name',50);
            // $table->string('extension_name',50);
            // $table->string('home_address',50);
            // $table->string('sex',50);
            // $table->string('religion',50);
            // $table->string('date_of_birth',30);
            // $table->string('place_of_birth',50);
            // $table->string('contact_no',30);
            // $table->string('civil_status',50);
            // $table->string('name_legal_spouse',50);
            // $table->string('no_of_children',);
            // $table->string('mothers_maiden_name',50);
            // $table->string('highest_formal_education',50);
            // $table->string('person_with_disability',50);
            // $table->string('pwd_id_no',30);
            // $table->string('government_issued_id',50);
            // $table->string('id_type',50);
            // $table->string('gov_id_no',30);
            // $table->string('member_ofany_farmers_ass_org_coop',50);
            // $table->string('nameof_farmers_ass_org_coop',50);
            // $table->string('name_contact_person',50);
            // $table->string('cp_tel_no');
            // $table->foreignId('users_id')->nullable()->constrained('users');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_informations');
    }
};
