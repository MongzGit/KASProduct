<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Auth;
use App\Models\Notification;

class NotificationsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $notification = new Notification;
            $notification->user_id = Auth::user()->id;
            $notification->title = $request->title;
            $notification->body = $request->body;
            $notification->hour = $request->hour;
            $notification->minute = $request->minute;
            $notification->general1 = $request->general1;
            $notification->general2 = $request->general2;


            $notification->save();
            $notification->user;
            return response()->json([
                'success' => true,
                'message' => 'posted',
                'notification' => $notification
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
            $notification = Notification::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $notification->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }

            $notification->delete();
            return response()->json([
                'success' => true,
                'message' => 'Notification deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function notifications()
    {
        try {
            $notifications = Notification::orderBy('id')->get();
            return response()->json([
                'success' => true,
                'notifications' => $notifications
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

}
