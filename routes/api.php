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
Route::post('update_user_address', 'App\Http\Controllers\Api\AuthController@updateUserAddress')->middleware('jwtAuth');
Route::post('update_user_business_address', 'App\Http\Controllers\Api\AuthController@updateUserAddress')->middleware('jwtAuth');
Route::post('update_user_photo', 'App\Http\Controllers\Api\AuthController@updateUserPhoto')->middleware('jwtAuth');
Route::post('update_user_business_photo', 'App\Http\Controllers\Api\AuthController@updateUserBusinessPhoto')->middleware('jwtAuth');
Route::post('update_delivery_std_cost_infor', 'App\Http\Controllers\Api\AuthController@updateDeliveryStdCostInfor')->middleware('jwtAuth');
Route::post('update_user_business_general_infor', 'App\Http\Controllers\Api\AuthController@updateBusinessGeneralInfor')->middleware('jwtAuth');
Route::post('update_user_business_status', 'App\Http\Controllers\Api\AuthController@updateBusinessStatus')->middleware('jwtAuth');
Route::post('forgot_password', 'App\Http\Controllers\Api\NewPasswordController@forgotPassword');
Route::get('reset_password', 'App\Http\Controllers\Api\NewPasswordController@reset');
Route::post('update_password', 'App\Http\Controllers\Api\NewPasswordController@updatePassword');
Route::post('save_user_business_infor', 'App\Http\Controllers\Api\AuthController@saveUserBusinessInfor')->middleware('jwtAuth');
Route::post('update_user_business_operating_hours', 'App\Http\Controllers\Api\AuthController@updateBusinessOperatingHour')->middleware('jwtAuth');
Route::post('update_user_business_password', 'App\Http\Controllers\Api\AuthController@updateUserBusinessPassword')->middleware('jwtAuth');
Route::post('update_user_business_opening_operating_hours', 'App\Http\Controllers\Api\AuthController@updateBusinessOpeningOperatingHours')->middleware('jwtAuth');
Route::post('update_user_business_closing_operating_hours', 'App\Http\Controllers\Api\AuthController@updateBusinessClosingOperatingHours')->middleware('jwtAuth');
Route::post('update_user_business_allow_auto_operating_hours', 'App\Http\Controllers\Api\AuthController@updateBusinessAllowAutoOperatingHours')->middleware('jwtAuth');
Route::post('save_whatsapp_info', 'App\Http\Controllers\Api\AuthController@saveWhatsappInfo')->middleware('jwtAuth');
Route::post('update_whatsapp_url_info', 'App\Http\Controllers\Api\AuthController@updateWhatsappUrlInfo')->middleware('jwtAuth');
Route::post('update_whatsapp_enabled_info', 'App\Http\Controllers\Api\AuthController@updateWhatsappEnabledInfo')->middleware('jwtAuth');


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
Route::get('order','App\Http\Controllers\Api\OrdersController@order')->middleware('jwtAuth');
Route::get('my_orders','App\Http\Controllers\Api\OrdersController@myorders')->middleware('jwtAuth');
Route::get('my_business_orders','App\Http\Controllers\Api\OrdersController@mybusinessorders')->middleware('jwtAuth');
Route::post('orders/update_order_status','App\Http\Controllers\Api\OrdersController@updateOrderStatus')->middleware('jwtAuth');
Route::post('orders/update_e_t_d','App\Http\Controllers\Api\OrdersController@updateOrderETD')->middleware('jwtAuth');
Route::post('orders/update_e_t_p','App\Http\Controllers\Api\OrdersController@updateOrderETP')->middleware('jwtAuth');
Route::post('orders/update_delivery_std_cost_infor','App\Http\Controllers\Api\OrdersController@updateDeliveryStdCostInfor')->middleware('jwtAuth');
Route::post('orders/update_qr_payload','App\Http\Controllers\Api\OrdersController@updateQrPayload')->middleware('jwtAuth');
Route::post('orders/update_redeemed','App\Http\Controllers\Api\OrdersController@updateRedeemed')->middleware('jwtAuth');

