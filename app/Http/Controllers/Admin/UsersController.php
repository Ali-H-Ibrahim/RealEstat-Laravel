<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function ShowNormalUser(){

        $users=User::whereIn('role' ,[2,3])->select('id','name','email','role')->get();

        return view('admin.user.showNormalUser',compact('users'));
    }

    public function ShowAdmin(){

        $users=User::where('role',1)->select('id','name','email')->get();

        //return response()->json($users);
        return view('admin.user.showAdmin',compact('users'));



    }

    public function addAdmain(Request $request){
        $id=$request->id;
        $user=User::find($id);
        if(!$user){
            return redirect()->back()->with('error','User does not exist');
        }
        $user->update([
           'role'=>1
        ]);

        return response()->json([
            'status'=>true,
            'msg'=>"Add successfully",
            'id'=>$id,
        ]);
    }

    public function addSubscriber($id){

        $user=User::find($id);
        if(!$user){
            return redirect()->back()->with('error','User does not exist');
        }

        if ($user->role == 3)
            $newRole = 2;
        else
            $newRole = 3;

        $user->update([
           'role'=>$newRole
        ]);


        return redirect()->route('show.normal.users')->with('update', 'User updated successfully');

    }


    public function getBestCustomer(){


//        $best = User::find(User::max('numProperty'));
//
//
//        return $best;

    }


    #******************************** new ****************************

    public function maximum_number_free_property(Request  $request)
    {
        $num=$request->num;
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace('maximum_number_free_property='.env('maximum_number_free_property'),'maximum_number_free_property='.$num,file_get_contents($path)));
        }

        return redirect()->back()->with('error','User does not exist');


//        return putenv ("maximum_number_free_property=$num");


    }


}
