<?php

namespace Hostingprecisie\VoyagerForm\ServiceProviders;

use Hostingprecisie\VoyagerForm\Models\Form;
use Hostingprecisie\VoyagerForm\Models\FormFields;
use Illuminate\Support\ServiceProvider;

class VoyagerFormItemServiceProvider extends ServiceProvider
{
    public static function changeRow(FormFields $field,$direction="up")
    {
        switch ($direction){
            case "up":
                $field2 = FormFields::where("form_id",'=',$field->form_id)->where("row",'=',$field->row -1)->first();
                $field2->row += 1;
                $field2->save();
                $field->row -= 1;
                $field->save();

            break;

            case "down":
                $field2 = FormFields::where("form_id",'=',$field->form_id)->where("row",'=',$field->row +1)->first();
                $field2->row -= 1;
                $field2->save();
                $field->row += 1;
                $field->save();
            break;
        }
    }
}
