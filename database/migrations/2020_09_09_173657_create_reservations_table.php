<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('start_address', 250);
            $table->string('end_address', 250);
            $table->string('start_address_geo', 250);
            $table->string('end_address_geo', 250);
            $table->string('amount_of_people');
            $table->string('pickup_date');
            $table->double('fare_price');
            $table->string('travel_time');
            $table->string('distance', 250);
            $table->string('payment_id');
            $table->string('order_id');
            $table->string('status');
            $table->bigInteger('user_id');
            $table->integer('refundIsAsked')->default('0');
            $table->integer('orderIsComplete')->default('0');
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
        Schema::dropIfExists('reservations');
    }
}
