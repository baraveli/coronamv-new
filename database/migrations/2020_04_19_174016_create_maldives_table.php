<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaldivesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maldives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('div_name')->nullable();
            $table->string('name');
            $table->string('administrative_atoll');
            $table->unsignedInteger('confirmed');
            $table->unsignedInteger('recovered');
            $table->unsignedInteger('deaths');
            $table->unsignedInteger('active');
            $table->decimal('lat',10,7)->nullable();
            $table->decimal('long',10,7)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maldives');
    }
}
