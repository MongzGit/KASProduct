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
            $order->desc = $request->desc;
            $order->name = $request->name;
            $order->type = $request->type;
            $order->price = $request->price;
            $order->location = $request->location;
            $order->status = $request->status;
            $order->address = $request->address;
            $order->phoneNumber = $request->phoneNumber;

            if ($request->photo != '') {
                $photo = time() . '.jpg';
                file_put_contents('storage/posts/' . $photo, base64_decode($request->photo));
                $order->photo = $photo;
            }
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
            // check if user is editing his own post
            // we need to check user id with post user id
            if (Auth::user()->id != $order->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $order->desc = $request->desc;
            $order->name = $request->name;
            $order->type = $request->type;
            $order->price = $request->price;
            $order->location = $request->location;
            $order->status = $request->status;
            $order->address = $request->address;
            $order->phoneNumber = $request->phoneNumber;
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
            if ($order->photo != '') {
                Storage::delete('public/posts/' . $order->photo);
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
            $orders = Order::orderBy('id', 'desc')->get();
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

}
