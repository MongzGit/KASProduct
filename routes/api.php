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


//for comment orders
Route::post('comment_orders/create','App\Http\Controllers\Api\CommentOrdersController@create')->middleware('jwtAuth');
Route::post('comment_orders/delete','App\Http\Controllers\Api\CommentOrdersController@delete')->middleware('jwtAuth');
Route::post('comment_orders/update','App\Http\Controllers\Api\CommentOrdersController@update')->middleware('jwtAuth');
Route::post('orders/comment_orders','App\Http\Controllers\Api\CommentOrdersController@commentOrders')->middleware('jwtAuth');

//for registeredlocations
Route::post('registeredlocations/create','App\Http\Controllers\Api\RegisteredlocationsController@create')->middleware('jwtAuth');
Route::post('registeredlocations/delete','App\Http\Controllers\Api\RegisteredlocationsController@delete')->middleware('jwtAuth');
Route::get('registeredlocationslist','App\Http\Controllers\Api\RegisteredlocationsController@registeredlocationslist');

//
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

