<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('back.dashboard');
})->middleware(['auth', 'ensureemail'])->name('dashboard');

require __DIR__ . '/auth.php';

// frontend pages
Route::get('/', 'PageController@index')->name('home');
Route::get('/posts', 'PageController@posts')->name('posts');
// Route::get('/posts/{post}', 'PageController@showPost')->name('posts.view');
Route::get('/posts/{slug}', 'PageController@showPostSlug')->name('posts-slug.view');
Route::get('/privacy-policy', 'PageController@showPrivacypolicy')->name('privacy-policy.view');
Route::get('/contact-us', 'PageController@showContactForm')->name('contact-us.view');

Route::get('/category/{category}', 'PageController@showCategory')->name('categories.view');
Route::get('/profile/{id}', 'PageController@showUser')->name('userprofile.view');

Route::post('/newsfeed/subscribe', 'PageController@newsFeedSubscribe')->name('newsfeed.subscribe');

// admin pages
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'ensureemail']], function () {
    Route::get('posts/{post}/edit', 'PageController@editPost')->name("posts.edit");
    Route::put('posts/{post}', 'PageController@updatePost')->name('posts.update');

    Route::resource('posts', 'PostController')->except(['edit', 'update']);

    Route::resource('categories', 'CategoryController')->except('show');
    Route::get('profile', 'ProfileController@index')->name("profile.view");
    Route::post('profile/update/{id}', 'ProfileController@update')->name("update.profile");

    Route::get('subscribers/list', 'NewsLetterSubscribersController@listSubscribers')->name("newslettersubscribers.list");
    Route::get('recent_activity/user', 'UsersController@recentActivty')->name("user_activity.recent");

    Route::get('pricacy-policy/list', 'PrivacyPolicyController@list')->name("privacy-policy.list");
    Route::get('pricacy-policy/create-page', 'PrivacyPolicyController@createPage')->name("privacy-policy.create");
    Route::post('pricacy-policy/store', 'PrivacyPolicyController@storePage')->name("privacy-policy.store");
    Route::get('pricacy-policy/update-page', 'PrivacyPolicyController@updatePageShow')->name("privacy-policy.updatepageShow");
    Route::post('pricacy-policy/update', 'PrivacyPolicyController@updatePage')->name("privacy-policy.update");
    Route::delete('pricacy-policy/delete', 'PrivacyPolicyController@deletePage')->name("privacy-policy.delete");

    Route::get('terms-condition/list', 'TermsAndConditionController@list')->name("terms-condition.list");
    Route::get('terms-condition/create-page', 'TermsAndConditionController@createPage')->name("terms-condition.create");
    Route::post('terms-condition/store', 'TermsAndConditionController@storePage')->name("terms-condition.store");
    Route::get('terms-condition/update-page', 'TermsAndConditionController@updatePageShow')->name("terms-condition.updatepageShow");
    Route::post('terms-condition/update', 'TermsAndConditionController@updatePage')->name("terms-condition.update");
    Route::delete('terms-condition/delete', 'TermsAndConditionController@deletePage')->name("terms-condition.delete");

    Route::get('web-socials/list', 'WebSocialsController@list')->name("web-socials.list");
    Route::get('web-socials/create-page', 'WebSocialsController@createPage')->name("web-socials.create");
    Route::post('web-socials/store', 'WebSocialsController@storePage')->name("web-socials.store");
    Route::get('web-socials/update-page/{id}', 'WebSocialsController@updatePageShow')->name("web-socials.updatepageShow");
    Route::post('web-socials/update', 'WebSocialsController@updatePage')->name("web-socials.update");
    Route::delete('web-socials/delete', 'WebSocialsController@deletePage')->name("web-socials.delete");

});
