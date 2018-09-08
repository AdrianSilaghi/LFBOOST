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
Auth::routes();



Route::get('/testInvoice','OrdersController@createInvoice')->name('controlPanel');

Route::get('/controlpanel','PagesController@controlPanel')->middleware('auth')->name('controlPanel');
Route::get('/controlpanel/users','PagesController@manageUsers')->middleware('auth')->name('manageUsers');
Route::get('/controlpanel/orders','PagesController@manageOrders')->middleware('auth')->name('manageOrders');
Route::get('/controlpanel/posts','PagesController@managePosts')->middleware('auth')->name('managePosts');

Route::get('/controlpanel/reviewpost','HomeController@showReviewPost')->middleware('auth')->name('showReviewPost');

Route::get('/contactsupport/api/getFirstQuestions','ContactSupportController@getFirstQuestions')->middleware('auth');


Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/getuserip','PagesController@getUserIp');
Route::get('/boosts/api/destroy', 'PostsController@destroy')->middleware('auth')->name('destroy');

Route::post('/api/validatePrice','PostsController@validatePriceDescription')->middleware('auth');
Route::post('/api/validatePostDescription','PostsController@validatePostDescription')->middleware('auth');

Route::get('/api/detachQuestions','PostsController@detachQuestions')->middleware('auth')->name('detachQuestions');

Route::post('/api/boost/savechanges','PostsController@updateBoost')->middleware('auth')->name('updateBoost');

Route::get('/sitemap/posts','SiteMapController@posts');

Route::get('/', 'PagesController@index')->name('index');
Route::get('/privacy-policy','PagesController@privacy')->name('privacy');
Route::get('/tos','PagesController@tos')->name('tos');
Route::get('/howtofindabooster','PagesController@booster')->name('howToFind');
Route::get('/trustsafety','PagesController@trustsafety')->name('trustsafety');
Route::post('/contactsupport/api/send', 'EmailController@send')->middleware('auth');

Route::get('/contact', 'PagesController@contact')->name('getContactForm');

Route::get('/become_a_seller','PagesController@becomeSeller')->name('becomeSeller');
Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/dashboard/inbox','ChatController@index')->name('dashboard.getContacts')->middleware('auth');
Route::get('/dashboard/inbox/{id}','ChatController@show')->name('dashboard.showChat')->middleware('auth');
Route::post('/dashboard/inbox/getChat/{id}','ChatController@getChat')->middleware('auth');
Route::post('/dahsboard/inbox/sendChat','ChatController@sendChat')->middleware('auth');
Route::get('/dashboard/boosts','PostsController@myBoosts')->middleware('auth')->name('myBoosts');

Route::get('/dashboard/editboost','PostsController@editPost')->middleware('auth')->name('editBoost');

Route::post('/dashboard/api/addContact','ContactsController@store')->middleware('auth');
Route::post('/dashbaord/api/checkIfContact','ContactsController@checkIfContacts')->middleware('auth');

Route::post('/dasbhoard/api/addPendingMoney','PendingmoneyController@addMoney')->middleware('auth');

Route::get('/dashboard/inbox/messages','MessageController@fetch')->middleware('auth');
Route::post('/dashboard/inbox/messages','MessageController@sentMessage')->middleware('auth');


Route::post('/order/api/markascomplete','OrdersController@markOrderAsComplete')->middleware('auth');
Route::post('/order/api/markasactive','OrdersController@markOrderAsActive')->middleware('auth');
Route::post('/order/api/markasdelivered','OrdersController@markOrderAsDelivered')->middleware('auth');
Route::post('/order/api/addProof','OrdersController@addProof')->middleware('auth');


Route::post('/register/api/validate','UsersController@validateForm');
Route::post('/dashboard/api/validatePayout','PaymentsController@validatePayout')->middleware('auth');
Route::post('/dashboard/api/removeWithdrawal','PendingmoneyController@removeWithdrawal')->middleware('auth');
Route::post('/payment/api/payOut','PaymentsController@payout')->middleware('auth');

