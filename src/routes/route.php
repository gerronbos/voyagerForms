<?php
$prefix = config('voyager.prefix');

Route::group(['as' => 'voyager.',"prefix"=>$prefix."/forms","middleware"=>["web","admin.user"]], function () {
    Route::get('/', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@index','as' => 'form.index']);

    Route::get('new', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@add','as' => 'form.add']);
    Route::post('new', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@postAdd','as']);

    Route::get('edit/{id}', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@edit','as' => 'form.edit']);
    Route::post('edit/{id}', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@postEdit']);

    Route::delete('/{id}', ["uses" => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormController@delete',"as" => "form.delete"]);

    //Form items
    Route::get('/{id}/items', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@index','as' => 'form.items']);

    Route::get('/{id}/items/new', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@add','as' => 'form.items.add']);
    Route::post('/{id}/items/new', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@postAdd']);

    Route::get('/{id}/items/{field_id}/edit', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@edit','as' => 'form.items.edit']);
    Route::post('/{id}/items/{field_id}/edit', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@postEdit']);

    Route::post('/{id}/items/{field_id}/changerow', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@changerow','as' => 'form.items.changerow']);

    Route::delete('/{id}/items/{field_id}', ['uses' => 'Hostingprecisie\VoyagerForm\Http\Controllers\VoyagerFormItemsController@delete','as' => 'form.delete']);
});