<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\member;
use App\Models\roleAssign;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;


class memberController extends Controller
{
    public function memberAdd(){
        return view("memberadd");
    }


    public function memberlist(){


        /*---For Role assign data start---*/
        $roleid  = Session::get('roleid') ? Session::get('roleid') : Cookie::get('roleid');
       $roleAssign    = roleAssign::where("roleid", $roleid)->get();
       $roleAssData   = array();
       foreach($roleAssign as $data){
            array_push($roleAssData, $data['name']);
       }

       $member = member::get();
       return view("memberlist",compact('roleAssData','member'));


    }


    public function memberDelete(Request $req){

        member::where("id", $req->id)->delete();
        return response()->json([
            "status" => 0
        ]);

    }


    public function memberAction(Request $req){
        
        if ($req->getVal == 1) {
            member::where("id", $req->id)->update(["status" => "1"]);
        }else{
            member::where("id", $req->id)->update(["status" => "0"]);
        }

    }


    public function memberUpdate(Request $req){
        
        if ($req->isMethod("post")) {

            $member = member::where("id",$req->id)->first();

            if ($member['name'] == $req->name) {

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
                    "name" => "required|unique:members"
                ],[
                    "name.required" => "Member name must not be empty.",
                    "name.unique" => "Member name already exists."
                ]);

                if ($valid->fails()) {
                    return response()->json([
                        "status" => 0,
                        "message" => $valid->errors()
                    ]);
                }

            }

            $member             =   member::find($req->id);
            $member->name       =   $req->name;
            $member->save();

            return response()->json([
                "status" => 3,
                "message" => $member
            ]);

        }

    }


    public function memberGetupdatedata(Request $req){
        
        $role    = member::select("id","name")->where("id", $req->id)->first();
        return response()->json([
            "status" => 0,
            "message" => $role
        ]);

    }


    public function memberInsert(Request $req){


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
                    "name.*" => "required|unique:members,name",
            ],[
                "name.*.required" => "Name must not be empty.",
                "name.*.unique" => "Name already exists."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }



            for ($i=0; $i < count($req->name) ; $i++) {
                $member = new member();
                $member->name      =   $req->name[$i];
                $member->status    =   $req->status[$i];
                $member->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);
        }




    }



}
