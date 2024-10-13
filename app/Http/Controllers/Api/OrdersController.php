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
