<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\DataType;

class VoyagerFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->integer("author");
            $table->timestamps();
        });

        Schema::create('forms_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("form_id");
            $table->string('name');
            $table->string('type');
            $table->integer('row');
            $table->boolean('required');
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
        Schema::drop('forms');
        Schema::drop('formsFields');
    }
}
