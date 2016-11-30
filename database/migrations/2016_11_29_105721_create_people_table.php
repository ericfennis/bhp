<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
		$table->increments('id');
		$table->string("firstname",64);
		$table->string("surname",64);
		$table->string("profilepicture",64);
		$table->unsignedInteger("telephone");	
		$table->string("email",64);
		$table->string("website",64);
		$table->unsignedInteger("status");
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
        Schema::dropIfExists('people');
    }
}
