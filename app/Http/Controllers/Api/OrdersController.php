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
            $order->order_number = $request->order_number;
            $order->order_type = $request->order_type;
            $order->order_status = $request->order_status;
            $order->order_payment_type = $request->order_payment_type;
            $order->order_delivery_infor1 = $request->order_delivery_infor1;
            $order->order_delivery_infor2 = $request->order_delivery_infor2;
            $order->order_delivery_std_cost = $request->order_delivery_std_cost;
            $order->order_post_user_business_name = $request->order_post_user_business_name;
            $order->order_post_user_business_desc = $request->order_post_user_business_desc;
            $order->order_post_user_business_email = $request->order_post_user_business_email;
            $order->order_post_user_business_address_house_number = $request->order_post_user_business_address_house_number;
            $order->order_post_user_business_address_street_name = $request->order_post_user_business_address_street_name;
            $order->order_post_user_business_address_zone = $request->order_post_user_business_address_zone;
            $order->order_post_user_business_address_location = $request->order_post_user_business_address_location;
            $order->order_post_user_business_address_city = $request->order_post_user_business_address_city;
            $order->order_post_user_business_phone_number = $request->order_post_user_business_phone_number;
            $order->order_estimated_time_of_preparation = $request->order_estimated_time_of_preparation;
            $order->order_estimated_time_of_delivery = $request->order_estimated_time_of_delivery;

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
            $order->order_post_user_id = $request->order_post_user_id;//the business the order is directed to
            $order->order_number = $request->order_number;
            $order->order_type = $request->order_type;
            $order->order_status = $request->order_status;
            $order->order_payment_type = $request->order_payment_type;
            $order->order_delivery_infor1 = $request->order_delivery_infor1;
            $order->order_delivery_infor2 = $request->order_delivery_infor2;
            $order->order_delivery_std_cost = $request->order_delivery_std_cost;
            $order->order_post_user_business_name = $request->order_post_user_business_name;
            $order->order_post_user_business_desc = $request->order_post_user_business_desc;
            $order->order_post_user_business_email = $request->order_post_user_business_email;
            $order->order_post_user_business_address_house_number = $request->order_post_user_business_address_house_number;
            $order->order_post_user_business_address_street_name = $request->order_post_user_business_address_street_name;
            $order->order_post_user_business_address_zone = $request->order_post_user_business_address_zone;
            $order->order_post_user_business_address_location = $request->order_post_user_business_address_location;
            $order->order_post_user_business_address_city = $request->order_post_user_business_address_city;
            $order->order_post_user_business_phone_number = $request->order_post_user_business_phone_number;
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

    public function updateDeliveryStdCostInfor(Request $request)
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
           
            $order->order_delivery_infor1 = $request->order_delivery_infor1;
            $order->order_delivery_infor2 = $request->order_delivery_infor2;
            $order->order_delivery_std_cost = $request->order_delivery_std_cost;

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

            //get user of post
            $order->user;
            //comments count
            $order['commentOrdersCount'] = count($order->commentOrders);


            return response()->json([
                'success' => true,
                'order' => $order
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

}
