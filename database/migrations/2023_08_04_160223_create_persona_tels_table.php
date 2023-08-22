<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('persona_tels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_persona");
            $table->string("telefono")->unique();
            $table->foreign("id_persona")->references("id")->on("personas");
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
        Schema::dropIfExists('persona_tels');
    }
}
