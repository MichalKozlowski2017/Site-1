<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo')->nullable();
            $table->boolean('countrywide')->default(false);
            $table->string('shop_name');
            $table->string('shop_address');
            $table->string('shop_city');
            $table->text('question');
            $table->boolean('is_file')->default(false);
            $table->boolean('is_text')->default(false);
            $table->date('date_start');
            $table->date('date_end');
            $table->softDeletes();
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
        Schema::dropIfExists('contests');
    }
}
