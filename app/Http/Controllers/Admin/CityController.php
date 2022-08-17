<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //Checked//
    public function index(){
        $cities= City::select('id','name')->get();
        return view('admin.city.index',compact('cities'));
    }

    //Checked//
    public function create(){
        return view('admin.city.create');
    }

    //Checked//
    public function store(Request $request){

      $city=  City::create([
            'name'=>$request->name,
        ]);
        //return redirect()->back()->with('success','Category added successfully');
        if($city)
        return response()->json([
            'status'=>true,
            'msg'=>"City  added successfully",
        ]);
        else
            return response()->json([
            'status'=>false,
            'msg'=>"error",
        ]);
    }

    //Checked//
    public function edit($id){
        $city=City::find($id);
        if(!$city){

            return redirect()->back()->with('error','City does not exist');
        }
        $city= City::select('id','name')->find($id);
        return view('admin.city.edit',compact('city'));
    }

    //Checked//
    public function update(Request $request, $id){
        $city=City::find($id);
        if(!$city){
            return redirect()->back()->with('error','City does not exist');
        }

        $city->update([
            'name'=>$request->name,
        ]);


        $city= City::select('id','name')->get();
        return redirect()-> route('view.city',compact('city'))->with('update','City updated successfully');
    }

    //Checked//
    public function delete(Request $request){
        $id=$request->id;
        $city=City::find($id);
        if(!$city){
            return redirect()->back()->with('error','City does not exist');
        }

        $city->delete();

        return response()->json([
            'status'=>true,
            'msg'=>"City delete successfully",
            'id'=>$id,
        ]);
    }



}