Route::get('/dashboard/orders','OrdersController@dashboardOrders')->name('dashboardOrders')->middleware('auth');

Route::get('/dashboard/order','OrdersController@speicifOrder')->name('speicifOrder')->middleware('auth');


Route::get('/dashboard/earnings','PendingmoneyController@earnings')->name('earnings')->middleware('auth');


Route::post('/notification/api/get','NotificationsController@get')->name('notificationGet');
Route::post('/notification/api/read','NotificationsController@read')->name('notificationRead');

Route::get('/payment/overview','PaymentsController@overview')->name('payment.oveview')->middleware('auth');
Route::get('/payment/finish','PaymentsController@finish')->name('payment.finish')->middleware('auth');
Route::get('/payment/api/token','PaymentsController@token')->middleware('auth');
Route::post('/payment/api/process','PaymentsController@payment')->middleware('auth');
Route::post('/payment/api/getPostPrice','PaymentsController@getPostPrice')->middleware('auth');
Route::get('/payment/api/paywithpayoal','PaymentsController@payWithPaypal')->name('payWithPaypal')->middleware('auth');

Route::get('/payment/api/storePayment','PaymentsController@storePayment')->middleware('auth')->name('storePayment');

Route::post('/order/api/newOrder','OrdersController@newOrder')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/home/create', 'HomeController@create')->name('home.create')->middleware('auth');

Route::post('avatar','UsersController@update_avatar')->name('users.avatar');

Route::resource('posts', 'PostsController');
//Route::resource('/home/categories', 'CategoriesController')->middleware('auth');
Route::resource('/home/users', 'UsersController')->middleware('auth');
//Route::resource('/home/realms', 'RealmsController')->middleware('auth');
Route::get('/{slug}','UsersController@show')->name('show.user.slug');

Auth::routes();

//control panel routes
Route::post('/controlpanel/api/verifypost','PostsController@verifyPost')->name('verifyPost')->middleware('auth');
Route::post('/controlpanel/api/denypost','PostsController@denyPost')->name('denyPost')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/settings', 'PagesController@settings')->name('settings')->middleware('auth');
Route::get('/settings/account', 'PagesController@account')->name('account')->middleware('auth');
Route::get('/settings/security', 'PagesController@security')->name('security')->middleware('auth');
Route::get('/settings/payment', 'PagesController@payment')->name('payment')->middleware('auth');

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

Route::post('/settings/payment','UsersController@updatePaypalEmail')->name('updatePaypalEmail')->middleware('auth');

Route::get('/api/testcreate',function(){
    return view('posts.testcreat');
});


Route::post('/api/addNewBoost','PostsController@store')->name('addBoost')->middleware('auth');

Route::get('/api/getPostId','PostsController@getPostId')->middleware('auth');

Route::get('/api/getPostSlug','HomeController@findPostByNmae')->name('findPostByNmae')->middleware('auth');
Route::get('/api/flashme','PostsController@addedNewBosot')->middleware('auth');
Route::post('/api/addImage','PostsController@addImage')->middleware('auth');

Route::get('/categories/{cateogry}','CategoriesController@showSpecificCat')->name('showSpecificCat');
Route::get('/categories/{category}/{subcategory}','CategoriesController@showPostByCat')->name('showPostByCat');

Route::get('/categories/{category}/{subcategory}/price','CategoriesController@showPostByPrice')->name('showPostByPrice');
Route::get('/categories/{category}/{subcategory}/hot','CategoriesController@showPostByViews')->name('showPostByViews');
Route::get('/categories/{category}/{subcategory}/date','CategoriesController@showPostsByDate')->name('showPostsByDate');

Route::post('/api/validatePost','PostsController@validatePost')->name('validatePost')->middleware('auth');

Route::get('/{user}/{post}','PostsController@showWithName')->name('showWithName');

Route::post('/api/addReview','ReviewsController@store')->name('addReview')->middleware('auth');

