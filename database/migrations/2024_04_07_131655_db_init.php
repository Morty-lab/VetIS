<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('extensionname')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->date('birthday');
            $table->string('position')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('license_number')->nullable();
            $table->string('ptr_number')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('extensionname')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->date('birthday');
            $table->string('position');
            $table->string('profile_picture')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('extensionname')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->date('birthday');
            $table->string('position');
            $table->string('profile_picture')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('secretaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('extensionname')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->date('birthday');
            $table->string('profile_picture')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string("client_name");
            $table->string("client_no");
            $table->string("client_address");
            $table->date("client_birthday");
            $table->string("client_profile_picture")->nullable();
            $table->boolean('status')->default(true);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string("supplier_name");
            $table->string("supplier_address");
            $table->string("supplier_email_address");
            $table->string("supplier_phone_number");
            $table->string("supplier_contact_person");
            $table->boolean('status')->default(true);
            $table->timestamps();

        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string("unit_name");
            $table->timestamps();
        });

        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string("category_name");
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("SKU")->nullable();
            $table->string('brand')->nullable();
            $table->string("product_name");
            $table->unsignedBigInteger("product_category");
            $table->unsignedBigInteger("unit");
            $table->integer("status")->nullable();
            $table->foreign("unit")->references("id")->on("units");
            $table->foreign("product_category")->references("id")->on("category");
            $table->timestamps();
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("products_id");
            $table->unsignedBigInteger("supplier_id");
            $table->unsignedBigInteger("user_id");
            $table->integer("stock");
            $table->integer('subtracted_stock')->default(0);
            $table->float("supplier_price");
            $table->float("price");
            $table->unsignedBigInteger("unit");
            $table->integer("status")->nullable();
            $table->date("expiry_date")->nullable();
            $table->foreign("products_id")->references("id")->on("products")->onDelete("cascade");
            $table->foreign("supplier_id")->references("id")->on("suppliers")->onDelete("cascade");
            $table->foreign("unit")->references("id")->on("units");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer("client_id");
            $table->float("sub_total");
            $table->integer("total_discount");
            $table->timestamps();
        });

        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("transaction_id");
            $table->integer("product_id");
            $table->integer("quantity");
            $table->float("price");
            $table->foreign("transaction_id")->references("id")->on("transactions")->onDelete("cascade");
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
            // $table->float("pet_weight");
            $table->boolean("vaccinated")->nullable();
            $table->boolean("neutered")->nullable();

            // Add new fields for the additional form information
            $table->boolean("vaccinated_anti_rabies")->nullable();  // Anti-Rabies vaccination
            $table->date("anti_rabies_vaccination_date")->nullable();  // Date of Anti-Rabies vaccination
            $table->text("history_of_aggression")->nullable();  // History of aggression
            $table->text("food_allergies")->nullable();  // Food allergies
            $table->string("pet_food")->nullable();  // Pet's food
            $table->boolean("okay_to_give_treats")->nullable();  // Can give treats?
            $table->date("last_groom_date")->nullable();  // Last groom date
            $table->boolean("okay_to_use_photos_online")->nullable();  // Can use photos online?
            $table->text("pet_condition")->nullable();  // Seizures/Illnesses/Conditions
            $table->boolean('status')->default(false);
            $table->boolean('isArchived')->default(false);
            $table->timestamps();
            $table->foreign("owner_ID")->references("id")->on("clients")->onDelete("cascade");
        });

        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pet_id");
            $table->string("vaccine_type");
            $table->string("doctor_id");
            $table->date("next_vaccine_date")->nullable();
            $table->boolean("status")->default(false);
            $table->timestamps();
        });


        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_ID");
            $table->text("pet_ID");
            $table->unsignedBigInteger("doctor_ID");
            $table->foreign("doctor_ID")->references("id")->on("doctors")->onDelete("cascade");
            // $table->foreign("pet_ID")->references("id")->on("pets")->onDelete("cascade");
            $table->foreign("owner_ID")->references("id")->on("clients")->onDelete("cascade");
            $table->date("appointment_date");
            $table->time("appointment_time")->nullable();
            $table->string("priority_number")->nullable();
            $table->integer("status")->nullable();
            $table->string("purpose")->nullable();
            $table->text("remarks")->nullable();
            $table->timestamps();
        });

        Schema::create('pet_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("petID");
            $table->unsignedBigInteger("ownerID");
            $table->unsignedBigInteger("doctorID")->nullable();
            $table->foreign("doctorID")->references("id")->on("doctors")->onDelete("cascade");
            $table->foreign("ownerID")->references("id")->on("clients")->onDelete("cascade");
            $table->foreign("petID")->references("id")->on("pets")->onDelete("cascade");
            $table->string("subject");
            $table->dateTime("record_date");
            $table->integer("consultation_type")->nullable();
            $table->longText("complaint")->nullable();
            $table->longText("examination")->nullable();
            $table->longText("diagnosis")->nullable();
            // $table->longText('medication_given')->nullable();
            // $table->longText('procedure_given')->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('prescription')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::create("examinations", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pet_record_id");
            $table->foreign('pet_record_id')->references("id")->on("pet_records")->onDelete("cascade");

            // Basic vitals
            $table->float("temperature")->nullable(); // °C
            $table->integer("heart_rate")->nullable(); // bpm
            $table->integer("respiration_rate")->nullable(); // bpm
            $table->float("weight")->nullable(); // kg
            $table->float("length")->nullable(); // cm
            $table->float("height")->nullable(); // cm

            // Assessments - JSON to allow multiple selectable values
            $table->json("body_condition")->nullable(); // Underweight, Normal, Overweight
            $table->json("general_appearance")->nullable(); // Active, Lethargic, etc.
            $table->json("skin_coat_condition")->nullable(); // Healthy, Dry, etc.
            $table->json("eyes_ears_nose_throat")->nullable(); // Clear, Discharge, etc.
            $table->json("mouth_teeth")->nullable(); // Healthy, Tartar, etc.
            $table->json("lymph_nodes")->nullable(); // Normal, Swollen, etc.
            $table->json("cardiovascular_system")->nullable(); // Normal, Murmurs, etc.
            $table->json("respiratory_system")->nullable(); // Normal, Wheezing, etc.
            $table->json("digestive_system")->nullable(); // Normal, Bloating, etc.
            $table->json("musculoskeletal_system")->nullable(); // Normal, Limping, etc.
            $table->json("neurological_system")->nullable(); // Normal, Seizures, etc.

            $table->timestamps();
        });

        //        Schema::create("laboratory", function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger("pet_record_id");
