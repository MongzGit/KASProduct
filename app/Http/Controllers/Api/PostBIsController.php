<?php

namespace App\Http\Controllers\Api;

use App\Models\PostBI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;
use Validator;
use File;
use Response;

class PostBIsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $post = new PostBI;
            $post->user_id = Auth::user()->id;
            $post->post_type = $request->post_type;
            $post->prod_business_name = $request->prod_business_name;
            $post->prod_name = $request->prod_name;
            $post->prod_desc = $request->prod_desc;
            $post->prod_price = $request->prod_price;
            $post->prod_status = $request->prod_status;
            $post->prod_location = $request->prod_location;
            $post->consumable_prod_special = $request->consumable_prod_special;
            $post->consumable_prod_item_desc = $request->consumable_prod_item_desc;
            $post->consumable_prod_delivery_infor1 = $request->consumable_prod_delivery_infor1;
            $post->consumable_prod_delivery_infor2 = $request->consumable_prod_delivery_infor2;
            $post->consumable_prod_delivery_std_cost = $request->consumable_prod_delivery_std_cost;
            $post->news_headline = $request->news_headline;
            $post->news_byline = $request->news_byline;
            $post->news_lead_paragraph = $request->news_lead_paragraph;
            $post->news_explanation_paragraph = $request->news_explanation_paragraph;
            $post->news_additional_explanation = $request->news_additional_explanation;
            $post->taxi_main_rank_address = $request->taxi_main_rank_address;
            $post->taxi_main_rank_status = $request->taxi_main_rank_status;
            $post->taxi_standby_taxi = $request->taxi_standby_taxi;
            $post->taxi_standby_taxi_seat_limit = $request->taxi_standby_taxi_seat_limit;
            $post->taxi_standby_taxi_seat_token = $request->taxi_standby_taxi_seat_token;//passenger taken
            $post->taxi_standby_taxi_fee = $request->taxi_standby_taxi_fee;
            $post->taxi_standby_taxi_etd = $request->taxi_standby_taxi_etd;
            $post->taxi_standby_taxi_eta = $request->taxi_standby_taxi_eta;
            $post->taxi_desination_stop_final = $request->taxi_desination_stop_final;
            $post->taxi_desination_stop1 = $request->taxi_desination_stop1;
            $post->event_desc = $request->event_desc;
            $post->event_location = $request->event_location;
            $post->event_date = $request->event_date;
            $post->event_time = $request->event_time;
            $post->event_ticket_price_general = $request->event_ticket_price_general;
            $post->event_ticket_price_general_desc = $request->event_ticket_price_general_desc;
            $post->event_ticket_price_golden = $request->event_ticket_price_golden;
            $post->event_ticket_price_golden_desc = $request->event_ticket_price_golden_desc;
            $post->event_ticket_price_vip = $request->event_ticket_price_vip;
            $post->event_ticket_price_vip_desc = $request->event_ticket_price_vip_desc;
            $post->event_ticket_price_vvip = $request->event_ticket_price_vvip;
            $post->event_ticket_price_vvip_desc = $request->event_ticket_price_vvip_desc;
            $post->event_artist_lineup = $request->event_artist_lineup;
            $post->event_specials = $request->event_specials;
            $post->post_general_infor1 = $request->post_general_infor1;
            $post->post_general_infor2 = $request->post_general_infor2;
            $post->post_general_infor3 = $request->post_general_infor3;
            $post->post_general_infor4 = $request->post_general_infor4;
            $post->post_photo1_width = $request->post_photo1_width;
            $post->post_photo1_height = $request->post_photo1_height;
            $post->post_photo2_width = $request->post_photo2_width;
            $post->post_photo2_height = $request->post_photo2_height;
            $post->relation_counter = $request->relation_counter;

            //check if post has photo
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
                $post->post_photo1 = $imageUrl;

            } else {
                $post->post_photo1 = null;
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
                $post->post_photo2 = $imageUrl;
            } else {
                $post->post_photo2 = null;
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
                'message' => null . $e
            ]);
        }
    }

    public function updatePostType(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->post_type = $request->post_type;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Type',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateProdBusinessName(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->prod_business_name = $request->prod_business_name;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post B Name',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateProdName(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->prod_name = $request->prod_name;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Name',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateProdDesc(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }

            $post->prod_desc = $request->prod_desc;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post desc',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateProdPrice(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->prod_price = $request->prod_price;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post price',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateProdStatus(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->prod_status = $request->prod_status;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Status',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateProdLocation(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->prod_location = $request->prod_location;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Status',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateEventTicketInfor(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }

            $post->event_ticket_price_general = $request->event_ticket_price_general;
            
            $post->event_ticket_price_general_desc = $request->event_ticket_price_general_desc;
            
            $post->event_ticket_price_golden = $request->event_ticket_price_golden;
            
            $post->event_ticket_price_golden_desc = $request->event_ticket_price_golden_desc;
            
            $post->event_ticket_price_vip = $request->event_ticket_price_vip;
            
            $post->event_ticket_price_vip_desc = $request->event_ticket_price_vip_desc;
            
            $post->event_ticket_price_vvip = $request->event_ticket_price_vvip;
            
            $post->event_ticket_price_vvip_desc = $request->event_ticket_price_vvip_desc;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Type',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePostGeneralInfor(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->post_general_infor1 = $request->post_general_infor1;
            $post->post_general_infor2 = $request->post_general_infor2;
            $post->post_general_infor3 = $request->post_general_infor3;
            $post->post_general_infor4 = $request->post_general_infor4;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Type',
                'post' => $post
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
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);

            $post->post_photo1_width = $request->post_photo1_width;
            $post->post_photo1_height = $request->post_photo1_height;
            $post->post_photo2_width = $request->post_photo2_width;
            $post->post_photo2_height = $request->post_photo2_height;

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
                $post->post_photo1 = $imageUrl;

            } else {
                $post->post_photo1 = null;
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
                $post->post_photo2 = $imageUrl;
            } else {
                $post->post_photo2 = null;
            }

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Type',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateConsumableProdItemDesc(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->consumable_prod_item_desc = $request->consumable_prod_item_desc;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Type',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePostGeneralInfor1(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->post_general_infor1 = $request->post_general_infor1;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated News Status',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePostGeneralInfor2(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->post_general_infor2 = $request->post_general_infor2;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated News Status',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePostGeneralInfor3(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->post_general_infor3 = $request->post_general_infor3;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updatePostGeneralInfor4(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->post_general_infor4 = $request->post_general_infor4;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated News Status',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateConsumableProdInfor(Request $request){

        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $post->prod_business_name = $request->prod_business_name;
            $post->prod_name = $request->prod_name;
            $post->prod_desc = $request->prod_desc;
            $post->consumable_prod_special = $request->consumable_prod_special;
            $post->prod_status = $request->prod_status;
            $post->consumable_prod_item_desc = $request->consumable_prod_item_desc;//for internal desection and sorting
            $post->prod_price = $request->prod_price;
            $post->prod_location = $request->prod_location;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated Post Type',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function update(Request $request)//this function logic is not used  for updates you might wanna use a different kind
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

            $post->post_type = $request->post_type;
            $post->prod_business_name = $request->prod_business_name;
            $post->prod_name = $request->prod_name;
            $post->prod_desc = $request->prod_desc;
            $post->prod_price = $request->prod_price;
            $post->prod_status = $request->prod_status;
            $post->prod_location = $request->prod_location;
            $post->consumable_prod_special = $request->consumable_prod_special;
            $post->consumable_prod_item_desc = $request->consumable_prod_item_desc;
            $post->consumable_prod_delivery_infor1 = $request->consumable_prod_delivery_infor1;
            $post->consumable_prod_delivery_infor2 = $request->consumable_prod_delivery_infor2;
            $post->consumable_prod_delivery_std_cost = $request->consumable_prod_delivery_std_cost;
            $post->news_headline = $request->news_headline;
            $post->news_byline = $request->news_byline;
            $post->news_lead_paragraph = $request->news_lead_paragraph;
            $post->news_explanation_paragraph = $request->news_explanation_paragraph;
            $post->news_additional_explanation = $request->news_additional_explanation;
            $post->taxi_main_rank_address = $request->taxi_main_rank_address;
            $post->taxi_main_rank_status = $request->taxi_main_rank_status;
            $post->taxi_standby_taxi = $request->taxi_standby_taxi;
            $post->taxi_standby_taxi_seat_limit = $request->taxi_standby_taxi_seat_limit;
            $post->taxi_standby_taxi_seat_token = $request->taxi_standby_taxi_seat_token;//passenger taken
            $post->taxi_standby_taxi_fee = $request->taxi_standby_taxi_fee;
            $post->taxi_standby_taxi_etd = $request->taxi_standby_taxi_etd;
            $post->taxi_standby_taxi_eta = $request->taxi_standby_taxi_eta;
            $post->taxi_desination_stop_final = $request->taxi_desination_stop_final;
            $post->taxi_desination_stop1 = $request->taxi_desination_stop1;
            $post->event_desc = $request->event_desc;
            $post->event_location = $request->event_location;
            $post->event_date = $request->event_date;
            $post->event_time = $request->event_time;
            $post->event_ticket_price_general = $request->event_ticket_price_general;
            $post->event_ticket_price_general_desc = $request->event_ticket_price_general_desc;
            $post->event_ticket_price_golden = $request->event_ticket_price_golden;
            $post->event_ticket_price_golden_desc = $request->event_ticket_price_golden_desc;
            $post->event_ticket_price_vip = $request->event_ticket_price_vip;
            $post->event_ticket_price_vip_desc = $request->event_ticket_price_vip_desc;
            $post->event_ticket_price_vvip = $request->event_ticket_price_vvip;
            $post->event_ticket_price_vvip_desc = $request->event_ticket_price_vvip_desc;
            $post->event_artist_lineup = $request->event_artist_lineup;
            $post->event_specials = $request->event_specials;
            $post->post_general_infor1 = $request->post_general_infor1;
            $post->post_general_infor2 = $request->post_general_infor2;
            $post->post_general_infor3 = $request->post_general_infor3;
            $post->post_general_infor4 = $request->post_general_infor4;
            $post->post_photo1_width = $request->post_photo1_width;
            $post->post_photo1_height = $request->post_photo1_height;
            $post->post_photo2_width = $request->post_photo2_width;
            $post->post_photo2_height = $request->post_photo2_height;
            $post->relation_counter = $request->relation_counter;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'post edited'
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
            $post = PostBI::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            //check if post has photo1 to delete
            if ($post->post_photo1 != null) {
                Storage::delete('public/posts/' . $post->post_photo1);
            }
            //check if post has photo2 to delete
            if ($post->post_photo2 != null) {
                Storage::delete('public/posts/' . $post->post_photo2);
            }

            $post->delete();
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

    public function postBIs()
    {
        try {
            $posts = PostBI::orderBy('updated_at')->get();
            foreach ($posts as $post) {
                //get user of post
                $post->user;
                //cpmponents vount
                $post['componentsCount'] = $post->components->count();
                //teams count
                $post['teamsCount'] = $post->teams->count();
                //comments count
                $post['commentsCount'] = $post->commentBIs->count();
                //likes count
                $post['likesCount'] = $post->likeBIs->count();
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
                'message' => null . $e
            ]);
        }
    }

    public function post(Request $request)
    {
        try {
            $post = PostBI::find($request->id);
            //cpmponents vount
            $post['componentsCount'] = count($post->components);
            //teams count
            $post['teamsCount'] = count($post->teams);
                //comments count
                $post['commentsCount'] = count($post->commentBIs);
                //likes count
                $post['likesCount'] = count($post->likeBIs);
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function myPosts()
    {
        try {
            $posts = PostBI::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            
            foreach ($posts as $post) {
                //get user of post
                $post->user;
                //cpmponents count
                $post['componentsCount'] = $post->components->count();
                //teams count
                $post['teamsCount'] = $post->teams->count();
                //comments count
                $post['commentsCount'] = $post->commentBIs->count();
                //likes count
                $post['likesCount'] = $post->likeBIs->count();
                //check if users liked his own post
                $post['selfLike'] = false;
                foreach ($post->likeBIs as $like) {
                    if ($like->user_id == Auth::user()->id) {
                        $post['selfLike'] = true;
                    }
                }

            }

            $user = Auth::user();
            return response()->json([
                'success' => true,
                'posts' => $posts,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    
    public function updateRelationCounter(Request $request)
    {
        try{
            $post = PostBI::find($request->id);
            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            
            $post->relation_counter = $request->relation_counter;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated relation counter',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateDeliveryStdCostInfor(Request $request)
    {
        try{
            $post = PostBI::find($request->id);

            if ($post == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            if (Auth::user()->id != $post->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            
            
            $post->consumable_prod_delivery_infor1 = $request->consumable_prod_delivery_infor1;
            $post->consumable_prod_delivery_infor2 = $request->consumable_prod_delivery_infor2;
            $post->consumable_prod_delivery_std_cost = $request->consumable_prod_delivery_std_cost;

            $post->update();

            return response()->json([
                'success' => true,
                'message' => 'updated relation counter',
                'post' => $post
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

}
