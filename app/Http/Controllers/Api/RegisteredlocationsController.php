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
            $registeredlocations->city = $request->city;
            $registeredlocations->aka1 = $request->aka1;
            $registeredlocations->aka2 = $request->aka2;
            $registeredlocations->aka3 = $request->aka3;
            $registeredlocations->aka4 = $request->aka4;


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

    public function updateAka1(Request $request){

        try{
            $registeredlocation = Registeredlocations::find($request->id);
            if (Auth::user()->id != $registeredlocation->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $registeredlocation->aka1 = $request->aka1;

            $registeredlocation->update();

            return response()->json([
                'success' => true,
                'message' => 'updated News Status',
                'location' => $registeredlocation
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateAka2(Request $request){
        try{
            $registeredlocation = Registeredlocations::find($request->id);
            if (Auth::user()->id != $registeredlocation->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $registeredlocation->aka2 = $request->aka2;

            $registeredlocation->update();

            return response()->json([
                'success' => true,
                'message' => 'updated News Status',
                'location' => $registeredlocation
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateAka3(Request $request){
        try{
            $registeredlocation = Registeredlocations::find($request->id);
            if (Auth::user()->id != $registeredlocation->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $registeredlocation->aka3 = $request->aka3;

            $registeredlocation->update();

            return response()->json([
                'success' => true,
                'message' => 'updated News Status',
                'location' => $registeredlocation
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateAka4(Request $request){

        try{
            $registeredlocation = Registeredlocations::find($request->id);
            if (Auth::user()->id != $registeredlocation->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $registeredlocation->aka4 = $request->aka4;

            $registeredlocation->update();

            return response()->json([
                'success' => true,
                'message' => 'updated News Status',
                'location' => $registeredlocation
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

