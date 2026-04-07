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
use App\Providers\FCMService;
use App\Providers\FirebaseTokenService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function getUserInfo()
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

    public function login(Request $request)
    {
        try {
            $creds = $request->only(['name', 'password']);
            $creds2 = $request->only(['email', 'password']);

            if (!$token = auth()->attempt(credentials: $creds)) {
                if (!$token = auth()->attempt(credentials: $creds2)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'invalid credentials'
                    ]);
                }
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

    public function register(Request $request)
    {
        // Step 1: Basic validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string|min:4',
            'phone_number' => 'nullable|string|max:20',
            'address_location' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            // Check if password validation failed specifically
            if ($validator->errors()->has('password')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password must be at least 4 characters long'
                ], 422);
            }

            // Generic validation failure
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Step 2: Check if a user with same name AND same password already exists
            $existingUser = User::where('name', $request->name)->get()
                ->first(function ($user) use ($request) {
                    return Hash::check($request->password, $user->password);
                });

            if ($existingUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'User with the same name and password already exists'
                ], 409);
            }

            // Step 3: Create new user (allowed if same name but different password)
            $user = new User;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->address_location = $request->address_location;
            $user->save();

            // Step 4: Auto-login after registration
            $request_login = Request::create('/login', 'POST', [
                'name' => $request->name,
                'password' => $request->password
            ]);

            return $this->login($request_login);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveUserBusinessRegistered(Request $request)
    {
        try {
            // $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $user = User::find(Auth::user()->id);

            $user->business_registered = $request->business_registered;//correct as it just shows string
            $user->business_name = $request->business_name;
            $user->business_desc = $request->business_desc;//remember to add slogan
            $user->business_slogan = $request->business_slogan;
            $user->business_password = $request->business_password;
            $user->business_email = $request->business_email;
            $user->business_address_house_number = $request->business_address_house_number;
            $user->business_address_street_name = $request->business_address_street_name;
            $user->business_address_zone = $request->business_address_zone;
            $user->business_address_location = $request->business_address_location;
            $user->business_address_city = $request->business_address_city;
            $user->business_address_postal_code = $request->business_address_postal_code;
            $user->business_phone_number = $request->business_phone_number;
            $user->business_type = $request->business_type;
            $user->business_delivery_infor1 = $request->business_delivery_infor1;
            $user->business_delivery_infor2 = $request->business_delivery_infor2;
            $user->business_delivery_std_cost = $request->business_delivery_std_cost;
            $user->business_general_infor = $request->business_general_infor;
            $user->business_status = $request->business_status;
            $user->business_opening_operating_hours = $request->business_opening_operating_hours;
            $user->business_closing_operating_hours = $request->business_closing_operating_hours;
            $user->business_allow_auto_operating_hours = $request->business_allow_auto_operating_hours;

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

    public function saveWhatsappInfo(Request $request)
    {
        try {
            // $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $user = User::find(Auth::user()->id);

            $user->whatsapp_url = $request->whatsapp_url;
            $user->whatsapp_enabled = $request->whatsapp_enabled;//remember to add slogan

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

    public function updateWhatsappUrlInfo(Request $request)
    {
        try {
            // $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $user = User::find(Auth::user()->id);

            $user->whatsapp_url = $request->whatsapp_url;

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

    public function updateWhatsappEnabledInfo(Request $request)
    {
        try {
            // $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $user = User::find(Auth::user()->id);

            $user->whatsapp_url = $request->whatsapp_url;
            $user->whatsapp_enabled = $request->whatsapp_enabled;//remember to add slogan

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

    public function saveUserBusinessInfor(Request $request)
    {
        try {
            // $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $user = User::find(Auth::user()->id);

            $user->business_name = $request->business_name;
            $user->business_desc = $request->business_desc;//remember to add slogan
            $user->business_slogan = $request->business_slogan;
            $user->business_email = $request->business_email;

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

    public function updateUserBusinessPassword(Request $request)
    {
        try {
            // $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $user = User::find(Auth::user()->id);

            $user->business_password = $request->business_password;


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
    public function updateUserEmail(Request $request)
    {
        try {
            // $validator4 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);
            $user = User::find(Auth::user()->id);

            $user->email = $request->email;


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




    // this function saves user name,lastname and photo
    public function saveUserInfo(Request $request)
    {
        try {
            // $validator3 = Validator::make($request->all(), ['photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);

            $user = User::find(Auth::user()->id);
            $user->lastname = $request->lastname;
            $user->email = $request->email; //handle duplicate errors in android app
            $user->address_house_number = $request->address_house_number;
            $user->address_street_name = $request->address_street_name;
            $user->address_zone = $request->address_zone;
            $user->address_location = $request->address_location;
            $user->address_city = $request->address_city;
            $user->address_postal_code = $request->address_postal_code;
            $user->phone_number = $request->phone_number;

            // $user->photo_width = $request->photo_width;
            // $user->photo_height = $request->photo_height;

            // if ($request->file('photo') != null) {
            //     if ($validator3->fails()) {
            //         $user->photo = null;
            //     } else {
            //         $file = $request->file('photo')->store('images', 'public');
            //     $imageFilename = $file; // Replace with your actual image filename
            //     $imageUrl = asset('storage/' . $imageFilename);
            //     $user->photo = $imageUrl;
            //     }

            // } else {
            //     $user->photo = null;
            // }

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

    public function updateUserAddress(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);

            $user->address_house_number = $request->address_house_number;
            $user->address_street_name = $request->address_street_name;
            $user->address_zone = $request->address_zone;
            $user->address_location = $request->address_location;
            $user->address_city = $request->address_city;
            $user->address_postal_code = $request->address_postal_code;

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

    public function updateUserBusinessAddress(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);

            $user->business_address_house_number = $request->business_address_house_number;
            $user->business_address_street_name = $request->business_address_street_name;
            $user->business_address_zone = $request->business_address_zone;
            $user->business_address_location = $request->business_address_location;
            $user->business_address_city = $request->business_address_city;
            $user->business_address_postal_code = $request->business_address_postal_code;

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

    public function updateUserPhoto(Request $request)
    {
        try {
            $validator3 = Validator::make($request->all(), ['photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:3500',]);

            $user = User::find(Auth::user()->id);

            $user->photo_width = $request->photo_width;
            $user->photo_height = $request->photo_height;

            if ($request->file('photo') != null) {
                if ($validator3->fails()) {
                    $user->photo = null;
                } else {
                    $file = $request->file('photo')->store('images', 'public');
                    $imageFilename = $file; // Replace with your actual image filename
                    $imageUrl = asset('storage/' . $imageFilename);
                    $user->photo = $imageUrl;
                }

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

    public function updateUserBusinessPhoto(Request $request)
    {
        try {
            $validator3 = Validator::make($request->all(), ['business_photo' => 'required|image|mimes:jpg,jpeg,png,jpeg,gif,svg|max:4000',]);

            $user = User::find(Auth::user()->id);

            $user->business_photo_width = $request->business_photo_width;
            $user->business_photo_height = $request->business_photo_height;

            if ($request->file('business_photo') != null) {
                if ($validator3->fails()) {
                    $user->business_photo = null;
                } else {
                    $file = $request->file('business_photo')->store('images', 'public');
                    $imageFilename = $file; // Replace with your actual image filename
                    $imageUrl = asset('storage/' . $imageFilename);
                    $user->business_photo = $imageUrl;
                }

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

    public function updateDeliveryStdCostInfor(Request $request)
    {
        try {

            $user = User::find(Auth::user()->id);

            $user->business_delivery_infor1 = $request->business_delivery_infor1;
            $user->business_delivery_infor2 = $request->business_delivery_infor2;
            $user->business_delivery_std_cost = $request->business_delivery_std_cost;

            $user->update();

            return response()->json([
                'success' => true,
                'message' => 'business edited'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function updateBusinessGeneralInfor(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);

            $user->business_general_infor = $request->business_general_infor;

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

    public function updateAddressLocation(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->address_location = $request->address_location;
            $user->business_address_location = $request->address_location;

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

    public function updateBusinessStatus(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->business_status = $request->business_status;

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

    public function updateBusinessOperatingHour(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->business_opening_operating_hours = $request->business_opening_operating_hours;
            $user->business_closing_operating_hours = $request->business_closing_operating_hours;
            $user->business_allow_auto_operating_hours = $request->business_allow_auto_operating_hours;

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

    public function updateBusinessOpeningOperatingHours(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->business_opening_operating_hours = $request->business_opening_operating_hours;

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

    public function updateBusinessClosingOperatingHours(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);

            $user->business_closing_operating_hours = $request->business_closing_operating_hours;

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

    public function updateBusinessAllowAutoOperatingHours(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);

            $user->business_allow_auto_operating_hours = $request->business_allow_auto_operating_hours;

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

    public function broadcastNotification(Request $request)
    {
        // Step 1: Validate incoming request
        $validated = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        // Step 2: Build payload
        $payload = [
            'message' => [
                'topic' => 'all_users',
                'notification' => [
                    'title' => $validated['title'],
                    'body' => $validated['body'],
                ],
                'android' => [
                    'priority' => 'high' ?? 'normal',
                ]
            ]
        ];

        // Step 3: Generate access token
        $tokenService = new FirebaseTokenService;
        $accessToken = $tokenService->generateAccessToken();

        $url = "https://fcm.googleapis.com/v1/projects/449417033022/messages:send";

        try {
            // Step 4: Send request to FCM
            $response = Http::withToken($accessToken)->post($url, $payload);

            // Step 5: Log and return response
            Log::info('FCM Payload Sent:', $payload);
            Log::info('FCM Response:', $response->json());

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            // Step 6: Handle errors gracefully
            Log::error('FCM Broadcast Error:', ['message' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to send notification',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getFirebaseToken(FirebaseTokenService $tokenService)
    {
        $token = $tokenService->generateAccessToken();

        return response()->json(['access_token' => $token]);
    }

    public function deleteOnApp()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ]);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User account deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage()
            ]);
        }
    }

    public function loginDeletion(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return back()->withErrors(['Invalid credentials']);
        }

        // Redirect to delete view with token
        return view('delete', ['token' => $token]);
    }

    public function delete(Request $request)
    {
        try {
            $user = auth()->user(); // user resolved by jwtAuth middleware

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User account deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }
}
