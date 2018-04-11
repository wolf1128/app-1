<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group( function(){ // Use group to grouping all
    Route::get('/', 'ContentsController@home')->name('Home');
    Route::get('/clients', 'ClientController@index')->name('clients');
    Route::get('/clients/new', 'ClientController@newClient')->name('new_client'); // shown the form(get request)
    Route::post('/clients/new', 'ClientController@newClient')->name('create_client'); // Form is sent(post request)
    Route::get('/clients/{client_id}', 'ClientController@show')->name('show_client');
    Route::post('/clients/{client_id}', 'ClientController@modify')->name('update_client');
    
    Route::get('/reservations/{client_id}', 'RoomsController@checkAvailableRooms')->name('check_room');
    Route::post('/reservations/{client_id}', 'RoomsController@checkAvailableRooms')->name('check_room');
    
    Route::get('/book/room/{client_id}/{room_id}/{date_in}/{date_out}', 'ReservationsController@bookRoom')->name('book_room');
    Route::get('export', 'ClientController@export')->name('export');
    Route::get('/upload', 'ContentsController@upload')->name('upload'); // Show the form
    Route::post('/upload', 'ContentsController@upload')->name('upload'); // For process the form

    
} );




Route::get('/about', function () {
    $response_arr = [];
    $response_arr['author'] = 'BP';
    $response_arr['version'] = '0.1.1';
    return $response_arr;
    //return '<h3>About</h3>';
});

Route::get('/home', function () {
    $data = [];
    $data['version'] = '0.1.1';
    return view('welcome', $data);
});

Route::get('/di', 'ClientController@di');

Route::get('/facades/db', function () {
    
    return DB::select('SELECT * from table');
});

Route::get('/facades/encrypt', function () {
    
    return Crypt::encrypt('123456789');
});

//eyJpdiI6IjVuV1lWR3JXRlFmdGFHbXljN0Vodnc9PSIsInZhbHVlIjoibEpLQWJSdmgybDBXRHdjNDJadERwM0lZRWlLZnA5d2hcL1wvMHdCNEpCSklFPSIsIm1hYyI6ImE1NDQxZDhiMTAyNjQyNTZkOTZlY2NkZTdmNmIxYThhNjU1OTI2MGI2OTFmYWUxNmRlODk1ZDNiODgxMTY3YzAifQ==

Route::get('/facades/decrypt', function () {
    
    return Crypt::decrypt('eyJpdiI6IjVuV1lWR3JXRlFmdGFHbXljN0Vodnc9PSIsInZhbHVlIjoibEpLQWJSdmgybDBXRHdjNDJadERwM0lZRWlLZnA5d2hcL1wvMHdCNEpCSklFPSIsIm1hYyI6ImE1NDQxZDhiMTAyNjQyNTZkOTZlY2NkZTdmNmIxYThhNjU1OTI2MGI2OTFmYWUxNmRlODk1ZDNiODgxMTY3YzAifQ==');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/generate/password', function() { return bcrypt('123456789');  } ); // NOTE: function() is an anonymous function that we used .
// NOTE: bcrypt is a non-deterministic function which means under the same circumstances, it will return the same value. Much like a date function with seconds and miliseconds (both eual to one value. real pass and encrpted pass)   