<?php

namespace App\Http\Controllers\Api;

use App\Models\Likes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Exception;

class LikesController extends Controller
{
    public function like(Request $request)
    {
        try {
            $like = Likes::where('post_id', $request->id)->where('user_id', Auth::user()->id)->get();
            //check if it returns 0 then this post is not liked and else unliked
            if (count($like) > 0) {
                //bcz we cant have likes more than one
                $like[0]->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'unliked'
                ]);
            }
            $like = new Likes;
            $like->user_id = Auth::user()->id;
            $like->post_id = $request->id;
            $like->save();

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
