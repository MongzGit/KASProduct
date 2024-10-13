<?php

namespace App\Http\Controllers\Api;

use App\Models\CommentOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Exception;

class CommentOrdersController extends Controller
{
    public function create(Request $request)
    {
        try {
            $commentOrder = new CommentOrder;
            $commentOrder->user_id = Auth::user()->id;
            $commentOrder->order_id = $request->order_id; //order id that the commentOrder product belongs
            $commentOrder->post_id = $request->post_id; //post/product id actually ordered
            $commentOrder->post_user_id = $request->post_user_id; // the business that the refered product/post belongs to
            $commentOrder->comment_infor1 = $request->comment_infor1; //additional product comments
            $commentOrder->comment_infor2 = $request->comment_infor2; //additional product comments
            
            $commentOrder->commentOrder_post_post_type = $request->commentOrder_post_post_type;
            $commentOrder->commentOrder_post_consumable_business_name = $request->commentOrder_post_consumable_business_name;
            $commentOrder->commentOrder_post_consumable_prod_name = $request->commentOrder_post_consumable_prod_name;
            $commentOrder->commentOrder_post_consumable_prod_desc = $request->commentOrder_post_consumable_prod_desc;
            $commentOrder->commentOrder_post_consumable_prod_special = $request->commentOrder_post_consumable_prod_special;           $commentOrder->commentOrder_post_consumable_prod_status = $request->commentOrder_post_consumable_prod_status;
            $commentOrder->commentOrder_post_consumable_prod_item_desc = $request->commentOrder_post_consumable_prod_item_desc;
            $commentOrder->commentOrder_post_consumable_prod_price = $request->commentOrder_post_consumable_prod_price;
            $commentOrder->commentOrder_post_consumable_prod_quantity = $request->commentOrder_post_consumable_prod_quantity;

            $commentOrder->save();
            $commentOrder->user;

            return response()->json([
                'success' => true,
                'commentOrder' => $commentOrder,
                'message' => 'commentOrder added'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function updateCommentInfor1(Request $request)
    {
        try {
            $commentOrder = CommentOrder::find($request->id);
            //check if user is editing his own comment
            if ($commentOrder->user_id != Auth::user()->id) {
                if ($commentOrder->post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorize access'
                    ]);
                }
            }
            $commentOrder->comment_infor1 = $request->comment_infor1;
            $commentOrder->update();

            return response()->json([
                'success' => true,
                'message' => 'commentOrder edited'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    

    public function updateCommentInfor2(Request $request)
    {
        try {
            $commentOrder = CommentOrder::find($request->id);
            //check if user is editing his own comment
            if ($commentOrder->user_id != Auth::user()->id) {
                if ($commentOrder->post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorize access'
                    ]);
                }
            }
            $commentOrder->comment_infor2 = $request->comment_infor2;
            $commentOrder->update();

            return response()->json([
                'success' => true,
                'message' => 'commentOrder edited'
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
            $commentOrder = CommentOrder::find($request->id);
            //check if user is editing his own comment
            if ($commentOrder->user_id != Auth::user()->id) {
                if ($commentOrder->post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorize access'
                    ]);
                }
            }

            $commentOrder->delete();

            return response()->json([
                'success' => true,
                'message' => 'commentOrder deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }


    public function orderComments(Request $request)
    {
        try {
            $commentOrders = CommentOrder::where('order_id', $request->order_id)->get();

            if ($commentOrders->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            //show user of each comment
            foreach ($commentOrders as $commentOrder) {
                $commentOrder->user;
            }

            return response()->json([
                'success' => true,
                'commentOrders' => $commentOrders
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
