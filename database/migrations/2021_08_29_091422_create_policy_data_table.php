<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_data', function (Blueprint $table) {
            $table->bigIncrements('policy_id');
            $table->string('insurance_number')->unique();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('client');
            $table->string('image');
            $table->string('category');
            $table->string('category_value')->nullable();
            $table->string('product_type')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('insurance_startdate');
            $table->string('insurance_enddate');
            $table->string('total_amount');
            $table->string('credit_debit_amount');
            $table->string('credit_debit_amount1')->default('0');
            $table->string('credit_debit_amount2')->default('0');
            $table->string('entry_date');
            $table->string('entry_date1')->nullable();
            $table->string('entry_date2')->nullable();
            $table->string('emi2_expected_date');
            $table->string('emi3_expected_date')->nullable();
            $table->string('payment_mode');
            $table->string('payment_reference_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_data');
    }
}
