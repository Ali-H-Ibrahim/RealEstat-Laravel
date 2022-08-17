<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Town;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Auth;

class propertyController extends Controller
{

    use GeneralTrait;

    public function index()
    {
        $properties = Property::get();
        return view('admin.property.index', compact('properties'));
    }



    public function create()
    {
        $towns = Town::get();
        return view('admin.property.create', compact('towns'));
    }


    public function store(Request $request)
    {


        $for_sell = 0;
        $for_rent = 0;

        if ($request->display_type == 1) {
            $for_sell = 1;
        } else$for_rent = 1;

        try {
            $file_name_main_img = $this->saveImage($request->main_image, 'images/');
            $file_name_secondary_image = $this->saveImage($request->secondary_image, 'images/');

            $userId = Auth::id();

            $property = Property::create([
                'user_id' => $userId,
                'town_id' => $request->town_id,
                'type' => $request->type,
                'area' => $request->area,
                'price' => $request->price,
                'for_sell' => $for_sell,
                'for_rent' => $for_rent,
                'duration_of_rent' => 0,
                'main_image' => $file_name_main_img,
                'secondary_image' =>$file_name_secondary_image,
                'number_of_rooms' => $request->number_of_rooms,
                'number_of_bathrooms' => $request->number_of_bathrooms,
                'phone_subscription' => $request->phone_subscription,
                'net_subscription' => $request->net_subscription,
                'dimension_of_the_city' => $request->dimension_of_the_city,
                'dimension_of_the_school' => $request->dimension_of_the_school,
                'dimension_of_the_market' => $request->dimension_of_the_market,
                'owner_description' => $request->owner_description,
                'sold_rented' => 1,
                'status' => $request->status,

            ]);

            if ($property)
                return redirect()->back()->with('success', 'property added successfully');

            else
                return redirect()->back()->with('error', 'An error occured, try again');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An error occured, try again');
        }
    }




    public function edit($id)
    {
        $towns = Town::get();
        $property = Property::find($id);
        if (!$property) {
            return redirect()->back()->with('error', 'Town does not exist');
        }
        return view('admin.property.edit', compact('towns', 'property'));
    }




    public function update(Request $request, $id)
    {

        $for_sell = 0;
        $for_rent = 0;

        if ($request->display_type == 1) {
            $for_sell = 1;
        } else$for_rent = 1;

        $property = Property::find($id);
        if (!$property) {
            return redirect()->back()->with('error', 'property does not exist');
        }

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

        $userId = Auth::id();

        $property->update([
            'user_id' => $userId,
            'town_id' => $request->town_id,
            'type' => $request->type,
            'area' => $request->area,
            'price' => $request->price,

            'for_sell' => $for_sell,
            'for_rent' => $for_rent,
            'duration_of_rent' => 0,
            'number_of_rooms' => $request->number_of_rooms,
            'number_of_bathrooms' => $request->number_of_bathrooms,
            'phone_subscription' => $request->phone_subscription,
            'net_subscription' => $request->net_subscription,
            'dimension_of_the_city' => $request->dimension_of_the_city,
            'dimension_of_the_school' => $request->dimension_of_the_school,
            'dimension_of_the_market' => $request->dimension_of_the_market,
            'owner_description' => $request->owner_description,
            'sold_rented' => 1,
        ]);


        return redirect()->route('view.properties')->with('update', 'property updated successfully');

    }




    public function delete($id)
    {
        $property = Property::find($id);
        if (!$property) {
            return redirect()->back()->with('error', 'property does not exist');
        }

        $this->deletImage("images/", $property->main_image);
        $this->deletImage("images/", $property->secondary_image);

        $property->delete();
        return redirect()->back()->with('delete', 'property deleted successfully');
    }



    public function show($id)
    {

        $property = Property::find($id);
        if (!$property) {
            return redirect()->back()->with('error', 'property does not exist');
        }

        return view('admin.property.show', compact('property'));
    }



    public function cheng_stutus($id)
    {
        $property = Property::find($id);
        if (!$property) {
            return redirect()->back()->with('error', 'property does not exist');
        }

        $customer =User::find($property->user_id);
        if (!$customer) {
            return redirect()->back()->with('error', 'property customer  does not exist');
        }
        ###########################   new  ###########################
        if ($property->getStatus() == 'Active') {
            $newStatus = 'off';
            $nunberProperty= $customer->numProperty + 1;

        }
        else {
            $newStatus = 'on';

            $nunberProperty= $customer->numProperty -1;
            if($nunberProperty < 0){
                $nunberProperty=0;
            }

        }

        $property->update([
            'status' => $newStatus,
        ]);

        $customer->update([
            'numProperty' => $nunberProperty,
        ]);

        return redirect()->route('view.properties')->with('update', 'property updated successfully');

    }



}
