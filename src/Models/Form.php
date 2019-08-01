<?php

namespace Hostingprecisie\VoyagerForm\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';


    public function fields()
    {
        return $this->hasMany('Hostingprecisie\VoyagerForm\Models\FormFields');
    }



}
