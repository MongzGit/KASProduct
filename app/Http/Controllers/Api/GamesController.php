<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use Validator;
use Auth;
use Exception;
use Storage;


class GamesController extends Controller
{
    public function create(Request $request)
    {
        try {
            $game = new Game;
            $game->user_id = Auth::user()->id;
            $game->team_id = $request->team_id;
            $game->post_b_i_id = $request->post_b_i_id;
            $game->away_team_id = $request->away_team_id;
            $game->home_team_name = $request->home_team_name;
            $game->away_team_name = $request->away_team_name;
            $game->home_team_score = $request->home_team_score;
            $game->away_team_score = $request->away_team_score;
            $game->game_results = $request->game_results;
            $game->game_status = $request->game_status;
            $game->game_date = $request->game_date;
            $game->game_time = $request->game_time;
            $game->game_location = $request->game_location;
            $game->game_info = $request->game_info;
            $game->game_info2 = $request->game_info2;

            $game->save();
            $game->user;

            return response()->json([
                'success' => true,
                'Game' => $game,
                'message' => 'Game created'
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function update(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->away_team_id = $request->away_team_id;
            $game->team_id = $request->team_id;
            $game->home_team_name = $request->home_team_name;
            $game->away_team_name = $request->away_team_name;
            $game->home_team_score = $request->home_team_score;
            $game->away_team_score = $request->away_team_score;
            $game->game_results = $request->game_results;
            $game->game_status = $request->game_status;
            $game->game_date = $request->game_date;
            $game->game_time = $request->game_time;
            $game->game_location = $request->game_location;
            $game->game_info = $request->game_info;
            $game->game_info2 = $request->game_info2;
    

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateHomeTeamId(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->team_id = $request->team_id;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateTeamPostBIID(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->post_b_i_id = $request->post_b_i_id;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateAwayTeamId(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->away_team_id = $request->away_team_id;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }


    public function updateHomeTeamName(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->home_team_name = $request->home_team_name;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateAwayTeamName(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            
            $game->away_team_name = $request->away_team_name;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateGameScore(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->home_team_score = $request->home_team_score;
             $game->away_team_score = $request->away_team_score;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateHomeTeamScore(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->home_team_score = $request->home_team_score;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }


    public function updateAwayTeamScore(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->away_team_score = $request->away_team_score;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateGameResults(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->game_results = $request->game_results;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateGameStatus(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->game_status = $request->game_status;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateGameDate(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->game_date = $request->game_date;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateGameTime(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->game_time = $request->game_time;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateGameLocation(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->game_location = $request->game_location;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateGameInfo(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->game_info = $request->game_info;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateGameInfo2(Request $request){

        try{
            $game = Game::find($request->id);
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $game->game_info2 = $request->game_info2;

            $game->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'game' => $game
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $game = Game::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $game->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            //check if post has photo to delete
            

            $game->delete();
            return response()->json([
                'success' => true,
                'message' => 'post deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function games()
    {
        try {
            $games = Game::orderBy('id')->get();
            foreach ($games as $game) {
                //get user of post
                $game->user;

            }
            return response()->json([
                'success' => true,
                'Games' => $games
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function game(Request $request)
    {
        try {
            $game = Game::find($request->id);

            return response()->json([
                'success' => true,
                'Game' => $game
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function leagueGames(Request $request)
    {
        try {
            $game = Game::where('post_b_i_id', $request->id)->orderBy('id')->get();;

            return response()->json([
                'success' => true,
                'Game' => $game
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    
    
    public function teamGames(Request $request)
    {
        try {
            $game = Game::where('team_id', $request->id)->orderBy('id')->get();;

            return response()->json([
                'success' => true,
                'Game' => $game
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function awayTeamGames(Request $request)
    {
        try {
            $game = Game::where('away_team_id', $request->id)->orderBy('id')->get();;

            return response()->json([
                'success' => true,
                'Game' => $game
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function userGames(Request $request)
    {
        try {
            $game = Game::where('user_id', $request->id)->orderBy('post_b_i_id')->get();;

            return response()->json([
                'success' => true,
                'Game' => $game
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
}
