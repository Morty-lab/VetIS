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
        Schema::create('pet_records', function (Blueprint $table) {
            $table->id();
            $table->integer("pet_ID");
            $table->date("record_date");
            $table->float("pet_weight");
            $table->float("pet_temperature");
            $table->string("medication_given");
            $table->string("procedure_given");
            $table->string("remarks");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_records');
    }
};
