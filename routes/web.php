<?php

Route::post('/spareparts', 'SparepartController@store');
Route::patch('/spareparts/{sparepart}', 'SparepartController@update');
//Route::patch('/spareparts/{sparepart}-{slug}', 'SparepartController@update');
Route::delete('/spareparts/{sparepart}', 'SparepartController@destroy');

Route::post('/manufacturers', 'ManufacturerController@store');
