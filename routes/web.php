<?php
Route::get('/{any}', 'HomeController@index')->where('any', '.*');

Route::post('/authors', function(){
    $attributes = request()->validate([
        'author_name' =>'required',
        'date_of_borth' => 'required',
        'author_address' => 'required'
        ]);

    App\Authors::create($attributes);
    return redirect('/');
});