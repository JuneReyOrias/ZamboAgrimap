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
        Schema::create('fisheries_categorys', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('categorizes_id')->nullable();
            $table->string('fisheries_category_name',50);
            $table->string('fisheries_description',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fisheries_categery');
    }
};
