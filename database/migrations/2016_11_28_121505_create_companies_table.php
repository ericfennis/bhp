<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('walkpath_id');
            $table->integer('location_point');
            $table->integer('default_person');
            $table->string("telephone");    
            $table->string("email",64);
            $table->string('name');
            $table->string('branch');
            $table->string('description');
            $table->string('logo');
            $table->char('building', 1);
            $table->float('room_number');
            $table->integer('status');
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
        Schema::dropIfExists('companies');
    }
}
