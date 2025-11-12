<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use Validator;
use Auth;
use Exception;
use Storage;

class TeamsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $team = new Team;
            $team->user_id = Auth::user()->id;
            $team->post_b_i_id = $request->post_b_i_id;
            $team->team_name = $request->team_name;
            $team->team_aka_name = $request->team_aka_name;
            $team->team_desc = $request->team_desc;
            $team->team_info = $request->team_info;
            $team->team_info2 = $request->team_info2;
            $team->matches_played = $request->matches_played;
            $team->matches_won = $request->matches_won;
            $team->matches_drawn = $request->matches_drawn;
            $team->matches_lost = $request->matches_lost;
            $team->points = $request->points;
            $team->goals = $request->goals;
            $team->current_news = $request->current_news;
            $team->post_photo1_width = $request->post_photo1_width;
            $team->post_photo1_height = $request->post_photo1_height;
            $team->post_photo2_width = $request->post_photo2_width;
            $team->post_photo2_height = $request->post_photo2_height;

            if ($request->file('post_photo1') != null) {
                if ($validator1->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator1->messages()
                    ]);
                }
                $file = $request->file('post_photo1')->store('images', 'public');
                $imageFilename = $file; // Replace with your actual image filename
                $imageUrl = asset('storage/' . $imageFilename);
                $team->post_photo1 = $imageUrl;

            } else {
                $team->post_photo1 = null;
            }

            if ($request->file('post_photo2') != null) {
                if ($validator2->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator2->messages()
                    ]);
                }
                $file = $request->file('post_photo2')->store('images', 'public');
                $imageFilename = $file; // Replace with your actual image filename
                $imageUrl = asset('storage/' . $imageFilename);
                $team->post_photo2 = $imageUrl;

            } else {
                $team->post_photo2 = null;
            }

            $team->save();
            $team->user;

            return response()->json([
                'success' => true,
                'team' => $team,
                'message' => 'team created'
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
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->matches_played = $request->matches_played;
            $team->matches_won = $request->matches_won;
            $team->matches_drawn = $request->matches_drawn;
            $team->matches_lost = $request->matches_lost;
            $team->points = $request->points;
            $team->goals = $request->goals;
            $team->current_news = $request->current_news;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateTeamName(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->team_name = $request->team_name;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateTeamAkaName(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->team_aka_name = $request->team_aka_name;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateTeamDesc(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->team_desc = $request->team_desc;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateTeamInfo(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->team_info = $request->team_info;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateTeamInfo2(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->team_info2 = $request->team_info2;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateMatchesPlayed(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->matches_played = $request->matches_played;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateMatchesWon(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->matches_won = $request->matches_won;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateMatchesDrawn(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->matches_drawn = $request->matches_drawn;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateMatchesLost(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->matches_lost = $request->matches_lost;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updatePoints(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->points = $request->points;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateGoals(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->goals = $request->goals;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateCurrentNews(Request $request){

        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $team->current_news = $request->current_news;

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'team' => $team
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updatePostPhoto(Request $request){
        try{
            $team = Team::find($request->id);
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);

            $team->post_photo1_width = $request->post_photo1_width;
            $team->post_photo1_height = $request->post_photo1_height;
            $team->post_photo2_width = $request->post_photo2_width;
            $team->post_photo2_height = $request->post_photo2_height;

            if ($request->file('post_photo1') != null) {
                if ($validator1->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator1->messages()
                    ]);
                }
                $file = $request->file('post_photo1')->store('images', 'public');
                $imageFilename = $file; // Replace with your actual image filename
                $imageUrl = asset('storage/' . $imageFilename);
                $team->post_photo1 = $imageUrl;

            } else {
                $team->post_photo1 = null;
            }

            if ($request->file('post_photo2') != null) {
                if ($validator2->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator2->messages()
                    ]);
                }
                $file = $request->file('post_photo2')->store('images', 'public');
                $imageFilename = $file; // Replace with your actual image filename
                $imageUrl = asset('storage/' . $imageFilename);
                $team->post_photo2 = $imageUrl;
            } else {
                $team->post_photo2 = null;
            }

            $team->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Photo',
                'team' => $team
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
            $team = Team::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $team->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            //check if post has photo to delete
            if ($team->post_photo1 != null) {
                Storage::delete('public/posts/' . $team->post_photo1);
            }
            if ($team->post_photo2 != null) {
                Storage::delete('public/posts/' . $team->post_photo2);
            }

            $team->delete();
            return response()->json([
                'success' => true,
                'message' => 'team deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function teams()
    {
        try {
            $teams = Team::orderBy('id')->get();
            foreach ($teams as $team) {
                //get user of post
                $team->user;

                $team['playersCount'] = $team->players->count();

                $team['gamesCount'] = $team->games->count();
            }
            return response()->json([
                'success' => true,
                'teams' => $teams
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function team(Request $request)
    {
        try {
            $team = Team::find($request->id);

            $team['playersCount'] = count($team->players);

            $team['gamesCount'] = count($team->games);

            return response()->json([
                'success' => true,
                'team' => $team
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function myTeams()
    {
        try {
            $teams = Team::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'teams' => $teams,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function leagueTeams(Request $request)
    {
        try {
            $teams = Team::where('post_b_i_id', $request->id)->orderBy('id', 'desc')->get();;
            foreach ($teams as $team) {
                //get user of post
                $team->user;

                $team['playersCount'] = $team->players->count();

                $team['gamesCount'] = $team->games->count();
            }

            return response()->json([
                'success' => true,
                'teams' => $teams
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
}