//            $table->foreign('pet_record_id')->references("id")->on("pet_records")->onDelete("cascade");
//            $table->binary("file_content"); // This stores the file content as a blob
//            $table->string("file_extension");
//            $table->string("remarks");
//            $table->timestamps();
//        });

        //        Schema::create('pet_plan', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger("pet_record_id");
//            $table->foreign('pet_record_id')->references("id")->on("pet_records")->onDelete("cascade");
//            $table->string("service_name");
//            $table->date("date_return");
//            $table->string("reason_for_return")->nullable();
//            $table->integer("status");
//            $table->timestamps();
//        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string("service_name");
            $table->double("service_price");
            $table->string("service_type");
            $table->timestamps();
        });

        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references("id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("biller_id");
            $table->foreign('biller_id')->references("id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("vet_id");
            $table->foreign('vet_id')->references("id")->on("doctors")->onDelete("cascade");
            $table->string("payment_type")->nullable();
            $table->double("total_payable")->nullable();
            $table->double('total_paid')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });

        Schema::create('billing_services', function (Blueprint $table) {
            $table->id();
            $table->integer("quantity");
            $table->unsignedBigInteger("billing_id");
            $table->foreign('billing_id')->references("id")->on("billing")->onDelete("cascade");
            $table->unsignedBigInteger("service_id")->nullable();
            $table->foreign('service_id')->references("id")->on("services")->onDelete("cascade");
            $table->unsignedBigInteger("product_id")->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->float('service_price');
            $table->unsignedBigInteger("pet_id");
            $table->foreign('pet_id')->references("id")->on("pets")->onDelete("cascade");
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("billing_id");
            $table->foreign('billing_id')->references("id")->on("billing")->onDelete("cascade");
            $table->float("amount_to_pay");
            $table->float('cash_given');
            $table->timestamps();

        });


        //        Schema::create('prescriptions', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger("recordID");
//            $table->unsignedBigInteger("productID");
//            $table->foreign("recordID")->references("id")->on("pet_records")->onDelete("cascade");
//            $table->foreign("productID")->references("id")->on("products")->onDelete("cascade");
//            $table->string("treatment");
//            $table->string("dose");
//            $table->timestamps();
//        });

        //        Schema::create("pet_diagnosis", function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger("pet_record_id");
//            $table->foreign('pet_record_id')->references("id")->on("pet_records")->onDelete("cascade");
//            $table->string("diagnosis");
//            $table->string("treatment");
//            $table->string("prescription");
//            $table->string("client_communication");
//            $table->timestamps();
//
//        });

        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("recordID");
            $table->unsignedBigInteger("productID");
            $table->foreign("recordID")->references("id")->on("pet_records")->onDelete("cascade");
            $table->foreign("productID")->references("id")->on("products")->onDelete("cascade");
            $table->string("dosage");
            // $table->float("price");
            $table->string("frequency");
            $table->string('medication_type');
            $table->timestamps();
        });

        Schema::create('procedure_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("recordID");
            $table->unsignedBigInteger("serviceID");
            $table->string("outcome")->nullable();
            $table->foreign('recordID')->references('id')->on('pet_records')->onDelete('cascade');
            $table->foreign('serviceID')->references('id')->on('services')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('visible_to');
            $table->string('notification_type');
            $table->string('message');
            $table->string('link')->nullable();
            $table->boolean('read')->default(false);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('appointments');
        //        Schema::dropIfExists('medications');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('billing_services');
        Schema::dropIfExists('billing');
        Schema::dropIfExists('services');
        //        Schema::dropIfExists('prescriptions');
//        Schema::dropIfExists('pet_diagnosis');
//        Schema::dropIfExists('pet_plan');
//        Schema::dropIfExists('laboratory');
//        Schema::dropIfExists('examination');
        Schema::dropIfExists('pet_records');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('transaction_details');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('products');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('secretaries');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('staffs');
        Schema::dropIfExists('users');
        Schema::dropIfExists('category');
        Schema::dropIfExists('units');
        Schema::dropIfExists('suppliers');


    }
};
