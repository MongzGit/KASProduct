<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Component;
use Validator;
use Auth;
use Exception;
use Storage;


class ComponentsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $component = new Component;
            $component->user_id = Auth::user()->id;
            $component->post_b_i_id = $request->post_b_i_id;
            $component->component_name = $request->component_name;
            $component->component_code = $request->component_code;
            $component->component_desc = $request->component_desc;
            $component->component_type = $request->component_type;
            $component->component_info = $request->component_info;
            $component->price_per_component = $request->price_per_component;
            $component->weight_per_component = $request->weight_per_component;

            $component->save();
            $component->user;

            return response()->json([
                'success' => true,
                'Component' => $component,
                'message' => 'Component created'
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
    public function update(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->component_name = $request->component_name;
            $component->component_code = $request->component_code;
            $component->component_desc = $request->component_desc;
            $component->component_type = $request->component_type;
            $component->component_info = $request->component_info;
            $component->price_per_component = $request->price_per_component;
            $component->weight_per_component = $request->weight_per_component;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateComponentName(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->component_name = $request->component_name;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateComponentCode(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->component_code = $request->component_code;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }


    public function updateComponentDesc(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->component_desc = $request->component_desc;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateComponentType(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->component_type = $request->component_type;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function updateComponentInfo(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->component_info = $request->component_info;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }


    public function updatePricePerComponent(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->price_per_component = $request->price_per_component;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
    public function updateWeightPerComponent(Request $request){

        try{
            $component = Component::find($request->id);
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $component->weight_per_component = $request->weight_per_component;

            $component->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $component
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
            $component = Component::find($request->id);
            // check if user is editing his own post
            if (Auth::user()->id != $component->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            

            $component->delete();
            return response()->json([
                'success' => true,
                'message' => 'Component deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function components()
    {
        try {
            $components = Component::orderBy('id', 'desc')->get();
            foreach ($components as $component) {
                //get user of post
                $component->user;

            }
            return response()->json([
                'success' => true,
                'Components' => $components
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function component(Request $request)
    {
        try {
            $component = Component::find($request->id);

            return response()->json([
                'success' => true,
                'Component' => $component
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function myComponents()
    {
        try {
            $components = Component::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'Components' => $components,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function myBusinessGeneralComponents()
    {
        try {
            $components = Component::where('user_id', Auth::user()->id)->where('component_type', 'a')->orderBy('id', 'desc')->get();
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'Components' => $components,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function prodComponents(Request $request)
    {
        try {
            $components = Component::where('post_b_i_id', $request->id)->orderBy('id', 'desc')->get();;
            foreach ($components as $component) {
                //get user of post
                $component->user;

            }

            return response()->json([
                'success' => true,
                'Components' => $components
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
}
