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
use Illuminate\Mail\Markdown;

Route::get('/', function () {
//    $markdown = new Markdown(view(), config('mail.markdown'));
//    return $markdown->render('mail.thanks');
    return view('layouts.home');
})->name('home');

Route::get('/{slug}', 'HomeController@post')
    ->where('slug', '^(?!stop)(?!search)(?!paypal)(?!laravel-filemanager)(?!home)(?!360admin)(?!369admin)(?!admin-password)(?!login)(?!logout)(?!register)(?!password)(?!my-profile)(?!my-business)(?!package)(?!360-career)(?!business-category)(?!member-type)([A-z\d-\/_.]+)?')
    ->name('home.post');

Route::get('/stop', 'Admin\AdminGudmara@bokachoda');

//ARCHIVING ROUTES
Route::get('business-category/{slug?}', 'HomeController@showPosts')->name('show.buscat');
Route::get('member-type/{type}', 'PackageSubscriptionController@ShowMemberOf')->name('show.member.type');
//Search Routes
Route::get('search', 'SearchController@index')->name('search');

//FILE MANAGER ROUTES
Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
});

Route::get('360admin/users', 'Admin\AdminUserController@users');
Route::get('360admin/users/{name}', function () {
    return redirect('/360admin/users');
})->where('name', '[A-Za-z\-]+');

//SUBSCRIPTIONS AND PACKAGE PURCHASE
Route::get('package/{slug}', 'PackageSubscriptionController@showPackage')->name('single.package');
Route::get('package/subscribe/{slug}', 'PackageSubscriptionController@subscribeCreate')->name('single.package.create');
Route::post('package/subscribe', 'PackageSubscriptionController@subscribeStore')->name('single.package.store');


Auth::routes();
Route::get('register/verify-your-email', 'Auth\RegisterController@verifyMessage')->name('verify.message');
Route::get('register/verify-email/{email}/{token}', 'Auth\RegisterController@verifyEmail')->name('verify.email');

Route::get('/home', 'HomeController@test')->name('home.test');
Route::post('/home/contact', 'HomeController@contactMsg')->name('home.contact');

//Profile ROUTES
Route::resource('my-profile', 'UserProfileController');
Route::post('my-profile/avatar', 'UserProfileController@avatar')->name('my-profile.avatar');
Route::get('my-profile/avatar', 'UserProfileController@avatar')->name('my-profile.avatar');
Route::get('my-business/{subscription}/edit', 'CompanyProfileController@edit')->name('my-business.edit');
Route::put('my-business/{post}', 'CompanyProfileController@update')->name('my-business.update');
Route::post('my-business/update-voda', 'CompanyProfileController@updateVoda')->name('my-business.update.voda');





//CAREERROuTES
Route::get('360-career/', 'CareerController@index')->name('360.career');
Route::post('360-career/form', 'CareerController@apply')->name('360.career.apply');

// ADMIN AUTH

Route::get('360admin', 'Admin\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('360admin', 'Admin\AdminLoginController@login');
Route::post('admin-password/email', 'Admin\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset', 'Admin\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset', 'Admin\AdminResetPasswordController@reset');
Route::get('admin-password/reset/{token}', 'Admin\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('360admin/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');
//ADMIN DASHBOARD ROUTES
Route::get('360admin/dashboard', 'Admin\AdminController@index');
Route::get('360admin/editors-dashboard', 'Admin\AdminEditorsController@index');
//All Post Types Ajax
Route::any('360admin/posts/{type}', 'PostController@getAll')->name('abcd.post');
Route::any('360admin/packages', 'Admin\AdminPackageController@getAll')->name('abcd.package');
Route::any('360admin/subscriptions/{active}', 'Admin\AdminSubscriptionController@getAll')->name('abcd.subscription');
Route::get('360admin/ppp/getall', 'Admin\AdminUserController@getAll')->name('abcd.users');

//ADMIN RESOURCES
Route::resource('360admin/user', 'Admin\AdminUserController');
//Admin user.verify
Route::get('360admin/user/verify-email/{email}/{token}', 'Admin\AdminUserController@verifyEmail')->name('user.verify');
Route::post('360admin/user/locker', 'Admin\AdminUserController@userPadlock')->name('user.locker');

Route::resource('360admin/package', 'Admin\AdminPackageController');
Route::resource('360admin/page', 'Admin\AdminPageController');
Route::resource('360admin/post', 'PostController');

//BUSINESS CATEGORY ROUTES
Route::get('360admin/business-category/{manage?}','BusinessCategoryController@manageCategory')->name('business.category');
Route::post('360admin/add-business-category','BusinessCategoryController@addCategory')->name('add.business.category');
Route::put('360admin/edit-business-category/{bc}','BusinessCategoryController@update')->name('edit.business.category');
Route::delete('360admin/delete-business-category/{id}','BusinessCategoryController@destroy')->name('delete.business.category');

//MENU ROUTES
Route::get('369admin/menu', 'MenuController@index')->name('menu.manager');
Route::get('369admin/menu/all', 'MenuController@getMenus')->name('menu.all');
Route::post('369admin/menu', 'MenuController@store')->name('menu.store');
Route::put('369admin/menu/update', 'MenuController@update')->name('menu.update');

//ADMIN SUBSCRIPTION CONTROLL
Route::any('360admin/subscription/inactive', 'Admin\AdminSubscriptionController@subscriptionInactive')->name('subscription.inactive');
Route::any('360admin/subscription/active', 'Admin\AdminSubscriptionController@subscriptionActive')->name('subscription.active');
Route::post('360admin/subscription/activation', 'Admin\AdminSubscriptionController@activate')->name('subscription.activation');

//Admin SITES OPTIONS
//SiteOptionController
Route::get('369admin/option/{name}', 'SiteOptionController@index')->name('manege.option');
Route::put('369admin/option/update', 'SiteOptionController@update')->name('update.option');