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
    { Schema::create('admin', function (Blueprint $table) {
        $table->id();
        $table->string('first_name',50);
        $table->string('last_name',50);
        $table->double('id_number',8,6);
        $table->string('district',50);
        $table->string('role',30);
        $table->string('passwords');
        $table->foreignId('user_id')->nullable();
        $table->timestamps();

    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('admin');
}
};
