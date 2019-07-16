<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_WARNING);
}
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin',function(){
        return view('admin.index');
    });
    Route::resource('admin/users','AdminUsersController');
    Route::resource('admin/posts','AdminPostsController');
    Route::resource('admin/categories','AdminCategoriesController');
    Route::resource('admin/photos','AdminPhotosController');
    Route::get('admin/users/delete/confirm/{id}','AdminUsersController@confirmDelete');
    Route::get('admin/posts/delete/confirm/{id}','AdminPostsController@confirmDelete');
    Route::get('admin/categories/delete/confirm/{id}','AdminCategoriesController@confirmDelete');
    Route::get('admin/photos/delete/confirm/{id}','AdminPhotosController@confirmDelete');
    Route::get('admin/comments/delete/confirm/{id}','PostCommentsController@confirmDelete');
    Route::get('admin/comment/replies/delete/confirm/{id}','CommentRepliesController@confirmDelete');
    Route::resource('admin/comments','PostCommentsController');
    Route::resource('admin/comment/replies','CommentRepliesController');
});
Route::group(['middleware'=>'admin'],function(){
    Route::post('/comment/reply','CommentRepliesController@createReply');
    Route::post('/comment','CommentRepliesController@createcomment');
});
