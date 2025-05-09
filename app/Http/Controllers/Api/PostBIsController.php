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
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:2048',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:2048',]);
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
            $validator1 = Validator::make($request->all(), ['post_photo1' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:2048',]);
            $validator2 = Validator::make($request->all(), ['post_photo2' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:2048',]);

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
            $post->consumable_prod_status = $request->consumable_prod_status;
            //$post->consumable_prod_item_desc = $request->consumable_prod_item_desc;//for internal desection and sorting
            $post->consumable_prod_price = $request->consumable_prod_price;
            $post->consumable_prod_location = $request->consumable_prod_location;

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

            if ($request->post_type != null) {
                $post->post_type = $request->post_type;
            } else {
                $post->post_type = null;
            }

            if ($request->consumable_business_name != null) {
                $post->consumable_business_name = $request->consumable_business_name;
            } else {
                $post->consumable_business_name = null;
            }

            // if ($request->consumable_prod_name != null) {
            //     $post->consumable_prod_name = $request->consumable_prod_name;
            // } else {
            //     $post->consumable_prod_name = null;
            // }

            // if ($request->consumable_prod_desc != null) {
            //     $post->consumable_prod_desc = $request->consumable_prod_desc;
            // } else {
            //     $post->consumable_prod_desc = null;
            // }

            // if ($request->consumable_prod_special != null) {
            //     $post->consumable_prod_special = $request->consumable_prod_special;
            // } else {
            //     $post->consumable_prod_special = null;
            // }

            // if ($$request->consumable_prod_status != null) {
            //     $post->consumable_prod_status = $request->consumable_prod_status;
            // } else {
            //     $post->consumable_prod_status = null;
            // }

            // if ($request->consumable_prod_item_desc != null) {
            //     $post->consumable_prod_item_desc = $request->consumable_prod_item_desc;
            // } else {
            //     $post->consumable_prod_item_desc = null;
            // }

            // if ($request->consumable_prod_price != null) {
            //     $post->consumable_prod_price = $request->consumable_prod_price;
            // } else {
            //     $post->consumable_prod_price = null;
            // }

            // if ($request->consumable_prod_location != null) {
            //     $post->consumable_prod_location = $request->consumable_prod_location;
            // } else {
            //     $post->consumable_prod_location = null;
            // }

            // if ($request->news_paper_name != null) {
            //     $post->news_paper_name = $request->news_paper_name;
            // } else {
            //     $post->news_paper_name = null;
            // }

            // if ($request->news_title != null) {
            //     $post->news_title = $request->news_title;
            // } else {
            //     $post->news_title = null;
            // }

            // if ($request->news_headline != null) {
            //     $post->news_headline = $request->news_headline;
            // } else {
            //     $post->news_headline = null;
            // }

            // if ($request->news_byline != null) {
            //     $post->news_byline = $request->news_byline;
            // } else {
            //     $post->news_byline = null;
            // }

            // if ($request->news_lead_paragraph != null) {
            //     $post->news_lead_paragraph = $request->news_lead_paragraph;
            // } else {
            //     $post->news_lead_paragraph = null;
            // }

            // if ($request->news_explanation_paragraph != null) {
            //     $post->news_explanation_paragraph = $request->news_explanation_paragraph;
            // } else {
            //     $post->news_explanation_paragraph = null;
            // }

            // if ($request->news_additional_explanation != null) {
            //     $post->news_additional_explanation = $request->news_additional_explanation;
            // } else {
            //     $post->news_additional_explanation = null;
            // }

            // if ($request->news_special != null) {
            //     $post->news_special = $request->news_special;
            // } else {
            //     $post->news_special = null;
            // }

            // if ($request->news_status != null) {
            //     $post->news_status = $request->news_status;
            // } else {
            //     $post->news_status = null;
            // }

            // if ($request->taxi_buisness_name != null) {
            //     $post->taxi_buisness_name = $request->taxi_buisness_name;
            // } else {
            //     $post->taxi_buisness_name = null;
            // }

            // if ($request->taxi_main_rank_name != null) {
            //     $post->taxi_main_rank_name = $request->taxi_main_rank_name;
            // } else {
            //     $post->taxi_main_rank_name = null;
            // }

            // if ($request->taxi_main_rank_address != null) {
            //     $post->taxi_main_rank_address = $request->taxi_main_rank_address;
            // } else {
            //     $post->taxi_main_rank_address = null;
            // }

            // if ($request->taxi_main_rank_status != null) {
            //     $post->taxi_main_rank_status = $request->taxi_main_rank_status;
            // } else {
            //     $post->taxi_main_rank_status = null;
            // }

            // if ($request->taxi_standby_taxi != null) {
            //     $post->taxi_standby_taxi = $request->taxi_standby_taxi;
            // } else {
            //     $post->taxi_standby_taxi = null;
            // }

            // if ($request->taxi_standby_taxi_seat_limit != null) {
            //     $post->taxi_standby_taxi_seat_limit = $request->taxi_standby_taxi_seat_limit;
            // } else {
            //     $post->taxi_standby_taxi_seat_limit = null;
            // }

            // if ($request->taxi_standby_taxi_seat_taken != null) {
            //     $post->taxi_standby_taxi_seat_taken = $request->taxi_standby_taxi_seat_taken;//passenger taken
            // } else {
            //     $post->taxi_standby_taxi_seat_taken = null;
            // }

            // if ($request->taxi_standby_taxi_fee != null) {
            //     $post->taxi_standby_taxi_fee = $request->taxi_standby_taxi_fee;
            // } else {
            //     $post->taxi_standby_taxi_fee = null;
            // }

            // if ($request->taxi_standby_taxi_etd != null) {
            //     $post->taxi_standby_taxi_etd = $request->taxi_standby_taxi_etd;
            // } else {
            //     $post->taxi_standby_taxi_etd = null;
            // }


            // if($request->taxi_standby_taxi_etd != null){
            // $post->taxi_standby_taxi_etd = $request->taxi_standby_taxi_etd;
            // }else{
            //     $post->taxi_standby_taxi_etd = null;
            // }

            // if($request->taxi_standby_taxi_eta != null){
            // $post->taxi_standby_taxi_eta = $request->taxi_standby_taxi_eta;
            // }else{
            //     $post->taxi_standby_taxi_eta = null;
            // }

            // if($request->taxi_desination_stop_final != null){
            // $post->taxi_desination_stop_final = $request->taxi_desination_stop_final;
            // }else{
            //     $post->taxi_desination_stop_final = null;
            // }

            // if($request->taxi_desination_stop1 != null){
            // $post->taxi_desination_stop1 = $request->taxi_desination_stop1;
            // }else{
            //     $post->taxi_desination_stop1 = null;
            // }

            // if($request->taxi_desination_stop2 != null){
            // $post->taxi_desination_stop2 = $request->taxi_desination_stop2;
            // }else{
            //     $post->taxi_desination_stop2 = null;
            // }

            // if($request->taxi_desination_stop3 != null){
            // $post->taxi_desination_stop3 = $request->taxi_desination_stop3;
            // }else{
            //     $post->taxi_desination_stop3 = null;
            // }

            // if($request->taxi_desination_stop4 != null){
            // $post->taxi_desination_stop4 = $request->taxi_desination_stop4;
            // }else{
            //     $post->taxi_desination_stop4 = null;
            // }

            // if($request->taxi_desination_stop5 != null){
            // $post->taxi_desination_stop5 = $request->taxi_desination_stop5;
            // }else{
            //     $post->taxi_desination_stop5 = null;
            // }
            
            // if($request->taxi_desination_stop6 != null){
            // $post->taxi_desination_stop6 = $request->taxi_desination_stop6;
            // }else{
            //     $post->taxi_desination_stop6 = null;
            // }

            // if($request->taxi_desination_stop7 != null){
            // $post->taxi_desination_stop7 = $request->taxi_desination_stop7;
            // }else{
            //     $post->taxi_desination_stop7 = null;
            // }

            // if($request->taxi_desination_stop8 != null){
            // $post->taxi_desination_stop8 = $request->taxi_desination_stop8;
            // }else{
            //     $post->taxi_desination_stop8 = null;
            // }

            // if($request->taxi_desination_stop9 != null){
            // $post->taxi_desination_stop9 = $request->taxi_desination_stop9;
            // }else{
            //     $post->taxi_desination_stop9 = null;
            // }

            // if($request->taxi_desination_stop10 != null){           
            // $post->taxi_desination_stop10 = $request->taxi_desination_stop10;
            // }else{
            //     $post->taxi_desination_stop10 = null;
            // }

            // if($request->taxi_desination_stop11 != null){
            // $post->taxi_desination_stop11 = $request->taxi_desination_stop11;
            // }else{
            //     $post->taxi_desination_stop11 = null;
            // }

            // if($post->taxi_desination_stop12 = null){
            // $post->taxi_desination_stop12 = $request->taxi_desination_stop12;
            // }else{
            //     $post->taxi_desination_stop12 = null;
            // }

            // if($request->event_business_name != null){
            // $post->event_business_name = $request->event_business_name;
            // }else{
            //     $post->event_business_name = null;
            // }

            // if($request->event_name != null){
            // $post->event_name = $request->event_name;
            // }else{
            //     $post->event_name = null;
            // }

            // if($request->event_title != null){
            // $post->event_title = $request->event_title;
            // }else{
            //     $post->event_title = null; 
            // }

            // if($request->event_desc != null){
            // $post->event_desc = $request->event_desc;
            // }else{
            //     $post->event_desc = null;
            // }

            // if($request->event_location != null){
            // $post->event_location = $request->event_location;
            // }else{
            //     $post->event_location = null;
            // }

            // if($request->event_date != null){
            // $post->event_date = $request->event_date;
            // }else{
            //     $post->event_date = null;
            // }

            // if($request->event_time != null){
            // $post->event_time = $request->event_time;
            // }else{
            //     $post->event_time = null;
            // }

            // if($request->event_ticket_price != null){
            // $post->event_ticket_price = $request->event_ticket_price;
            // }else{
            //     $post->event_ticket_price = null;
            // }

            // if($request->event_artist_lineup != null){
            // $post->event_artist_lineup = $request->event_artist_lineup;
            // }else{
            //     $post->event_artist_lineup = null;
            // }

            // if($request->event_specials != null){
            // $post->event_specials = $request->event_specials;
            // }else{
            //     $post->event_specials = null;
            // }
            // $post->post_general_infor1 = $request->post_general_infor1;
            // $post->post_general_infor2 = $request->post_general_infor2;
            // $post->post_general_infor3 = $request->post_general_infor3;
            // $post->post_photo1_width = $request->post_photo1_width;
            // $post->post_photo1_height = $request->post_photo1_height;
            // $post->post_photo2_width = $request->post_photo2_width;
            // $post->post_photo2_height = $request->post_photo2_height;
            // $post->advert_business_name = $request->advert_business_name;
            // $post->advert_name = $request->advert_name;
            // $post->advert_title = $request->advert_title;
            // $post->advert_desc = $request->advert_desc;
            // $post->advert_photo_logo = $request->advert_photo_logo;
            // $post->advert_photo_logo_width = $request->advert_photo_logo_width;
            // $post->advert_photo_logo_height = $request->advert_photo_logo_height;
            // $post->advert_photo1 = $request->advert_photo1;
            // $post->advert_photo1_width = $request->advert_photo1_width;
            // $post->advert_photo1_height = $request->advert_photo1_height;


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
            $posts = PostBI::orderBy('id', 'desc')->get();
            foreach ($posts as $post) {
                //get user of post
                $post->user;
                //cpmponents vount
                $post['componentsCount'] = count($post->components);
                //teams count
                $post['teamsCount'] = count($post->teams);
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
                $post['componentsCount'] = count($post->components);
                //teams count
                $post['teamsCount'] = count($post->teams);
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
