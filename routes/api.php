<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//for user
Route::post('login','App\Http\Controllers\Api\AuthController@login');
Route::post('register','App\Http\Controllers\Api\AuthController@register');
Route::get('logout','App\Http\Controllers\Api\AuthController@logout');
Route::post('save_user_info','App\Http\Controllers\Api\AuthController@saveUserInfo')->middleware('jwtAuth');
Route::post('save_user_business_registered','App\Http\Controllers\Api\AuthController@saveUserBusinessRegistered')->middleware('jwtAuth');
Route::get('get_user_info','App\Http\Controllers\Api\AuthController@getUserInfo')->middleware('jwtAuth');
Route::post('update_name_password', 'App\Http\Controllers\Api\AuthController@updateNamePassword')->middleware('jwtAuth'); 

//for posts
Route::post('posts/create','App\Http\Controllers\Api\PostsController@create')->middleware('jwtAuth');
Route::post('posts/delete','App\Http\Controllers\Api\PostsController@delete')->middleware('jwtAuth');
Route::post('posts/update','App\Http\Controllers\Api\PostsController@update')->middleware('jwtAuth');
Route::get('posts','App\Http\Controllers\Api\PostsController@posts')->middleware('jwtAuth');
Route::get('post','App\Http\Controllers\Api\PostsController@post')->middleware('jwtAuth');
Route::get('posts/my_posts','App\Http\Controllers\Api\PostsController@myPosts')->middleware('jwtAuth');

//for comments
Route::post('comments/create','App\Http\Controllers\Api\CommentsController@create')->middleware('jwtAuth');
Route::post('comments/delete','App\Http\Controllers\Api\CommentsController@delete')->middleware('jwtAuth');
Route::post('comments/update','App\Http\Controllers\Api\CommentsController@update')->middleware('jwtAuth');
Route::post('posts/comments','App\Http\Controllers\Api\CommentsController@comments')->middleware('jwtAuth');

//for likes
Route::post('posts/like','App\Http\Controllers\Api\LikesController@like')->middleware('jwtAuth');

//for Orders
Route::post('orders/create','App\Http\Controllers\Api\OrdersController@create')->middleware('jwtAuth');
Route::post('orders/delete','App\Http\Controllers\Api\OrdersController@delete')->middleware('jwtAuth');
Route::post('orders/update','App\Http\Controllers\Api\OrdersController@update')->middleware('jwtAuth');
Route::get('orders','App\Http\Controllers\Api\OrdersController@orders')->middleware('jwtAuth');

//for comment orders
Route::post('comment_orders/create','App\Http\Controllers\Api\CommentOrdersController@create')->middleware('jwtAuth');
Route::post('comment_orders/delete','App\Http\Controllers\Api\CommentOrdersController@delete')->middleware('jwtAuth');
Route::post('comment_orders/update','App\Http\Controllers\Api\CommentOrdersController@update')->middleware('jwtAuth');
Route::post('orders/comment_orders','App\Http\Controllers\Api\CommentOrdersController@commentOrders')->middleware('jwtAuth');

//for registeredlocations
Route::post('registeredlocations/create','App\Http\Controllers\Api\RegisteredlocationsController@create')->middleware('jwtAuth');
Route::post('registeredlocations/delete','App\Http\Controllers\Api\RegisteredlocationsController@delete')->middleware('jwtAuth');
Route::get('registeredlocationslist','App\Http\Controllers\Api\RegisteredlocationsController@registeredlocationslist')->middleware('jwtAuth');

Route::post('post_b_i_s/create','App\Http\Controllers\Api\PostBIsController@create')->middleware('jwtAuth');
Route::post('post_b_i_s/create_consumable','App\Http\Controllers\Api\PostBIsController@create_consumable')->middleware('jwtAuth');
Route::post('post_b_i_s/create_news','App\Http\Controllers\Api\PostBIsController@create_news')->middleware('jwtAuth');
Route::post('post_b_i_s/create_taxi','App\Http\Controllers\Api\PostBIsController@create_taxi')->middleware('jwtAuth');
Route::post('post_b_i_s/create_event','App\Http\Controllers\Api\PostBIsController@create_event')->middleware('jwtAuth');
Route::get('post_b_i_s','App\Http\Controllers\Api\PostBIsController@postBIs')->middleware('jwtAuth');
Route::post('post_b_i_s/update','App\Http\Controllers\Api\PostBIsController@update')->middleware('jwtAuth');
Route::get('post_b_i_s/post','App\Http\Controllers\Api\PostBIsController@post')->middleware('jwtAuth');
Route::get('post_b_i_s/my_posts','App\Http\Controllers\Api\PostBIsController@myPosts')->middleware('jwtAuth');
Route::post('post_b_i_s/delete','App\Http\Controllers\Api\PostBIsController@delete')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_type','App\Http\Controllers\Api\PostBIsController@updatePostType')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_general_infor','App\Http\Controllers\Api\PostBIsController@updatePostGeneralInfor')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_advert','App\Http\Controllers\Api\PostBIsController@updatePostAdvert')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_photo','App\Http\Controllers\Api\PostBIsController@updatePostPhoto')->middleware('jwtAuth');
Route::post('post_b_i_s/update_consumable_prod_item_desc','App\Http\Controllers\Api\PostBIsController@updateConsumableProdItemDesc')->middleware('jwtAuth');
Route::post('post_b_i_s/update_consumable_prod_infor','App\Http\Controllers\Api\PostBIsController@updateConsumableProdInfor')->middleware('jwtAuth');
Route::post('pots_b_i_s/update_relation_counter', 'App\Http\Controllers\Api\PostBIsController@updateRelationCounter')->middleware('jwtAuth');