//for comment orders
Route::post('comment_orders/create','App\Http\Controllers\Api\CommentOrdersController@create')->middleware('jwtAuth');
Route::post('comment_orders/delete','App\Http\Controllers\Api\CommentOrdersController@delete')->middleware('jwtAuth');
Route::post('comment_orders/update','App\Http\Controllers\Api\CommentOrdersController@update')->middleware('jwtAuth');
Route::post('comment_orders/update_comment_info1','App\Http\Controllers\Api\CommentOrdersController@updateCommentInfo1')->middleware('jwtAuth');
Route::post('comment_orders/update_comment_info2','App\Http\Controllers\Api\CommentOrdersController@updateCommentInfo2')->middleware('jwtAuth');
Route::get('comment_orders/order_comment_orders','App\Http\Controllers\Api\CommentOrdersController@orderCommentOrders')->middleware('jwtAuth');
Route::get('comment_orders/my_comment_orders','App\Http\Controllers\Api\CommentOrdersController@myCommentOrders')->middleware('jwtAuth');
Route::get('comment_orders/my_business_comment_orders','App\Http\Controllers\Api\CommentOrdersController@myBusinessCommentOrders')->middleware('jwtAuth');
Route::get('comment_orders/post_comment_orders','App\Http\Controllers\Api\CommentOrdersController@postCommentOrders')->middleware('jwtAuth');

//for comment orders components
Route::post('comment_order_components/create','App\Http\Controllers\Api\CommentOrderComponentsController@create')->middleware('jwtAuth');
Route::post('comment_order_components/delete','App\Http\Controllers\Api\CommentOrderComponentsController@delete')->middleware('jwtAuth');
Route::post('comment_order_components/update_comment_order_id','App\Http\Controllers\Api\CommentOrderComponentsController@updateCommentOrderId')->middleware('jwtAuth');
Route::post('comment_order_components/update_order_id','App\Http\Controllers\Api\CommentOrderComponentsController@updateOrderId')->middleware('jwtAuth');
Route::post('comment_order_components/update_post_id','App\Http\Controllers\Api\CommentOrderComponentsController@updatePostId')->middleware('jwtAuth');
Route::post('comment_order_components/update_component_name','App\Http\Controllers\Api\CommentOrderComponentsController@updateComponentName')->middleware('jwtAuth');
Route::post('comment_order_components/update_component_code','App\Http\Controllers\Api\CommentOrderComponentsController@updateComponentCode')->middleware('jwtAuth');
Route::post('comment_order_components/update_component_desc','App\Http\Controllers\Api\CommentOrderComponentsController@updateComponentDesc')->middleware('jwtAuth');
Route::post('comment_order_components/update_component_type','App\Http\Controllers\Api\CommentOrderComponentsController@updateComponentType')->middleware('jwtAuth');
Route::post('comment_order_components/update_component_info','App\Http\Controllers\Api\CommentOrderComponentsController@updateComponentInfo')->middleware('jwtAuth');
Route::post('comment_order_components/update_price_per_component','App\Http\Controllers\Api\CommentOrderComponentsController@updatePricePerComponent')->middleware('jwtAuth');
Route::post('comment_order_components/update_weight_per_component','App\Http\Controllers\Api\CommentOrderComponentsController@updateWeightPerComponent')->middleware('jwtAuth');
Route::get('comment_order_components/order_components','App\Http\Controllers\Api\CommentOrderComponentsController@orderComponents')->middleware('jwtAuth');
Route::get('comment_order_components/comment_order_components','App\Http\Controllers\Api\CommentOrderComponentsController@commentOrderComponents')->middleware('jwtAuth');
Route::get('comment_order_components/components','App\Http\Controllers\Api\CommentOrderComponentsController@components')->middleware('jwtAuth');
Route::get('comment_order_components/my_business_ordered_components','App\Http\Controllers\Api\CommentOrderComponentsController@myBusinessOrderedComponents')->middleware('jwtAuth');
Route::get('comment_order_components/my_ordered_components','App\Http\Controllers\Api\CommentOrderComponentsController@myOrderedComponents')->middleware('jwtAuth');
Route::get('comment_order_components/comment_order_component','App\Http\Controllers\Api\CommentOrderComponentsController@commentOrderComponent')->middleware('jwtAuth');


