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
            $user->phone_number = $request->phone_number;
            $user->location = $request->location;
            $user->save();

            $request_login = Request::create('/login', 'POST', [
                'name' => $request->name,
                'password' => $request->password
            ]);
            return $this->login($request_login);
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
            $validator3 = Validator::make($request->all(), ['photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:2048',]);

            $user = User::find(Auth::user()->id);
            $user->lastname = $request->lastname;
            $user->email = $request->email; //handle duplicate errors in android app
            $user->address = $request->address;
            $user->location = $request->location;
            $user->phone_number = $request->phone_number;

            $user->photo_width = $request->photo_width;
            $user->photo_height = $request->photo_height;

            if ($request->file('photo') != null) {
                if ($validator3->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator3->messages()
                    ]);
                }
                $file = $request->file('photo')->store('images', 'public');
                $imageFilename = $file; // Replace with your actual image filename
                $imageUrl = asset('storage/' . $imageFilename);
                $user->photo = $imageUrl;

            } else {
                $user->photo = null;
            }

            $user->update();

            return response()->json([
                'success' => true,
                'user' => $user
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
            $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:2048',]);
            $user = User::find(Auth::user()->id);

            $user->business_registered = $request->business_registered;//correct as it just shows string
            $user->business_name = $request->business_name;
            $user->business_desc = $request->business_desc;//remember to add slogan
            $user->business_password = $request->business_password;
            $user->business_email = $request->business_email;
            $user->business_address = $request->business_address;
            $user->business_location = $request->business_location;
            $user->business_phone_number = $request->business_phone_number;
            $user->business_type = $request->business_type;

            $user->business_photo_width = $request->business_photo_width;
            $user->business_photo_height = $request->business_photo_height;
            
            if ($request->file('business_photo') != null) {
                if ($validator4->fails()) {
                    return response()->Json([
                        'success' => false,
                        'message' => $validator4->messages()
                    ]);
                }
                $file = $request->file('business_photo')->store('images', 'public');
                $imageFilename = $file; // Replace with your actual image filename
                $imageUrl = asset('storage/' . $imageFilename);
                $user->business_photo = $imageUrl;

            } else {
                $user->business_photo = null;
            }

            $user->update();

            return response()->json([
                'success' => true,
                'user' => $user
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

    public function updateNamePassword(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $encryptedPass = Hash::make($request->password);
            $user->name = $request->name;
            $user->password = $encryptedPass;

            $user->update();

            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
