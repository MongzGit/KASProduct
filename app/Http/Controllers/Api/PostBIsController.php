<?php

namespace App\Http\Controllers\Api;

use App\Models\PostBI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;
use Validator;

class PostBIsController extends Controller
{ 
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), ['consumable_prod_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:2048',]);
            $post = new PostBI;
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
            if ($request->file('consumable_prod_photo') != null) {
                if ($validator->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator->messages()
                    ]);
                }
                $post->consumable_prod_photo = $request->file('consumable_prod_photo')->store('images', 'public');
            }else{
                $post->consumable_prod_photo = '';
            }      

            if ($request->file('news_photo1') != null) {
                if ($validator->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator->messages()
                    ]);
                }
                $post->news_photo1 = $request->file('news_photo1')->store('images', 'public');
            }else{
            $post->news_photo1 = '';
            }

            if ($request->file('news_photo2') != null) {
                if ($validator->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator->messages()
                    ]);
                }
                $post->news_photo2 = $request->file('news_photo2')->store('images', 'public');
            }else{
                $post->news_photo2 = '';
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
            $post = PostBI::find($request->id);
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
            $post = PostBI::find($request->id);
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

    public function postBIs()
    {
        try {
            $posts = PostBI::orderBy('id', 'desc')->get();
            foreach ($posts as $post) {
                //get user of post
                $post->user;
                //comments count
                $post['commentsCount'] = count($post->commentBIs);
                //likes count
                $post['likesCount'] = count($post->likeBIs);
                //check if users liked his own post
                $post['selfLike'] = false;
                foreach ($post->likeBIs as $like) {
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
            $post = PostBI::find($request->id);
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
            $posts = PostBI::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
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
