<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_id')->unsigned();
            $table->string('file')->nullable();
            $table->text('text')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('survey')->nullable();
            $table->boolean('perm1')->default(false);
            $table->boolean('perm2')->default(false);
            $table->boolean('perm3')->default(false);
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
        Schema::dropIfExists('entries');
    }
}
