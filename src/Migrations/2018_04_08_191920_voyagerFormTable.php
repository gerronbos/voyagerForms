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

        //Add permissions
        $permission_add = new Permission();
        $permission_add->key = "add_form";
        $permission_add->table_name = "forms";
        $permission_add->save();

        $permission_edit = new Permission();
        $permission_edit->key = "edit_form";
        $permission_edit->table_name = "forms";
        $permission_edit->save();

        $permission_delete = new Permission();
        $permission_delete->key = "delete_form";
        $permission_delete->table_name = "forms";
        $permission_delete->save();

        $permission_delete = new Permission();
        $permission_delete->key = "browse_form";
        $permission_delete->table_name = "forms";
        $permission_delete->save();

        //Add data_type
        $data_type = new DataType();
        $data_type->name = "form";
        $data_type->slug = "forms";
        $data_type->display_name_singular = "Form";
        $data_type->display_name_plural = "Forms";
        $data_type->icon = "voyager-receipt";
        $data_type->model_name = "Hostingprecisie\VoyagerForm\Models\Form";
        $data_type->generate_permissions = 1;
        $data_type->save();


        //Add Settings
        $setting_server = new \TCG\Voyager\Models\Setting();
        $setting_server->key = "mail.host";
        $setting_server->display_name = "SMTP host";
        $setting_server->type = "text";
        $setting_server->order = 1;
        $setting_server->group = "Mail";
        $setting_server->value = "";
        $setting_server->save();

        $setting_username = new \TCG\Voyager\Models\Setting();
        $setting_username->key = "mail.username";
        $setting_username->display_name = "Username";
        $setting_username->type = "text";
        $setting_username->order = 2;
        $setting_username->group = "Mail";
        $setting_username->value = "";
        $setting_username->save();

        $setting_password = new \TCG\Voyager\Models\Setting();
        $setting_password->key = "mail.password";
        $setting_password->display_name = "Password";
        $setting_password->type = "text";
        $setting_password->order = 3;
        $setting_password->group = "Mail";
        $setting_password->value = "";
        $setting_password->save();

        $setting_encryption = new \TCG\Voyager\Models\Setting();
        $setting_encryption->key = "mail.encryption";
        $setting_encryption->display_name = "Encryption";
        $setting_encryption->type = "text";
        $setting_encryption->order = 4;
        $setting_encryption->group = "Mail";
        $setting_encryption->value = "";
        $setting_encryption->save();

        $setting_port = new \TCG\Voyager\Models\Setting();
        $setting_port->key = "mail.port";
        $setting_port->display_name = "Port";
        $setting_port->type = "text";
        $setting_port->order = 5;
        $setting_port->group = "Mail";
        $setting_port->value = "";
        $setting_port->save();




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
