<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $post = new Post;
            $post->user_id = Auth::user()->id;
            $post->desc = $request->desc;
            $post->name = $request->name;
            $post->type = $request->type;
            $post->price = $request->price;
            $post->location = $request->location;

            //check if post has photo
            if ($request->photo != '') {
                //choose a unique name for photo
                $photo = time() . '.jpg';
                file_put_contents('storage/posts/' . $photo, base64_decode($request->photo));
                $post->photo = $photo;
            }
            //mistake
            $post->save();
            $post->user;
            return response()->json([
                'success' => true,
                'message' => 'posted',
                'post' => $post
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
            $post = Post::find($request->id);
            // check if user is editing his own post
            // we need to check user id with post user id
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->desc = $request->desc;
            $post->name = $request->name;
            $post->type = $request->type;
            $post->price = $request->price;
            $post->location = $request->location;
            $post->update();
            return response()->json([
                'success' => true,
                'message' => 'post edited'
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
            $post = Post::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }

            //check if post has photo to delete
            if ($post->photo != '') {
                Storage::delete('public/posts/' . $post->photo);
            }
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'post deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function posts()
    {
        try {
            $posts = Post::orderBy('id', 'desc')->get();
            foreach ($posts as $post) {
                //get user of post
                $post->user;
                //comments count
                $post['commentsCount'] = count($post->comments);
                //likes count
                $post['likesCount'] = count($post->likes);
                //check if users liked his own post
                $post['selfLike'] = false;
                foreach ($post->likes as $like) {
                    if ($like->user_id == Auth::user()->id) {
                        $post['selfLike'] = true;
                    }
                }

            }

            return response()->json([
                'success' => true,
                'posts' => $posts
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }



    public function myPosts()
    {
        try {
            $posts = Post::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'posts' => $posts,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
