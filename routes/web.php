<?php
Route::get('/{any}', 'HomeController@index')->where('any', '.*');

Route::post('/authors', function(){
    $attributes = request()->validate([
        'name' =>'required',
        'date_of_birth' => 'required',
        'address' => 'required'
        ]);

    App\Authors::create($attributes);
    return redirect('/');
});

Route::post('/books', function(){
    $attributes = request()->validate([
        'name' =>'required',
        'release_date' => 'required',
        'authors_id' => 'required'
        ]);

    App\Books::create($attributes);
    return redirect('/');
});