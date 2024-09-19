<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;

class OrdersController extends Controller
{
    public function create(Request $request)
    {
        try {
            $order = new Order;
            $order->user_id = Auth::user()->id;

            $order->order_post_user_id = $request->order_post_user_id;//the business the order is directed to
            $order->order_status = $request->order_status;
            $order->order_estimated_time_of_preparation = $request->order_estimated_time_of_preparation;
            $order->order_estimated_time_of_delivery = $request->order_estimated_time_of_delivery;

            // $order->order_post_post_type = $request->order_post_post_type;
            // $order->order_post_consumable_business_name = $request->order_post_consumable_business_name;
            // $order->order_post_consumable_prod_name = $request->order_post_consumable_prod_name;
            // $order->order_post_consumable_prod_desc = $request->order_post_consumable_prod_desc;
            // $order->order_post_consumable_prod_special = $request->order_post_consumable_prod_special;
            // $order->order_post_consumable_prod_status = $request->order_post_consumable_prod_status;
            // $order->order_post_consumable_prod_item_desc = $request->order_post_consumable_prod_item_desc;
            // $order->order_post_consumable_prod_price = $request->order_post_consumable_prod_price;
            // $order->order_post_post_general_infor1 = $request->order_post_post_general_infor1;
            // $order->order_post_post_general_infor2 = $request->order_post_post_general_infor2;
            // $order->order_post_post_general_infor3 = $request->order_post_post_general_infor3;
            // $order->order_post_post_general_infor4 = $request->order_post_post_general_infor4;
            // $order->order_post_post_photo1 = $request->order_post_post_photo1;
            // $order->order_post_post_photo1_width = $request->order_post_post_photo1_width;
            // $order->order_post_post_photo1_height = $request->order_post_post_photo1_height;
            // $order->order_post_post_photo2 = $request->order_post_post_photo2;
            // $order->order_post_post_photo2_width = $request->order_post_post_photo2_width;
            // $order->order_post_post_photo2_height = $request->order_post_post_photo2_height;
            // $order->order_post_relation_counter = $request->order_post_relation_counter;

            // $order->poster_business_name = $request->poster_business_name;
            // $order->poster_business_desc = $request->poster_business_desc;
            // $order->poster_business_photo = $request->poster_business_photo;
            // $order->poster_business_photo_width = $request->poster_business_photo_width;
            // $order->poster_business_photo_height = $request->poster_business_photo_height;
            // $order->poster_business_email = $request->poster_business_email;
            // $order->poster_business_address_house_number = $request->poster_business_address_house_number;
            // $order->poster_business_address_street_name = $request->poster_business_address_street_name;
            // $order->poster_business_address_zone = $request->poster_business_address_zone;
            // $order->poster_business_address_location = $request->poster_business_address_location;
            // $order->poster_business_address_city = $request->poster_business_address_city;
            // $order->poster_business_address_postal_code = $request->poster_business_address_postal_code;
            // $order->poster_business_phone_number = $request->poster_business_phone_number;
            // $order->poster_business_type = $request->poster_business_type;

            $order->save();

            $order->user;
            return response()->json([
                'success' => true,
                'message' => 'order posted',
                'order' => $order
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

            $order = Order::find($request->id);

            if ($order == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            if ((Auth::user()->id != $order->user_id)) {
                if ($order->order_post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorized access for order update'
                    ]);
                }
            }
            $order->order_post_user_id = $request->order_post_user_id;
            $order->order_status = $request->order_status;
            $order->order_estimated_time_of_preparation = $request->order_estimated_time_of_preparation;
            $order->order_estimated_time_of_delivery = $request->order_estimated_time_of_delivery;

            $order->update();

            return response()->json([
                'success' => true,
                'message' => 'order edited'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function updateOrderETD(Request $request)
    {
        try {

            $order = Order::find($request->id);

            if ($order == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            if ((Auth::user()->id != $order->user_id)) {
                if ($order->order_post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorized access for order update'
                    ]);
                }
            }
        
            $order->order_estimated_time_of_delivery = $request->order_estimated_time_of_delivery;

            $order->update();

            return response()->json([
                'success' => true,
                'message' => 'order edited'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
    public function updateOrderETP(Request $request)
    {
        try {

            $order = Order::find($request->id);

            if ($order == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            if ((Auth::user()->id != $order->user_id)) {
                if ($order->order_post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorized access for order update'
                    ]);
                }
            }
            $order->order_estimated_time_of_preparation = $request->order_estimated_time_of_preparation;

            $order->update();

            return response()->json([
                'success' => true,
                'message' => 'order edited'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function updateOrderStatus(Request $request)
    {
        try {
            $order = Order::find($request->id);

            if ($order == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            if ((Auth::user()->id != $order->user_id)) {
                if ($order->order_post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorized access for order update'
                    ]);
                }
            }

            $order->order_status = $request->order_status;

            $order->update();
            return response()->json([
                'success' => true,
                'message' => 'Order Status Edited'
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
            $order = Order::find($request->id);

            if ($order == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            if ((Auth::user()->id != $order->user_id)) {
                if ($order->order_post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorized ggh access for order update'
                    ]);
                }
            }

            $order->delete();
            return response()->json([
                'success' => true,
                'message' => 'order deleted'
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function orders(Request $request)
    {
        try {

            $orders = Order::orderBy('id')->get();

            if ($orders->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            foreach ($orders as $order) {
                //get user of post
                $order->user;
                //comments count
                $order['commentOrdersCount'] = count($order->commentOrders);
            }

            return response()->json([
                'success' => true,
                'orders' => $orders
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function order(Request $request)
    {
        try {
            $order = Order::find($request->id);

            if ($order == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }
            return response()->json([
                'success' => true,
                'post' => $order
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function myorders()
    {
        try {

            $orders = Order::where('user_id', Auth::user()->id)->get();

            if ($orders->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            return response()->json([
                'success' => true,
                'post' => $orders
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function mybusinessorders()
    {
        try {
            $orders = Order::where('order_post_user_id', Auth::user()->id)->get();

            if ($orders->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            return response()->json([
                'success' => true,
                'post' => $orders
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

}
