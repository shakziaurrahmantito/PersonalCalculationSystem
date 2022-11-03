<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\paymentgetway;
use App\Models\roleAssign;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class paymentGetwayController extends Controller
{
    public function getwayAdd(){
        return view("getwayadd");
    }


    public function getwaylist(){
        /*---For Role assign data start---*/
        $roleid  = Session::get('roleid') ? Session::get('roleid') : Cookie::get('roleid');
       $roleAssign    = roleAssign::where("roleid", $roleid)->get();
       $roleAssData   = array();
       foreach($roleAssign as $data){
            array_push($roleAssData, $data['name']);
       }

       $paymentgetway = paymentgetway::get();
       return view("getwaylist",compact('roleAssData','paymentgetway'));
    }


    public function getwayAction(Request $req){

        if ($req->getVal == 1) {
            paymentgetway::where("id", $req->id)->update(["status" => "1"]);
        }else{
            paymentgetway::where("id", $req->id)->update(["status" => "0"]);
        }

    }


    public function getwayDelete(Request $req){

        paymentgetway::where("id", $req->id)->delete();
        return response()->json([
            "status" => 0
        ]);

    }


    public function getwayUpdate(Request $req){

        if ($req->isMethod("post")) {

            $pgw = paymentgetway::where("id",$req->id)->first();

            if ($pgw['name'] == $req->name) {

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
                    "name" => "required|unique:paymentgetways"
                ],[
                    "name.required" => "Getway must not be empty.",
                    "name.unique" => "Getway already exists."
                ]);

                if ($valid->fails()) {
                    return response()->json([
                        "status" => 0,
                        "message" => $valid->errors()
                    ]);
                }

            }

            $pgw             =   paymentgetway::find($req->id);
            $pgw->name       =   $req->name;
            $pgw->save();

            return response()->json([
                "status" => 3,
                "message" => $pgw
            ]);

        }

    }


    public function getwayGetupdatedata(Request $req){

        $role    = paymentgetway::select("id","name")->where("id", $req->id)->first();
        return response()->json([
            "status" => 0,
            "message" => $role
        ]);

    }




    public function getwayInsert(Request $req){


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
                    "name.*" => "required|unique:paymentgetways,name",
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
                $pg            = new paymentgetway();
                $pg->name      =   $req->name[$i];
                $pg->status    =   $req->status[$i];
                $pg->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);
        }

    }
}
