<?php

Route::group(['as' => 'voyager.',"prefix"=>"/forms","middleware"=>["web","admin.user"]], function () {
    Route::get('/', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@index','as' => 'form.index']);
    

    Route::get('create', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@create','as' => 'form.create']);
    Route::post('create', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@postAdd']);

    Route::get('edit/{id}', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@edit','as' => 'form.edit']);
    Route::post('edit/{id}', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@postEdit']);

    Route::delete('/{id}/delete', ["uses" => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@delete',"as" => "form.destroy"]);
    Route::get('/{id}', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@index','as' => 'form.show']);

    //Form items
    Route::get('/{id}/items', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@index','as' => 'form.items']);

    Route::get('/{id}/items/new', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@add','as' => 'form.items.add']);
    Route::post('/{id}/items/new', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@postAdd']);

    Route::get('/{id}/items/{field_id}/edit', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@edit','as' => 'form.items.edit']);
    Route::post('/{id}/items/{field_id}/edit', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@postEdit']);

    Route::post('/{id}/items/{field_id}/changerow', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@changerow','as' => 'form.items.changerow']);

    Route::delete('/{id}/items/{field_id}', ['uses' => '\Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@delete','as' => 'form.delete']);
});