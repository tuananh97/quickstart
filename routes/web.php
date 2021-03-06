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
    Route::get('/', function () {
       return view('welcome');
    })->middleware('auth');

    Auth::routes();

    Route::resource('users', 'UserController');

    Route::get('/getCurrentUser', function() {
       return Auth::user()->load('roles');
    });

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('tasks', 'TaskController');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('/redirect/{social}', 'SocialAuthController@redirect');
    Route::get('/callback/{social}', 'SocialAuthController@callback');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/follows', 'FollowController@index');
        Route::post('/follow/{user}', 'FollowController@follow');
        Route::delete('/unfollow/{user}', 'FollowController@unfollow');
        Route::get('/notifications', 'UsersController@notifications');
    });

    Route::get('maskAsRead', function(){
      auth()->user()->unreadNotifications->markAsRead();
      redirect()->back();
    })->name('maskRead');

    Route::get('/contact', 'TicketsController@create')->name('create_ticket');
    Route::post('/contact', 'TicketsController@store');
    Route::get('/tickets', 'TicketsController@index')->name('tickets');
    Route::get('/ticket/{slug?}', 'TicketsController@show');
    Route::get('/ticket/{slug?}/edit','TicketsController@edit');
    Route::post('/ticket/{slug?}/edit','TicketsController@update');
    Route::post('/ticket/{slug?}/delete','TicketsController@destroy');
    Route::post('/comment', 'CommentsController@newComment');


    Route::get('/images', 'ImageController@getImages')->name('images');
    Route::post('/upload', 'ImageController@postUpload')->name('uploadfile');
    Route::delete('/images/{image}', 'ImageController@destroy')->name('deleteImage');

    Route::get('sendemail', function () {

        $data = array(
            'name' => "Learning Laravel",
        );

        Mail::send('emails.welcome', $data, function ($message) {

            $message->from('anhcu.97.uet@gmail.com', 'Learning Laravel');

            $message->to('anhcu.97.uet@gmail.com')->subject('Learning Laravel test email');

        });

        return "Your email has been sent successfully";

    });
