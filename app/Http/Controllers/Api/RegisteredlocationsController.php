<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Auth;
use App\Models\Registeredlocations;

class RegisteredlocationsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $registeredlocations = new Registeredlocations;
            $registeredlocations->user_id = Auth::user()->id;
            $registeredlocations->location = $request->location;
            $registeredlocations->save();
            $registeredlocations->user;
            return response()->json([
                'success' => true,
                'message' => 'registered_location',
                'registered_locations' => $registeredlocations
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
            $registeredlocations = Registeredlocations::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $registeredlocations->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }

            $registeredlocations->delete();
            return response()->json([
                'success' => true,
                'message' => 'registeredlocation deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function registeredlocationslist()
    {
        try {
            $registeredlocations = Registeredlocations::orderBy('location')->get();
            return response()->json([
                'success' => true,
                'registered_locations' => $registeredlocations
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}

