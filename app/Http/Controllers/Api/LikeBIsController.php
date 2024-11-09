<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LikeBI;
use Illuminate\Http\Request;
use Auth;
use Exception;

class LikeBIsController extends Controller
{
    public function like(Request $request)
    {
        try {
            $likeBI = LikeBI::where('post_b_i_id', $request->id)->where('user_id', Auth::user()->id)->get();
            //check if it returns 0 then this post is not liked and else unliked
            if (count($likeBI) > 0) {
                //bcz we cant have likes more than one
                $likeBI[0]->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'unliked'
                ]);
            }
            $likeBI = new LikeBI;
            $likeBI->user_id = Auth::user()->id;
            $likeBI->post_b_i_id = $request->id;
            $likeBI->save();

            return response()->json([
                'success' => true,
                'message' => 'liked'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
