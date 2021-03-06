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

use App\Models\User;

Route::get('/facker', function () {
    $faker = Faker\Factory::create();
    $limit = 10;

    for ($i = 0; $i < $limit; $i++) {
        $user = User::create([
            'email' => $faker->unique()->email,
            'password'  => bcrypt('dsadas'),



        ]);

        \App\Models\UserProfile::create([
            'first_name' => $faker->name,
            'last_name' => $faker->name,
            'middle_name' => $faker->name,
            'bdate' => \Carbon\Carbon::now()->format('d.m.Y'),
            'about' => $faker->text(150),
            'github_url' => 'http:://github.com',
            'user_id'   => $user->id,
            'active'   => 1
        ]);

    }


    return view('welcome');
});

# Auth::routes();



Route::group(['middleware' => ['web' , 'auth'] , 'prefix' => 'account'], function () {
    Route::get('/', 'AccountController@index')->name('user.account.index');
    Route::get('/profile', 'ProfileController@index')->name('user.profile.index');
    Route::get('/profile/favorite', 'AccountController@likeProfile')->name('account.profile.favorite');


});


# Профиль для авторизованных пользователей
Route::group(['middleware' => ['web' , 'auth']], function () {
    Route::get('/profiles/all', 'ProfileController@all')->name('user.profile.lists');

    Route::post('/profile/like/{id}', 'ProfileController@toggleLike')->name('user.profile.like');

});

# Профиль для не авторизованных пользователей
Route::group(['middleware' => ['web']], function () {
    Route::get('/profile/detail/{id}', 'ProfileController@detail')->name('user.profile.detail');
    Route::post('/profile/likes/get/{id}', 'ProfileController@apiGetProfileLikes')->name('user.profile.likes.get');


});

Route::group(['middleware' => ['web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'api/profile' ,'middleware' => ['web' , 'auth']], function () {
    Route::post('/update', ['as' => 'api.profile.update', 'uses' => 'ProfileController@updateProfile']);
    Route::post('/', ['as' => 'api.profile', 'uses' => 'ProfileController@apiGetProfile']);
});





Route::group(['prefix' => 'api/auth' , 'middleware' => ['web']], function () {

    Route::post('/login', ['as' => 'api.auth.login', 'uses' => 'AppAuthController@login']);
    Route::post('/register', ['as' => 'api.auth.register', 'uses' => 'AppAuthController@register']);

});



# Admin

Route::group(['prefix' => 'admin' , 'middleware' => ['web' , 'auth' , 'role:admin' ]], function () {
    Route::get('/profiles', 'AdminController@manageProfile')->name('admin.profiles.all');

    Route::post('/profile/toggle-status/{id}', 'AdminController@profileToggleStatus')->name('admin.profiles.status.toggle');
});



