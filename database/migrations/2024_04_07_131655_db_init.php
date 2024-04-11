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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address');
            $table->string('phone_number');
            $table->date('birthday');
            $table->string('position');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("client_name");
            $table->string("client_no");
            $table->string("client_address");
            $table->string("client_email_address");
            $table->timestamps();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_ID");
            $table->string("pet_name");
            $table->string("pet_breed");
            $table->string("pet_type");
            $table->string("pet_gender");
            $table->date("pet_birthdate");
            $table->string("pet_color");
            $table->string("pet_picture")->nullable();
            $table->string("pet_description")->nullable();
            $table->float("pet_weight");
            $table->boolean("vaccinated")->nullable();
            $table->boolean("neutered")->nullable();
            $table->timestamps();
            $table->foreign("owner_ID")->references("id")->on("clients")->onDelete("cascade");
        });


        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_ID");
            $table->unsignedBigInteger("pet_ID");
            $table->foreign("pet_ID")->references("id")->on("pets")->onDelete("cascade");
            $table->foreign("owner_ID")->references("id")->on("clients")->onDelete("cascade");
            $table->date("appointment_date");
            $table->time("appointment_time")->nullable();
            $table->integer("status")->nullable();
            $table->string("purpose")->nullable();
            $table->timestamps();
        });

        Schema::create('pet_records', function (Blueprint $table) {
            $table->id();
            $table->integer("pet_ID");
            $table->foreign("id")->references("id")->on("pets")->onDelete("cascade");
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
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('users');


    }
};