//for registeredlocations
Route::post('registeredlocations/create','App\Http\Controllers\Api\RegisteredlocationsController@create')->middleware('jwtAuth');
Route::post('registeredlocations/delete','App\Http\Controllers\Api\RegisteredlocationsController@delete')->middleware('jwtAuth');
Route::get('registeredlocationslist','App\Http\Controllers\Api\RegisteredlocationsController@registeredlocationslist');
Route::post('registeredlocations/update_aka1','App\Http\Controllers\Api\RegisteredlocationsController@updateAka1')->middleware('jwtAuth');
Route::post('registeredlocations/update_aka2','App\Http\Controllers\Api\RegisteredlocationsController@updateAka2')->middleware('jwtAuth');
Route::post('registeredlocations/update_aka3','App\Http\Controllers\Api\RegisteredlocationsController@updateAka3')->middleware('jwtAuth');
Route::post('registeredlocations/update_aka4','App\Http\Controllers\Api\RegisteredlocationsController@updateAka4')->middleware('jwtAuth');

//
Route::post('post_b_i_s/create','App\Http\Controllers\Api\PostBIsController@create')->middleware('jwtAuth');
Route::get('post_b_i_s','App\Http\Controllers\Api\PostBIsController@postBIs')->middleware('jwtAuth');
Route::post('post_b_i_s/update','App\Http\Controllers\Api\PostBIsController@update')->middleware('jwtAuth');
Route::get('post_b_i_s/post','App\Http\Controllers\Api\PostBIsController@post')->middleware('jwtAuth');
Route::get('post_b_i_s/my_posts','App\Http\Controllers\Api\PostBIsController@myPosts')->middleware('jwtAuth');
Route::post('post_b_i_s/delete','App\Http\Controllers\Api\PostBIsController@delete')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_type','App\Http\Controllers\Api\PostBIsController@updatePostType')->middleware('jwtAuth');
Route::post('post_b_i_s/update_prod_business_name','App\Http\Controllers\Api\PostBIsController@updateProdBusinessName')->middleware('jwtAuth');
Route::post('post_b_i_s/update_prod_name','App\Http\Controllers\Api\PostBIsController@updateProdName')->middleware('jwtAuth');
Route::post('post_b_i_s/update_prod_desc','App\Http\Controllers\Api\PostBIsController@updateProdDesc')->middleware('jwtAuth');
Route::post('post_b_i_s/update_prod_status','App\Http\Controllers\Api\PostBIsController@updateProdStatus')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_general_infor','App\Http\Controllers\Api\PostBIsController@updatePostGeneralInfor')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_general_infor1','App\Http\Controllers\Api\PostBIsController@updatePostGeneralInfor1')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_general_infor2','App\Http\Controllers\Api\PostBIsController@updatePostGeneralInfor2')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_general_infor3','App\Http\Controllers\Api\PostBIsController@updatePostGeneralInfor3')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_general_infor4','App\Http\Controllers\Api\PostBIsController@updatePostGeneralInfor4')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_advert','App\Http\Controllers\Api\PostBIsController@updatePostAdvert')->middleware('jwtAuth');
Route::post('post_b_i_s/update_post_photo','App\Http\Controllers\Api\PostBIsController@updatePostPhoto')->middleware('jwtAuth');
Route::post('post_b_i_s/update_consumable_prod_item_desc','App\Http\Controllers\Api\PostBIsController@updateConsumableProdItemDesc')->middleware('jwtAuth');
Route::post('post_b_i_s/update_consumable_prod_infor','App\Http\Controllers\Api\PostBIsController@updateConsumableProdInfor')->middleware('jwtAuth');
Route::post('pots_b_i_s/update_relation_counter', 'App\Http\Controllers\Api\PostBIsController@updateRelationCounter')->middleware('jwtAuth');
Route::post('pots_b_i_s/update_delivery_std_cost_infor', 'App\Http\Controllers\Api\PostBIsController@updateDeliveryStdCostInfor')->middleware('jwtAuth');
       
