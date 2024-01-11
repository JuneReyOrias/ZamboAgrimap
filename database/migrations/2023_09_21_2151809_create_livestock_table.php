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
        Schema::create('livestocks', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('categorizes_id')->nullable();
            $table->foreignId('livestock_categorys_id')->nullable();
            $table->string('livestock_name',50);
            $table->string('breed',50)->nullable();
            $table->string('age',50)->nssullable();
            $table->string('gender',50)->nullable();
            $table->string('livestock_description',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestocks');
    }
};
