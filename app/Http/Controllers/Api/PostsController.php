<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;

class PostsController extends Controller{
    public function create(Request $request) {
        try {
            $post = new Post;
            $post->user_id = Auth::user()->id;
            $post->consumable_prod_desc = $request->consumable_prod_desc;
            $post->consumable_prod_name = $request->consumable_prod_name;
            $post->business_type = $request->business_type;
            $post->consumable_prod_price = $request->consumable_prod_price;
            $post->consumable_prod_location = $request->consumable_prod_location;
            $post->news_paper_name = $request->news_paper_name;
            $post->news_title = $request->news_title;
            $post->news_headline = $request->news_headline;
            $post->news_byline = $request->news_byline;
            $post->news_lead_paragraph = $request->news_lead_paragraph;
            $post->news_explanation_paragraph = $request->news_explanation_paragraph;
            $post->news_additional_explanation = $request->news_additional_explanation;

            //check if post has photo
            if ($request->consumable_prod_photo != '') {
                //choose a unique name for photo
                $consumable_prod_photo = time() . '.jpeg';
                file_put_contents('storage/app/public/images/' . $consumable_prod_photo, base64_decode($request->consumable_prod_photo));
                $post->consumable_prod_photo = $consumable_prod_photo;
            }

            if ($request->news_photo1 != '') {
                //choose a unique name for photo
                $news_photo1 = time() . '.jpeg';
                file_put_contents('storage/app/public/images/posts/' . $news_photo1, base64_decode($request->news_photo1));
                $post->news_photo1 = $news_photo1;
            }

            if ($request->news_photo2 != '') {
                //choose a unique name for photo
                $news_photo2 = time() . '.jpg';
                file_put_contents('storage/app/public/images/posts/' . $news_photo2, base64_decode($request->news_photo2));
                $post->news_photo2 = $news_photo2;
            }

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
            $post->consumable_prod_desc = $request->consumable_prod_desc;
            $post->consumable_prod_name = $request->consumable_prod_name;
            $post->business_type = $request->business_type;
            $post->consumable_prod_price = $request->consumable_prod_price;
            $post->consumable_prod_location = $request->consumable_prod_location;

            $post->news_paper_name = $request->news_paper_name;
            $post->news_title = $request->news_title;
            $post->news_headline = $request->news_headline;
            $post->news_byline = $request->news_byline;
            $post->news_lead_paragraph = $request->news_lead_paragraph;
            $post->news_explanation_paragraph = $request->news_explanation_paragraph;
            $post->news_additional_explanation = $request->news_additional_explanation;

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

    public function post(Request $request)
    {
        try {
            $post = Post::find($request->id);
            return response()->json([
                'success' => true,
                'post' => $post
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