//for likeBIs
Route::post('post_b_i_s/like','App\Http\Controllers\Api\LikeBIsController@like')->middleware('jwtAuth');

//for comments
Route::post('comment_b_i_s/create','App\Http\Controllers\Api\CommentBIsController@create')->middleware('jwtAuth');
Route::post('comment_b_i_s/delete','App\Http\Controllers\Api\CommentBIsController@delete')->middleware('jwtAuth');
Route::post('comment_b_i_s/update','App\Http\Controllers\Api\CommentBIsController@update')->middleware('jwtAuth');
Route::post('posts/comment_b_i_s','App\Http\Controllers\Api\CommentBIsController@comments')->middleware('jwtAuth');

Route::post('teams/create','App\Http\Controllers\Api\TeamsController@create')->middleware('jwtAuth');
Route::post('teams/update','App\Http\Controllers\Api\TeamsController@update')->middleware('jwtAuth');
Route::post('teams/update_team_name','App\Http\Controllers\Api\TeamsController@updateTeamName')->middleware('jwtAuth');
Route::post('teams/update_team_aka_name','App\Http\Controllers\Api\TeamsController@updateTeamAkaName')->middleware('jwtAuth');
Route::post('teams/update_team_desc','App\Http\Controllers\Api\TeamsController@updateTeamDesc')->middleware('jwtAuth');
Route::post('teams/update_team_info','App\Http\Controllers\Api\TeamsController@updateTeamInfo')->middleware('jwtAuth');
Route::post('teams/update_team_info2','App\Http\Controllers\Api\TeamsController@updateTeamInfo2')->middleware('jwtAuth');
Route::post('teams/update_matches_played','App\Http\Controllers\Api\TeamsController@updateMatchesPlayed')->middleware('jwtAuth');
Route::post('teams/update_matches_won','App\Http\Controllers\Api\TeamsController@updateMatchesWon')->middleware('jwtAuth');
Route::post('teams/update_matches_drawn','App\Http\Controllers\Api\TeamsController@updateMatchesDrawn')->middleware('jwtAuth');
Route::post('teams/update_matches_lost','App\Http\Controllers\Api\TeamsController@updateMatchesLost')->middleware('jwtAuth');
Route::post('teams/update_points','App\Http\Controllers\Api\TeamsController@updatePoints')->middleware('jwtAuth');
Route::post('teams/update_goals','App\Http\Controllers\Api\TeamsController@updateGoals')->middleware('jwtAuth');
Route::post('teams/update_current_news','App\Http\Controllers\Api\TeamsController@updateCurrentNews')->middleware('jwtAuth');
Route::post('teams/update_post_photo','App\Http\Controllers\Api\TeamsController@updatePostPhoto')->middleware('jwtAuth');
Route::get('teams','App\Http\Controllers\Api\TeamsController@teams')->middleware('jwtAuth');
Route::get('teams/team','App\Http\Controllers\Api\TeamsController@team')->middleware('jwtAuth');
Route::get('teams/my_teams','App\Http\Controllers\Api\TeamsController@myTeams')->middleware('jwtAuth');
Route::post('teams/delete','App\Http\Controllers\Api\TeamsController@delete')->middleware('jwtAuth');


