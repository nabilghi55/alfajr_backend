<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingNumbersTable extends Migration
{
    public function up()
    {
        Schema::create('marketing_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->unique();
            $table->integer('duration_hours')->default(45);
            $table->integer('rotation_order')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marketing_numbers');
    }
}
