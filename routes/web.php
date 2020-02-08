<?php

Route::post('/spareparts', 'SparepartController@store');
Route::patch('/spareparts/{sparepart}', 'SparepartController@update');
