<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEntriesTableWithDefaultForIsFileIsText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function(Blueprint $table) {
            $table->boolean('is_file')->default(false)->change();
            $table->boolean('is_text')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contests', function(Blueprint $table) {
            $table->boolean('is_file')->default(true)->change();
            $table->boolean('is_text')->default(true)->change();
        });
    }
}
