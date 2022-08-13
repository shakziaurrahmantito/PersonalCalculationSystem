<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\roleAssign;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class roleController extends Controller
{
    public function roleAdd(){
        return view("roleadd");
    }


    public function roleAssign(){
        $role = Role::where("status",1)->get();
        return view("roleassign",compact('role'));
    }


    public function roleAction(Request $req){

        if ($req->getVal == 1) {
            role::where("id", $req->id)->update(["status" => "1"]);
        }else{
            role::where("id", $req->id)->update(["status" => "0"]);
        }

    }


    public function roleDelete(Request $req){

        role::where("id", $req->id)->delete();
        return response()->json([
            "status" => 0
        ]);

    }


    public function roleUpdate(Request $req){

        if ($req->isMethod("post")) {

            $role = role::where("id",$req->id)->first();

            if ($role['name'] == $req->name) {

                $valid = Validator::make($req->all(),[
                    "name" => "required"
                ],[
                    "name.required" => "Name must not be empty."
                ]);

                if ($valid->fails()) {
                    return response()->json([
                        "status" => 0,
                        "message" => $valid->errors()
                    ]);
                }
                
            }else{
                $valid = Validator::make($req->all(),[
                    "name" => "required|unique:roles"
                ],[
                    "name.required" => "Role must not be empty.",
                    "name.unique" => "Role already exists."
                ]);

                if ($valid->fails()) {
                    return response()->json([
                        "status" => 0,
                        "message" => $valid->errors()
                    ]);
                }

            }

            $role             =   role::find($req->id);
            $role->name       =   $req->name;
            $role->save();

            return response()->json([
                "status" => 3,
                "message" => $role
            ]);

        }

    }


    public function roleGetupdatedata(Request $req){

        $role    = role::select("id","name")->where("id", $req->id)->first();
        return response()->json([
            "status" => 0,
            "message" => $role
        ]);

    }


    public function rolelist(){

        /*---For Role assign data start---*/
        $roleid  = Session::get('roleid') ? Session::get('roleid') : Cookie::get('roleid');
       $roleAssign    = roleAssign::where("roleid", $roleid)->get();
       $roleAssData   = array();
       foreach($roleAssign as $data){
            array_push($roleAssData, $data['name']);
       }

       $role = Role::get();
       return view("rolelist",compact('roleAssData','role'));

    }


    public function roleassingInsert(Request $req){

        $valid = Validator::make($req->all(),[
            "role_assign" => "required"
        ],[
            "role_assign.required" => "Please select any options."
        ]);

        if ($valid->fails()) {
            return response()->json([
                "status" => 0,
                "message" => $valid->errors()
            ]);
        }

        roleassign::where("roleid", $req->role_assign)->delete();

        /*if (!isset($req->role_option)) {
            return response()->json([
                "status" => 1,
                "message" => "Data insert successfully!"
            ]);
        }*/

        for ($i=0; $i < count($req->role_option) ; $i++) { 
            $roleassign = new roleAssign();
            $roleassign->roleid = $req->role_assign;
            $roleassign->name = $req->role_option[$i];
            $roleassign->save();
        }

        return response()->json([
            "status" => 1,
            "message" => "Data insert successfully!"
        ]);

    }


    public function roleInsert(Request $req){


        $array = array();

        for ($i=0; $i < count($req->name) ; $i++) {
            if (!empty($req->name[$i])) {
                array_push($array, $req->name[$i]);
            }
        }

       if (!empty($array)){
            if (count($array) !== count(array_unique($array))) {
                return response()->json([
                    "status" => 2,
                    "message" => implode(", ", array_diff_assoc($array, array_unique($array)))
                ]);
            }
       }


        if ($req->isMethod("post")) {
            $valid = Validator::make($req->all(),[
                    "name.*" => "required|unique:roles,name",
            ],[
                "name.*.required" => "Role must not be empty.",
                "name.*.unique" => "Role already exists."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }



            for ($i=0; $i < count($req->name) ; $i++) {
                $Role = new Role();
                $Role->name      =   $req->name[$i];
                $Role->status    =   $req->status[$i];
                $Role->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);
        }

    }


}
