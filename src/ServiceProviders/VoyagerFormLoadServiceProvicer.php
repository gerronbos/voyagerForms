<?php

namespace Hostingprecisie\VoyagerForm\ServiceProviders;

use Hostingprecisie\VoyagerForm\Models\Form;
use Hostingprecisie\VoyagerForm\Models\FormFields;
use Illuminate\Support\ServiceProvider;

class VoyagerFormLoadServiceProvider
{
    public static function routes(){
       require __DIR__."/../routes/route.php";
    }
}
