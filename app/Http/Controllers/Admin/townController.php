<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Town;
use Illuminate\Http\Request;

class townController extends Controller
{
    //Checked//
    public function index(){
        $towns= Town::with('city')->get();
        return view('admin.town.index',compact('towns'));
    }

    //Checked//
    public function create(){
        $cities= City::select('id','name')->get();

        return view('admin.town.create',compact('cities'));
    }

    //Checked//
    public function store(Request $request){

        $town= Town::create([
            'name'=>$request->name,
            'city_id'=>$request->city_id,
        ]);
        if($town)
        return response()->json([
            'status'=>true,
            'msg'=>"Town  added successfully",
        ]);
        else
            return response()->json([
            'status'=>false,
            'msg'=>"error",
        ]);
    }

    //Checked//
    public function edit($id){
        $cities= City::select('id','name')->get();


        $town= Town::find($id);
        if(!$town){

            return redirect()->back()->with('error','Town does not exist');
        }
        $town= Town::select('id','name')->find($id);
        return view('admin.town.edit',compact('town','cities'));
    }

    //Checked//
    public function update(Request $request, $id){
        $town= Town::find($id);
        if(!$town){
            return redirect()->back()->with('error','Town does not exist');
        }

        $town->update([
            'name'=>$request->name,
            'city_id'=>$request->city_id,

        ]);


        $city= City::select('id','name')->get();
        return redirect()-> route('view.town',compact('city'))->with('update','Town updated successfully');
    }

    //Checked//
    public function delete(Request $request){
        $id=$request->id;
        $town=Town::find($id);
        if(!$town){
            return redirect()->back()->with('error','Town does not exist');
        }

        $town->delete();

        return response()->json([
            'status'=>true,
            'msg'=>"Town delete successfully",
            'id'=>$id,
        ]);
    }



}
