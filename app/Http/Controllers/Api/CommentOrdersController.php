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
            $commentOrder->order_id = $request->id;
            $commentOrder->commentOrder = $request->commentOrder;
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

    public function update(Request $request)
    {
        try {
            $commentOrder = CommentOrder::find($request->id);
            //check if user is editing his own comment
            if ($commentOrder->id != Auth::user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorize access'
                ]);
            }
            $commentOrder->commentOrder = $request->commentOrder;
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
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorize access'
                ]);
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

    public function commentOrders(Request $request)
    {
        try {
            $commentOrders = CommentOrder::where('post_id', $request->id)->get();
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
