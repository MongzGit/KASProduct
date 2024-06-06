<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CommentBI;
use Illuminate\Http\Request;
use Auth;
use Exception;

class CommentBIsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $commentBI = new CommentBI;
            $commentBI->user_id = Auth::user()->id;
            $commentBI->post_id = $request->id;
            $commentBI->commentBI = $request->commentBI;
            $commentBI->save();
            $commentBI->user;

            return response()->json([
                'success' => true,
                'comment' => $commentBI,
                'message' => 'comment added'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $commentBI = CommentBI::find($request->id);
            //check if user is editing his own comment
            if ($commentBI->id != Auth::user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorize access'
                ]);
            }
            $commentBI->commentBI = $request->commentBI;
            $commentBI->update();

            return response()->json([
                'success' => true,
                'message' => 'comment edited'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $commentBI = CommentBI::find($request->id);
            //check if user is editing his own comment
            if ($commentBI->user_id != Auth::user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorize access'
                ]);
            }
            $commentBI->delete();

            return response()->json([
                'success' => true,
                'message' => 'comment deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function comments(Request $request)
    {
        try {
            $commentBIs = CommentBI::where('post_id', $request->id)->get();
            //show user of each comment
            foreach ($commentBIs as $commentBI) {
                $commentBI->user;
            }

            return response()->json([
                'success' => true,
                'comments' => $commentBIs
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
