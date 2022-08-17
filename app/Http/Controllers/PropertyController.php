<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class PropertyController extends Controller
{

    use GeneralTrait;

    public function index()
    {


        //
    }

    public function create()
    {
        //
    }



    public function store(Request $request)
    {



        $validator = Validator::make($request->all(), [

            'type'=>'required|max:100',
            'price'=>'required|Integer',
            'main_image'=>'required',
            'secondary_image'=>'required',
            'area'=>'required|Integer',
            'number_of_rooms'=>'required|Integer',
            'number_of_bathrooms'=>'required|Integer',
            'phone_subscription'=>'required',
             'net_subscription'=> 'required',
             'dimension_of_the_city'=> 'required|Integer',
             'dimension_of_the_school'=> 'required|Integer',
             'dimension_of_the_market'=> 'required|Integer',
             'owner_description'=> 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }




        $user = Auth::guard('api')->user();


        $user_properties= $user->properties();
        $Number_user_properties = $user_properties->count();

        $max_Number_user_properties = env('maximum_number_free_property');

        # اذا كان مانو مشترك وعدد عقاراتو اكتر من الحد او المتفعلة مسبقا اكتر من الحد
        if(($Number_user_properties >= $max_Number_user_properties || $user->numProperty >= $max_Number_user_properties) && $user->role !=3){
            return  $this->returnError(
                "You cannot add a property.You have exceeded the allowed number of free properties.Please check with the company to activate your account as a joint account.");
        }





        $file_name_main_img = $this->saveImage($request->main_image, 'images/');
        $file_name_secondary_image = $this->saveImage($request->secondary_image, 'images/');


        $property = Property::create([
            'user_id' => $user->id,
            'town_id'=> $request->town_id,
            'type'=> $request->type,
            'for_sell'=> $request->for_sell,
            'for_rent'=> $request->for_rent,
            'duration_of_rent'=> $request->duration_of_rent,
            'price'=> $request->price,
            'main_image'=> $file_name_main_img,
            'secondary_image'=>  $file_name_secondary_image,
            'area'=> $request->area,
            'number_of_rooms'=> $request->number_of_rooms,
            'number_of_bathrooms'=> $request->number_of_bathrooms,
            'phone_subscription'=>$request->phone_subscription,
            'net_subscription'=>$request->net_subscription,
            'dimension_of_the_city'=> $request->dimension_of_the_city,
            'dimension_of_the_school'=> $request->dimension_of_the_school,
            'dimension_of_the_market'=>$request->dimension_of_the_market,
            'owner_description'=> $request->owner_description,
            'sold_rented'=> $request->sold_rented,
        ]);


        $response = [
            'property' => $property,
        ];


        if ($property)
            return $this->returnData($response,"add property successfully.");
        else
            return  $this->returnError("add property failed.");



    }


    public function show(Request $request)
    {
        $id=$request->property_id;
        $property = Property::find($id);
        $response = [
            'property' => $property,
        ];
        if (!$property) {
            return $this->returnError('Property does not exist');
        }
        return $this->returnData($response,"get Property ".$property->type." successfully.");

    }



    public function edit(Property $property)
    {
        //
    }



    public function update(Request $request)
    {
        $user = Auth::guard('api')->user();

        $id=$request->property_id;
        $property = Property::find($id);

        if (!$property) {
            return $this->returnError('Property does not exist');
        }


        if ($user->id!=$property->user_id)
            return $this->returnError('Unauthorized Access');


        if ($request->has('main_image')) {
            $this->deletImage("images/", $property->main_image);
            $file_name_main_img = $this->saveImage($request->main_image, 'images/');
            $property->update([
                'main_image' => $file_name_main_img,
            ]);
        }

        if ($request->has('secondary_image')) {
            $this->deletImage("images/", $property->secondary_image);
            $file_name_secondary_image = $this->saveImage($request->secondary_image, 'images/');
            $property->update([
                'secondary_image' => $file_name_secondary_image,
            ]);
        }


        $property->update([
            'user_id' => $user->id,
            'town_id'=> $request->town_id,
            'type'=> $request->type,
            'for_sell'=> $request->for_sell,
            'for_rent'=> $request->for_rent,
            'duration_of_rent'=> $request->duration_of_rent,
            'price'=> $request->price,
            'area'=> $request->area,
            'number_of_rooms'=> $request->number_of_rooms,
            'number_of_bathrooms'=> $request->number_of_bathrooms,
            'phone_subscription'=>$request->phone_subscription,
            'net_subscription'=>$request->net_subscription,
            'dimension_of_the_city'=> $request->dimension_of_the_city,
            'dimension_of_the_school'=> $request->dimension_of_the_school,
            'dimension_of_the_market'=>$request->dimension_of_the_market,
            'owner_description'=> $request->owner_description,
            'sold_rented'=> $request->sold_rented,
        ]);



        return $this->returnSuccess(" Property updated successfully");

    }

    public function delete(Request $request)
    {

        $user = Auth::guard('api')->user();

        $id=$request->property_id;
        $property = Property::find($id);

        if (!$property) {
            return $this->returnError('Property does not exist');
        }

        if ($user->id!=$property->user_id)
            return $this->returnError('Unauthorized Access');

        $this->deletImage("images/", $property->main_image);
        $this->deletImage("images/", $property->secondary_image);
        $property->delete();
        return $this->returnSuccess(" Property deleted successfully");

    }


    public function get_all_property_for_user(Request $request)
    {

        $user_id=$request->user_id;
        $user = User::find($user_id);
        if ($user) {
            $id = $user->id;
            $properties = Property::where('status','on')->where('user_id', $id)->get();

            if (!$properties || sizeof($properties) == 0) {
                return $this->returnError('properties does not exist');
            }

            $response = [
                'properties' => $properties,
            ];

            return $this->returnData($response, "get all property successfully.");
        }
        else
            return  $this->returnError("get all property failed maybe user does not exist.");

    }


    public function get_all_property_for_me(Request $request)
    {

        $user = Auth::guard('api')->user();

        $id=$user->id;
        $properties = Property::where('user_id', $id)->get();

        if (!$properties||sizeof($properties)==0) {
            return $this->returnError('properties does not exist');
        }

        $response = [
            'properties' => $properties,
        ];

        if ($user)
            return $this->returnData($response,"get all property successfully.");
        else
            return  $this->returnError("get all property failed.");

    }


    public function get_all_properties(Request $request)
    {

        $properties = Property::where('status','on')->get();

        if (!$properties||sizeof($properties)==0) {
            return $this->returnError('properties does not exist');
        }

        $response = [
            'properties' => $properties,
        ];


        return $this->returnData($response,"get all property successfully.");

    }

# *************************** new **********************************

    public function get_properties_by_type(Request $request)
    {


        $type= $request->type;
        $for= $request->for;

        if ($for=='sell'){
            $sell=1;
        }
        else{
            $sell=0;
        }

        $properties = Property::where('status','on')->where('type',$type)->where('for_sell',$sell)->get();

        if (!$properties||sizeof($properties)==0) {
            return $this->returnError('properties does not exist');
        }

        $response = [
            'properties' => $properties,
        ];


        return $this->returnData($response,"get all property successfully.");

    }


}
