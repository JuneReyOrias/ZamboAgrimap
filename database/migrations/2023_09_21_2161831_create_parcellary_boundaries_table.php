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
        Schema::create('parcellary_boundaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('ricefield_boarders_id')->nullable();
            $table->string('parcel_name',50);
            $table->double('area',50)->nullable();
            $table->double('range',15,8)->nullable();
            $table->string('series',50);
            $table->string('tct_no',50);
            $table->string('brgy_name',50);
            $table->string('atdn',50);
            $table->string('arpowner_na',50);
            $table->string('pkind_desc',50);
            $table->string('puse_desc',50);
            $table->string('actual_used',50);
            $table->string('market_value',50);
            $table->string('asssesedva',50);
            $table->double('parone_latitude',15,8)->nullable();
            $table->double('parone_longitude',15,8)->nullable();
            $table->double('partwo_latitude',15,8)->nullable();
            $table->double('partwo_longitude',15,8)->nullable();
            $table->double('parthree_latitude',15,8)->nullable();
            $table->double('parthree_longitude',15,8)->nullable();
            $table->double('parfour_latitude',15,8)->nullable();
            $table->double('parfour_longitude',15,8)->nullable();
            $table->double('parfive_latitude',15,8)->nullable();
            $table->double('parfive_longitude',15,8)->nullable();
            $table->double('parsix_latitude',15,8)->nullable();
            $table->double('parsix_longitude',15,8)->nullable();
            $table->double('parseven_latitude',15,8)->nullable();
            $table->double('parseven_longitude',15,8)->nullable();
            $table->double('pareight_latitude',15,8)->nullable();
            $table->double('pareight_longitude',15,8)->nullable();
            
            $table->double('parnine_latitude',15,8)->nullable();
            $table->double('parnine_longitude',15,8)->nullable();
            $table->double('parten_latitude',15,8)->nullable();
            $table->double('parten_longitude',15,8)->nullable();
            $table->double('pareleven_latitude',15,8)->nullable();
            $table->double('pareleven_longitude',15,8)->nullable();
            $table->double('partwelve_latitude',15,8)->nullable();
            $table->double('partwelve_longitude',15,8)->nullable();
            $table->string('parcolor',50);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcellary_boundaries');
    }
};
