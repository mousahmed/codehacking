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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index');
Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin',function(){
        return view('admin.index');
    });
    Route::post('/comment/reply','CommentRepliesController@createReply');
    Route::post('/comment','CommentRepliesController@createcomment');
    Route::resource('admin/users','AdminUsersController',['names'=>[
        'index' =>'admin.users.index',
        'create' =>'admin.users.create',
        'store' =>'admin.users.store',
        'edit' =>'admin.users.edit',
        'show' =>'admin.users.show',



    ]]);
    Route::resource('admin/posts','AdminPostsController',['names'=>[
        'index' =>'admin.posts.index',
        'create' =>'admin.posts.create',
        'store' =>'admin.posts.store',
        'edit' =>'admin.posts.edit',
        'show' =>'admin.posts.show',

    ]]);
    Route::resource('admin/categories','AdminCategoriesController',['names'=>[
        'index' =>'admin.categories.index',
        'create' =>'admin.categories.create',
        'store' =>'admin.categories.store',
        'edit' =>'admin.categories.edit',
        'show' =>'admin.categories.show',

    ]]);
    Route::resource('admin/photos','AdminPhotosController',['names'=>[
        'index' =>'admin.photos.index',
        'create' =>'admin.photos.create',
        'store' =>'admin.photos.store',
        'edit' =>'admin.photos.edit',


    ]]);
    Route::get('admin/users/delete/confirm/{id}','AdminUsersController@confirmDelete');
    Route::get('admin/posts/delete/confirm/{id}','AdminPostsController@confirmDelete');
    Route::get('admin/categories/delete/confirm/{id}','AdminCategoriesController@confirmDelete');
    Route::get('admin/photos/delete/confirm/{id}','AdminPhotosController@confirmDelete');
    Route::get('admin/comments/delete/confirm/{id}','PostCommentsController@confirmDelete');
    Route::get('admin/comment/replies/delete/confirm/{id}','CommentRepliesController@confirmDelete');
    Route::resource('admin/comments','PostCommentsController',['names'=>[
        'index' =>'admin.comments.index',
        'create' =>'admin.comments.create',
        'store' =>'admin.comments.store',
        'edit' =>'admin.comments.edit',
        'show' =>'admin.comments.show',

    ]]);
    Route::resource('admin/comment/replies','CommentRepliesController',['names'=>[
        'index' =>'admin.comment.replies.index',
        'create' =>'admin.comment.replies.create',
        'store' =>'admin.comment.replies.store',
        'edit' =>'admin.comment.replies.edit',
        'show' =>'admin.comment.replies.show',

    ]]);
});