Route::post('players/create','App\Http\Controllers\Api\PlayersController@create')->middleware('jwtAuth');
Route::post('players/update','App\Http\Controllers\Api\PlayersController@update')->middleware('jwtAuth');
Route::post('players/update_player_name','App\Http\Controllers\Api\PlayersController@UpdatePlayerName')->middleware('jwtAuth');
Route::post('players/update_player_lastname','App\Http\Controllers\Api\PlayersController@updatePlayerLastName')->middleware('jwtAuth');
Route::post('players/update_player_age','App\Http\Controllers\Api\PlayersController@updatePlayerAge')->middleware('jwtAuth');
Route::post('players/update_player_height','App\Http\Controllers\Api\PlayersController@updatePlayerHeight')->middleware('jwtAuth');
Route::post('players/update_player_weight','App\Http\Controllers\Api\PlayersController@updatePlayerWeight')->middleware('jwtAuth');
Route::post('players/update_matches_played','App\Http\Controllers\Api\PlayersController@updateMatchesPlayed')->middleware('jwtAuth');
Route::post('players/update_player_address','App\Http\Controllers\Api\PlayersController@updatePlayerAddress')->middleware('jwtAuth');
Route::post('players/update_player_position','App\Http\Controllers\Api\PlayersController@updatePlayerPosition')->middleware('jwtAuth');
Route::post('players/update_jersey_number','App\Http\Controllers\Api\PlayersController@updateJerseyNumber')->middleware('jwtAuth');
Route::post('players/update_running_speed','App\Http\Controllers\Api\PlayersController@updateRunningSpeed')->middleware('jwtAuth');
Route::post('players/update_goals','App\Http\Controllers\Api\PlayersController@updateGoals')->middleware('jwtAuth');
Route::post('players/update_assists','App\Http\Controllers\Api\PlayersController@updateAssists')->middleware('jwtAuth');
Route::post('players/update_player_info','App\Http\Controllers\Api\PlayersController@updatePlayerInfo')->middleware('jwtAuth');
Route::post('players/update_player_info2','App\Http\Controllers\Api\PlayersController@updatePlayerInfo2')->middleware('jwtAuth');
Route::post('players/update_post_photo','App\Http\Controllers\Api\PlayersController@updatePlayerInfo')->middleware('jwtAuth');
Route::post('players/delete','App\Http\Controllers\Api\PlayersController@delete')->middleware('jwtAuth');
Route::get('players','App\Http\Controllers\Api\PlayersController@players')->middleware('jwtAuth');
Route::get('players/player','App\Http\Controllers\Api\PlayersController@player')->middleware('jwtAuth');

Route::post('games/create','App\Http\Controllers\Api\GamesController@create')->middleware('jwtAuth');
Route::post('games/update','App\Http\Controllers\Api\GamesController@update')->middleware('jwtAuth');
Route::post('games/update_home_team_id','App\Http\Controllers\Api\GamesController@updateHomeTeamId')->middleware('jwtAuth');
Route::post('games/update_away_team_id','App\Http\Controllers\Api\GamesController@updateAwayTeamId')->middleware('jwtAuth');
Route::post('games/update_home_team_name','App\Http\Controllers\Api\GamesController@updateHomeTeamName')->middleware('jwtAuth');
Route::post('games/update_away_team_name','App\Http\Controllers\Api\GamesController@updateAwayTeamName')->middleware('jwtAuth');
Route::post('games/update_home_team_score','App\Http\Controllers\Api\GamesController@updateHomeTeamScore')->middleware('jwtAuth');
Route::post('games/update_away_team_score','App\Http\Controllers\Api\GamesController@updateAwayTeamScore')->middleware('jwtAuth');
Route::post('games/update_game_results','App\Http\Controllers\Api\GamesController@updateGameResults')->middleware('jwtAuth');
Route::post('games/update_game_status','App\Http\Controllers\Api\GamesController@updateGameStatus')->middleware('jwtAuth');
Route::post('games/update_game_date','App\Http\Controllers\Api\GamesController@updateGameDate')->middleware('jwtAuth');
Route::post('games/update_game_time','App\Http\Controllers\Api\GamesController@updateGameTime')->middleware('jwtAuth');
Route::post('games/update_game_location','App\Http\Controllers\Api\GamesController@updateGameLocation')->middleware('jwtAuth');
Route::post('games/update_game_info','App\Http\Controllers\Api\GamesController@updateGameInfo')->middleware('jwtAuth');
Route::post('games/update_game_info2','App\Http\Controllers\Api\GamesController@updateGameInfo2')->middleware('jwtAuth');
Route::post('games/delete','App\Http\Controllers\Api\GamesController@delete')->middleware('jwtAuth');
Route::get('games','App\Http\Controllers\Api\GamesController@games')->middleware('jwtAuth');
Route::get('games/game','App\Http\Controllers\Api\GamesController@game')->middleware('jwtAuth');
Route::get('games/league_games','App\Http\Controllers\Api\GamesController@leagueGames')->middleware('jwtAuth');
Route::get('games/team_games','App\Http\Controllers\Api\GamesController@teamGames')->middleware('jwtAuth');
Route::get('games/away_team_games','App\Http\Controllers\Api\GamesController@awayTeamGames')->middleware('jwtAuth');

