<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;

class VoyagerFormTableEditFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('forms_fields', function (Blueprint $table) {
            $table->text("options")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
