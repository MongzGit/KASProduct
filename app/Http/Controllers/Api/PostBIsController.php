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
                file_put_contents('storage/app/public/images/' . $news_photo2, base64_decode($request->news_photo2));
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
    }//
}
