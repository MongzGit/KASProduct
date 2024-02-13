<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Exception;

class CommentsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $comment = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->id;
            $comment->comment = $request->comment;
            $comment->save();
            $comment->user;

            return response()->json([
                'success' => true,
                'comment' => $comment,
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
            $comment = Comment::find($request->id);
            //check if user is editing his own comment
            if ($comment->id != Auth::user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorize access'
                ]);
            }
            $comment->comment = $request->comment;
            $comment->update();

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
            $comment = Comment::find($request->id);
            //check if user is editing his own comment
            if ($comment->user_id != Auth::user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorize access'
                ]);
            }
            $comment->delete();

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
            $comments = Comment::where('post_id', $request->id)->get();
            //show user of each comment
            foreach ($comments as $comment) {
                $comment->user;
            }

            return response()->json([
                'success' => true,
                'comments' => $comments
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}