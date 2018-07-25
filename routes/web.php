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
use Illuminate\Support\Facades\Mail;


Route::get('/', 'PagesController@index')->name('index');
Route::get('/dashboard', 'PagesController@dashboard')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/home/create', 'HomeController@create')->name('home.create')->middleware('auth');
Route::get('/home/posts', 'HomeController@posts')->name('home.posts')->middleware('auth');
Route::get('/home/posts/{post}/edit', 'HomeController@edit')->name('home.edit')->middleware('auth');

Route::post('avatar','UsersController@update_avatar')->name('users.avatar');

Route::resource('posts', 'PostsController');
Route::resource('/home/categories', 'CategoriesController')->middleware('auth');
Route::resource('/home/users', 'UsersController')->middleware('auth');
Route::resource('/home/realms', 'RealmsController')->middleware('auth');
Route::get('/{slug}','UsersController@show')->name('show.user.slug');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/settings', 'PagesController@settings')->name('settings')->middleware('auth');
Route::get('/settings/account', 'PagesController@account')->name('account')->middleware('auth');
Route::get('/settings/security', 'PagesController@security')->name('security')->middleware('auth');

Route::get('/api/findCatName','HomeController@findCatName')->name('findCatName');
Route::get('/api/findAchivName','HomeController@findAchivName')->name('findAchivName');

Route::get('/api/findLanguage','HomeController@findLanguage')->name('findLanguage');

Route::post('/api/addNewLanguage','UsersController@addNewLanguage')->name('addNewLanguage');
Route::post('/api/detachLang','UsersController@detachLang')->name('detachLang')->middleware('auth');
Route::post('/api/addNewGame','UsersController@addNewGame')->name('addNewGame')->middleware('auth');
Route::post('/api/detachGame','UsersController@detachGame')->name('detachGame')->middleware('auth');

Route::post('/api/addNewAchivement','UsersController@addNewAchivement')->name('addNewAchivement')->middleware('auth');
Route::post('/api/detachAchivement','UsersController@detachAchivement')->name('detachAchivement')->middleware('auth');

Route::get('/api/change-password', 'UpdatePasswordController@index')->name('password.form');
Route::post('/api/change-password', 'UpdatePasswordController@update')->name('password.update');

Route::post('/api/change-email', 'UpdateEmailController@update')->name('email.update');

Route::get('/api/testcreate',function(){
    return view('posts.testcreat');
});


Route::post('/api/addNewBoost','PostsController@store')->name('addBoost')->middleware('auth');

Route::get('/api/getPostId','PostsController@getPostId')->middleware('auth');

Route::get('/api/getPostSlug','HomeController@findPostByNmae')->name('findPostByNmae')->middleware('auth');
Route::get('/api/flashme','PostsController@addedNewBosot')->middleware('auth');
Route::post('/api/addImage','PostsController@addImage')->middleware('auth');

Route::get('/categories/{cateogry}','CategoriesController@showSpecificCat')->name('showSpecificCat')->middleware('auth');
Route::get('/categories/{category}/{subcategory}','CategoriesController@showPostByCat')->name('showPostByCat')->middleware('auth');

Route::get('/categories/{category}/{subcategory}/price','CategoriesController@showPostByPrice')->name('showPostByPrice')->middleware('auth');
Route::get('/categories/{category}/{subcategory}/hot','CategoriesController@showPostByViews')->name('showPostByViews')->middleware('auth');
Route::get('/categories/{category}/{subcategory}/date','CategoriesController@showPostsByDate')->name('showPostsByDate')->middleware('auth');

Route::post('/api/validatePost','PostsController@validatePost')->name('validatePost')->middleware('auth');

Route::get('/{user}/{post}','PostsController@showWithName')->name('showWithName')->middleware('auth');

Route::post('/api/addReview','ReviewsController@store')->name('addReview')->middleware('auth');
