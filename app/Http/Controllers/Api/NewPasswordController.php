<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Auth;


class NewPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status == Password::RESET_LINK_SENT) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reset link sent.',
                    //'status' => __($status)
                ]);
                // return [
                //     'status' => __($status)
                // ];
            }
            return response()->json([
                'success' => false,
                'message' => 'Reset link not sent.',
                //'status' => __($status)
            ]);
            // throw ValidationException::withMessages(
            //     ['email' => [trans($status)]]
            // );
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Reset link not sent.',
                'status' => '' . $e
            ]);
        }
    }

    public function reset(Request $request)
    {
        try {
            // $request->validate([
            //     'token' => 'required',
            //     'email' => 'required|email',
            //     'password' => ['required', 'confirmed', RulesPassword::defaults()],
            // ]);

            // Check if validation fails
            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', RulesPassword::defaults()],
                'password_confirmation' => 'required|same:password',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    $user->tokens()->delete();

                    event(new PasswordReset($user));
                }
            );

            if ($status == Password::PASSWORD_RESET) {
                return view('reset-password-successful')->withErrors($validator->errors());
                // return response()->json([
                //     'success' => true,
                //     'message' => $validator->errors(),
                //     //'email' => Auth::user()->email,
                //     'password' => $request->password,
                //     'request' => $request->all(),
                //     'offical message' => 'Password reset successfully'
                // ]);
            } else {
                return view('reset-password')->withErrors($validator->errors());
                // return response()->json([
                //     'success' => false,
                //     'message' => $validator->errors(),
                //     //'email' => Auth::user()->email,
                //     'password' => $request->password,
                //     'request' => $request->all(), 
                //     'offical message' => 'Password not reset successfully'
                // ]);
            }

        } catch (ValidationException $e) {
            //     // Return the reset-password view with validation errors
            return view('reset-password')->withErrors($e->errors());
        }
    }

    public function updatePassword(Request $request)
    {
        return view('reset-password');
        // $request->validate([
        //     'token' => 'required',
        //     'email' => 'required|email',
        //     'password' => ['required', 'confirmed', RulesPassword::defaults()],
        // ]);

        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user) use ($request) {
        //         $user->forceFill([
        //             'password' => Hash::make($request->password),
        //             'remember_token' => Str::random(60),
        //         ])->save();

        //         $user->tokens()->delete();

        //         event(new PasswordReset($user));
        //     }
        // );

        // if ($status == Password::PASSWORD_RESET) {
        //     return response([
        //         'message'=> 'Password reset successfully'
        //     ]);
        // }

        // return response([
        //     'message'=> __($status)
        // ], 500);
    }
}