Route::post('components/create','App\Http\Controllers\Api\ComponentsController@create')->middleware('jwtAuth');
Route::post('components/update','App\Http\Controllers\Api\ComponentsController@update')->middleware('jwtAuth');
Route::post('components/update_component_name','App\Http\Controllers\Api\ComponentsController@updateComponentName')->middleware('jwtAuth');
Route::post('components/update_component_desc','App\Http\Controllers\Api\ComponentsController@updateComponentDesc')->middleware('jwtAuth');
Route::post('components/update_component_type','App\Http\Controllers\Api\ComponentsController@updateComponentType')->middleware('jwtAuth');
Route::post('components/update_component_info','App\Http\Controllers\Api\ComponentsController@updateComponentInfo')->middleware('jwtAuth');
Route::post('components/update_price_per_component','App\Http\Controllers\Api\ComponentsController@updatePricePerComponent')->middleware('jwtAuth');
Route::post('components/update_weight_per_component','App\Http\Controllers\Api\ComponentsController@updateWeightPerComponent')->middleware('jwtAuth');
Route::post('components/delete','App\Http\Controllers\Api\ComponentsController@delete')->middleware('jwtAuth');
Route::get('components','App\Http\Controllers\Api\ComponentsController@components')->middleware('jwtAuth');
Route::get('components/component','App\Http\Controllers\Api\ComponentsController@component')->middleware('jwtAuth');
Route::get('components/my_components','App\Http\Controllers\Api\ComponentsController@myComponents')->middleware('jwtAuth');
Route::get('components/prod_components','App\Http\Controllers\Api\ComponentsController@prodComponents')->middleware('jwtAuth');
Route::get('components/my_business_general_components','App\Http\Controllers\Api\ComponentsController@myBusinessGeneralComponents')->middleware('jwtAuth');

Route::post('notifications/create','App\Http\Controllers\Api\NotificationsController@create')->middleware('jwtAuth');
Route::post('notifications/delete','App\Http\Controllers\Api\NotificationsController@delete')->middleware('jwtAuth');
Route::get('notifications','App\Http\Controllers\Api\NotificationsController@notifications')->middleware('jwtAuth');
//Route::post('notifcations/update','App\Http\Controllers\Api\ComponentsController@update')->middleware('jwtAuth');
//Route::post('components/update_component_name','App\Http\Controllers\Api\ComponentsController@updateComponentName')->middleware('jwtAuth');
//Route::post('components/update_component_desc','App\Http\Controllers\Api\ComponentsController@updateComponentDesc')->middleware('jwtAuth');
//Route::post('components/update_component_type','App\Http\Controllers\Api\ComponentsController@updateComponentType')->middleware('jwtAuth');
//Route::post('components/update_component_info','App\Http\Controllers\Api\ComponentsController@updateComponentInfo')->middleware('jwtAuth');
//Route::post('components/update_price_per_component','App\Http\Controllers\Api\ComponentsController@updatePricePerComponent')->middleware('jwtAuth');
//Route::post('components/update_weight_per_component','App\Http\Controllers\Api\ComponentsController@updateWeightPerComponent')->middleware('jwtAuth');