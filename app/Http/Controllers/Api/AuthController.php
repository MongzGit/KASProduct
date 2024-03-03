<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $creds = $request->only(['name', 'password']);

            if (!$token = auth()->attempt($creds)) {

                return response()->json([
                    'success' => false,
                    'message' => 'invalid credentials'
                ]);
            }
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => Auth::user()
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function register(Request $request)
    {

        $encryptedPass = Hash::make($request->password);

        $user = new User;

        try {
            $user->name = $request->name;
            $user->password = $encryptedPass;
            $user->save();
            return $this->login($request);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'logout success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    // this function saves user name,lastname and photo
    public function saveUserInfo(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->location = $request->location;
            $user->password = $request->password;
            $user->phone_number = $request->phone_number;
            $photo = '';
            //check if user provided photo
            if ($request->photo != '') {
                // user time for photo name to prevent name duplication
                $photo = time() . '.jpg';
                // decode photo string and save to storage/profiles
                file_put_contents('storage/profiles/' . $photo, base64_decode($request->photo));
                $user->photo = $photo;
            }

            $user->update();

            return response()->json([
                'success' => true,
                'photo' => $photo
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }

    }

    public function saveUserBusinessRegistered(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->business_registered = $request->business_registered;

            $user->business_name = $request->business_name;
            $user->business_desc = $request->business_desc;
            $user->business_password = $request->business_password;
            $user->business_email = $request->business_email;
            $user->business_address = $request->business_address;
            $user->business_location = $request->business_location;
            $user->business_phone_number = $request->business_phone_number;
            $user->business_type = $request->business_type;
            $business_photo = '';
            //check if user provided photo
            if ($request->business_photo != '') {
                // user time for photo name to prevent name duplication
                $business_photo = time() . '.jpg';
                // decode photo string and save to storage/profiles
                file_put_contents('storage/profiles/' . $business_photo, base64_decode($request->business_photo));
                $user->business_photo = $business_photo;
            }

            $user->update();

            return response()->json([
                'success' => true,
                'business photo' => $business_photo
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function getUserInfo(request $request)
    {
        try {
            return response()->json([
                'success' => true,
                'user' => Auth::user()
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

}
