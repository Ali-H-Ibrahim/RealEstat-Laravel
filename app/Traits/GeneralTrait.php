<?php


namespace App\Traits;


trait GeneralTrait
{

    protected function isAdmin($user): bool
    {
        if (!empty($user)) {

            return $user->role=1;
        }

        return false;
    }

    protected function isWriter($user): bool
    {

        if (!empty($user)) {
            return $user->tokenCan('writer');
        }

        return false;
    }

    public function returnSuccess($msg=''){

        return response()->json([
            'state'=>true,
            'msg'=> $msg,
        ]);

    }


    public function returnError($msg=''){

        return response()->json([
            'state'=>false,
            'msg'=> $msg,
        ]);

    }

    public function returnData($value,$msg=''){

        return response()->json([
                'state'=>true,
                'msg'=> $msg,
                'data'=> $value
            ]);
    }




    function saveImage($photo,$path){

        $file_extension=$photo->getClientOriginalName();
        $file_name=time().".".$file_extension;
        $photo->move($path,$file_name);
        $xx = $file_name;
        return $xx;

    }

    function deletImage($path, $photo)
    {
        $file_path = public_path($path . $photo);
        if (file_exists($file_path))
            unlink($file_path);

    }

    }
