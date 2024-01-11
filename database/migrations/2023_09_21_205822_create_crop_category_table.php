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
        Schema::create('crop_categorys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('categorizes_id')->nullable();
            $table->string('crop_name',50);
            $table->string('crop_descript',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop');
    }
};
