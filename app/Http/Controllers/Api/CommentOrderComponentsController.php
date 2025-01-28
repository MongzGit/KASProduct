<?php

namespace App\Http\Controllers\Api;

use App\Models\CommentOrderComponent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Exception;

class CommentOrderComponentsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $commentOrderComponent = new CommentOrderComponent;
            $commentOrderComponent->user_id = Auth::user()->id;
            $commentOrderComponent->comment_order_id = $request->comment_order_id;
            $commentOrderComponent->order_id = $request->order_id; //order id that the commentOrder product belongs
            $commentOrderComponent->post_id = $request->post_id;
            $commentOrderComponent->post_user_id = $request->post_user_id;
            $commentOrderComponent->component_name = $request->component_name;
            $commentOrderComponent->component_code = $request->component_code;
            $commentOrderComponent->component_desc = $request->component_desc;
            $commentOrderComponent->component_type = $request->component_type;
            $commentOrderComponent->component_info = $request->component_info;
            $commentOrderComponent->price_per_component = $request->price_per_component;
            $commentOrderComponent->weight_per_component = $request->weight_per_component;

            $commentOrderComponent->save();
            $commentOrderComponent->user;

            return response()->json([
                'success' => true,
                'commentOrderComponent' => $commentOrderComponent,
                'message' => 'commentOrderComponent added'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function updateCommentOrderId(Request $request)
    {
        try {
            $commentOrderComponent = CommentOrderComponent::find($request->id);

            //check if user is editing his own comment
            if ($commentOrderComponent->user_id != Auth::user()->id) {
                if ($commentOrderComponent->post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorize access'
                    ]);
                }
            }
            $commentOrderComponent->comment_order_id = $request->comment_order_id;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'component updated'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    

    public function updateOrderId(Request $request)
    {
        try {
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            //check if user is editing his own comment
            if ($commentOrderComponent->user_id != Auth::user()->id) {
                if ($commentOrderComponent->post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorize access'
                    ]);
                }
            }
            $commentOrderComponent->order_id = $request->order_id; //order id that the commentOrder product belongs
    
            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'component updated'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function updatePostId(Request $request)
    {
        try {
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            //check if user is editing his own comment
            if ($commentOrderComponent->user_id != Auth::user()->id) {
                if ($commentOrderComponent->post_user_id != Auth::user()->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorize access'
                    ]);
                }
            }
            $commentOrderComponent->post_id = $request->post_id; //order id that the commentOrder product belongs
    
            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'component updated'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function updateComponentName(Request $request){

        try{
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            if (Auth::user()->id != $commentOrderComponent->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $commentOrderComponent->component_name = $request->component_name;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $commentOrderComponent
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
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            if (Auth::user()->id != $commentOrderComponent->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $commentOrderComponent->component_code = $request->component_code;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $commentOrderComponent
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
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            if (Auth::user()->id != $commentOrderComponent->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $commentOrderComponent->component_desc = $request->component_desc;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $commentOrderComponent
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
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            if (Auth::user()->id != $commentOrderComponent->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $commentOrderComponent->component_type = $request->component_type;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $commentOrderComponent
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
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            if (Auth::user()->id != $commentOrderComponent->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $commentOrderComponent->component_info = $request->component_info;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $commentOrderComponent
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
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            if (Auth::user()->id != $commentOrderComponent->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $commentOrderComponent->price_per_component = $request->price_per_component;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $commentOrderComponent
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
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            if (Auth::user()->id != $commentOrderComponent->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]);
            }
            $commentOrderComponent->weight_per_component = $request->weight_per_component;

            $commentOrderComponent->update();

            return response()->json([
                'success' => true,
                'message' => 'updated',
                'Component' => $commentOrderComponent
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
            $commentOrderComponent = CommentOrderComponent::find($request->id);
            //check if user is editing his own comment
            if ($commentOrderComponent->user_id != Auth::user()->id) {
                
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthorize access'
                    ]);
                
            }

            $commentOrderComponent->delete();

            return response()->json([
                'success' => true,
                'message' => 'commentOrderComponent deleted'
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }


    public function orderComponents(Request $request)
    {
        try {
            $commentOrderComponents = CommentOrderComponent::where('order_id', $request->id)->get();

            if ($commentOrderComponents->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }


            return response()->json([
                'success' => true,
                'commentOrderComponents' => $commentOrderComponents
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function commentOrderComponents(Request $request)
    {
        try {
            $commentOrderComponents = CommentOrderComponent::where('comment_order_id', $request->id)->get();

            if ($commentOrderComponents->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }



            return response()->json([
                'success' => true,
                'commentOrderComponents' => $commentOrderComponents
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function myBusinessOrderedComponents()
    {
        try {
            $commentOrderComponents = CommentOrderComponent::where('post_user_id', Auth::user()->id)->get();

            if ($commentOrderComponents->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            return response()->json([
                'success' => true,
                'commentOrderComponents' => $commentOrderComponents
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function myOrderedComponents()
    {
        try {
            $commentOrderComponents = CommentOrderComponent::where('user_id', Auth::user()->id)->get();

            if ($commentOrderComponents->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'n'
                ]);
            }

            return response()->json([
                'success' => true,
                'commentOrderComponents' => $commentOrderComponents
            ]);
        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function commentOrderComponent(Request $request)
    {
        try {
            $commentOrderComponent = CommentOrderComponent::find($request->id);

            return response()->json([
                'success' => true,
                'commentOrderComponents' => $commentOrderComponent
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }

    public function Components(Request $request)
    {
        try {
            $commentOrderComponent = CommentOrderComponent::orderBy('id', 'desc')->get();

            return response()->json([
                'success' => true,
                'commentOrderComponents' => $commentOrderComponent
            ]);

        } catch (Exception $e) {
            return response()->Json([
                'success' => false,
                'message' => null . $e
            ]);
        }
    }
}


