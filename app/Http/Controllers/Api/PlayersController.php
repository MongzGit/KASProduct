<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Player;
use Validator;
use Auth;
use Exception;
use Storage;


class PlayersController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $player = new Player;
            $player->user_id = Auth::user()->id;
            $player->team_id = $request->team_id;
            $player->name = $request->name;
            $player->lastname = $request->lastname;
            $player->age = $request->age;
            $player->height = $request->height;
            $player->weight = $request->weight;
            $player->address = $request->address;
            $player->position = $request->position;
            $player->jersey_number = $request->jersey_number;
            $player->goals = $request->goals;
            $player->assists = $request->assists;
            $player->matches_played = $request->matches_played;
            $player->player_info = $request->player_info;
            $player->player_info2 = $request->player_info2;
            $player->post_photo1_width = $request->post_photo1_width;
            $player->post_photo1_height = $request->post_photo1_height;
            $player->post_photo2_width = $request->post_photo2_width;
            $player->post_photo2_height = $request->post_photo2_height;

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
                $player->post_photo1 = $imageUrl;

            } else {
                $player->post_photo1 = null;
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
                $player->post_photo2 = $imageUrl;

            } else {
                $player->post_photo2 = null;
            }

            $player->save();
            $player->user;

            return response()->json([
                'success' => true,
                'player' => $player,
                'message' => 'player created'
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
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->name = $request->name;
            $player->lastname = $request->lastname;
            $player->age = $request->age;
            $player->height = $request->height;
            $player->weight = $request->weight;
            $player->address = $request->address;
            $player->position = $request->position;
            $player->jersey_number = $request->jersey_number;
            $player->running_speed = $request->running_speed;
            $player->goals = $request->goals;
            $player->assists = $request->assists;
            $player->matches_played = $request->matches_played;
            $player->player_info = $request->player_info;
            $player->player_info2 = $request->player_info2;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updatePlayerName(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->name = $request->name;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePlayerLastName(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->lastname = $request->lastname;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePlayerAge(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->age = $request->age;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePlayerHeight(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            
            $player->height = $request->height;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePlayerWeight(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->weight = $request->weight;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
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
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->matches_played = $request->matches_played;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updatePlayerAddress(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->address = $request->address;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updatePlayerPosition(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->position = $request->position;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateJerseyNumber(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->jersey_number = $request->jersey_number;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateRunningSpeed(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->points = $request->points;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
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
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->goals = $request->goals;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateAssists(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->assists = $request->assists;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePlayerInfo(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->player_info = $request->player_info;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePlayerInfo2(Request $request){

        try{
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $player->player_info2 = $request->player_info2;

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $player
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
            $player = Player::find($request->id);
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);

            $player->post_photo1_width = $request->post_photo1_width;
            $player->post_photo1_height = $request->post_photo1_height;
            $player->post_photo2_width = $request->post_photo2_width;
            $player->post_photo2_height = $request->post_photo2_height;

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
                $player->post_photo1 = $imageUrl;

            } else {
                $player->post_photo1 = null;
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
                $player->post_photo2 = $imageUrl;
            } else {
                $player->post_photo2 = null;
            }

            $player->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Type',
                'player' => $player
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
            $player = Player::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $player->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            //check if post has photo to delete
            if ($player->post_photo1 != null) {
                Storage::delete('public/posts/' . $player->post_photo1);
            }
            if ($player->post_photo2 != null) {
                Storage::delete('public/posts/' . $player->post_photo2);
            }

            $player->delete();
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

    public function players()
    {
        try {
            $players = Player::orderBy('id', 'desc')->get();
            foreach ($players as $player) {
                //get user of post
                $player->user;

            }
            return response()->json([
                'success' => true,
                'players' => $players
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function player(Request $request)
    {
        try {
            $player = Player::find($request->id);

            return response()->json([
                'success' => true,
                'player' => $player
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    
}
