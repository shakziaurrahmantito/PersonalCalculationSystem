<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\roleAssign;
use App\Models\member;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function dasboard(){
        $member    = member::where("status",1)->get();
        return view('Dashboard', compact('member'));
    }


    public function profile(){

        if (Session::get('s_user_id')) {
          $userid = Session::get('s_user_id');
        }else if(Cookie::get('c_user_id')){
          $userid = Cookie::get('c_user_id');
        }


        $user    = user::where("id",$userid)->first();
        return view('profile',compact('user'));
    }


    public function passwordchange(){
       return view('passwordchange');
    }


    public function passwordchangeupdate(Request $req){


        if ($req->isMethod("post")) {

            $valid = Validator::make($req->all(),[
                    "password" => "required",
                    "newpassword" =>'required|min:6'
            ],[
                "password.required" => "Password must not be empty.",
                "newpassword.required" => "New password must not be empty.",
                "newpassword.min" => "New password minimum 6 character."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }

            if (Session::get('s_user_id')) {
              $userid = Session::get('s_user_id');
            }else if(Cookie::get('c_user_id')){
              $userid = Cookie::get('c_user_id');
            }

            $user = User::where("id",$userid)->first();
            if ($user->password == md5($req->password)) {

                $user = User::find($userid);
                $user->password = md5($req->newpassword);
                $user->save();

                return response()->json([
                    "status" => 1,
                    "message" => "Password change!"
                ]);

            }else{
                return response()->json([
                    "status" => 3,
                    "message" => "Password not match!"
                ]);
            }



        }


       
    }


    public function userUpdateProfile(Request $req){


        if ($req->isMethod("post")) {

            $user = User::where("id",$req->id)->first();


            if ($req->hasFile('picture')) {


                if ($user['phone'] == $req->phone) {
                    $valid = Validator::make($req->all(),[
                            "name" => "required",
                            "phone" =>'required|digits:11',
                            "picture" =>'mimes:jpg,png|max:250'
                    ],[
                        "name.required" => "Name must not be empty.",
                        "phone.required" => "Phone must not be empty.",
                        "phone.digits" => "Phone number must 11 digit."
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            "status" => 0,
                            "message" => $valid->errors()
                        ]);
                    }
                }else{
                    $valid = Validator::make($req->all(),[
                        "name" => "required",
                        "phone" =>'required|digits:11|unique:users,phone',
                        "picture" =>'mimes:jpg,png|max:250'
                    ],[
                        "name.required" => "Name must not be empty.",
                        "phone.required" => "Phone must not be empty.",
                        "phone.digits" => "Phone number must 11 digit.",
                        "phone.unique" => "Phone number already exists."
                    ]);
                    if ($valid->fails()) {
                        return response()->json([
                            "status" => 0,
                            "message" => $valid->errors()
                        ]);
                    }

                }

                @unlink($user['picture']);

                $file = $req->picture;
                $file = "img/".substr(md5(time()),0,10).".".$file->getClientOriginalExtension();

                $user = User::find($req->id);
                $user->name     = $req->name;
                $user->phone    = $req->phone;
                $user->picture  = $file;
                move_uploaded_file($req->picture, $file);
                $user->save();
                return response()->json([
                    "status" => 3,
                    "message" => $user
                ]);

            }else{

                if ($user['phone'] == $req->phone) {
                    $valid = Validator::make($req->all(),[
                            "name" => "required",
                            "phone" =>'required|digits:11'
                    ],[
                        "name.required" => "Name must not be empty.",
                        "phone.required" => "Phone must not be empty.",
                        "phone.digits" => "Phone number must 11 digit."
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            "status" => 0,
                            "message" => $valid->errors()
                        ]);
                    }
                }else{
                    $valid = Validator::make($req->all(),[
                        "name" => "required",
                        "phone" =>'required|digits:11|unique:users,phone',
                    ],[
                        "name.required" => "Name must not be empty.",
                        "phone.required" => "Phone must not be empty.",
                        "phone.digits" => "Phone number must 11 digit.",
                        "phone.unique" => "Phone number already exists."
                    ]);
                    if ($valid->fails()) {
                        return response()->json([
                            "status" => 0,
                            "message" => $valid->errors()
                        ]);
                    }

                }

                $user = User::find($req->id);
                $user->name = $req->name;
                $user->phone = $req->phone;
                $user->save();

                return response()->json([
                    "status" => 3,
                    "message" => $user
                ]);

            }


            

            

        }

       
    }


    public function userGetupdatedata(Request $req){
        $user    = User::select("id","name","phone","roleid")->where("id", $req->id)->first();
        return response()->json([
            "status" => 0,
            "message" => $user
        ]);
    }

    public function userlist(){



        $user    = User::get();
        if (Session::get('s_user_id')) {
              $userid = Session::get('s_user_id');
        }else if(Cookie::get('c_user_id')){
              $userid = Cookie::get('c_user_id');
        }


       /*---For Role assign data start---*/

        $roleid  = Session::get('roleid') ? Session::get('roleid') : Cookie::get('roleid');
       $roleAssign    = roleAssign::where("roleid", $roleid)->get();
       $roleAssData = array();
       foreach($roleAssign as $data){
            array_push($roleAssData, $data['name']);
       }

       /*---For Role assign data end---*/

        $role = Role::where("status", 1)->get();

        return view('userlist',compact('user','userid','roleAssData','role'));
    }


    public function userAction(Request $req){

        if ($req->getVal == 1) {
            User::where("id", $req->id)->update(["status" => "1"]);
        }else{
            User::where("id", $req->id)->update(["status" => "0"]);
        }

    }


    public function userDelete(Request $req){
        User::where("id", $req->id)->delete();
        return response()->json([
            "status" => 0
        ]);
    }



    public function userAdd(){
        $role = Role::where("status", 1)->get();
        return view('userAdd',compact('role'));
    }


    public function login(){
        return view("login");
    }

    public function logout(){

        if (Cookie::get('cookie_login') == 1) {
            Cookie::queue('cookie_login',"",-60);
            Cookie::queue('c_user_id',"",-60);
            return redirect("/login");
        }else if(Session::get('session_login') == 1){
            Session::forget('session_login');
            Session::forget('s_user_id');
            return redirect("/login");
        }
    }

    public function userlogin(Request $req){

        $count = User::where("phone", $req->phone)
                ->where("password", md5($req->password))
                ->count();

        $userData = User::where("phone",$req->phone)
                ->where("password", md5($req->password))
                ->first();

            
        if ($count > 0) {

            if ($userData['status'] == 0) {
                    return 2;
            }

            if ($req->has('chbox')) {
                Cookie::queue("cookie_login",1, (10 * 365 * 24 * 60 * 60));
                Cookie::queue("c_user_id",$userData['id'], (10 * 365 * 24 * 60 * 60));
                Cookie::queue("roleid",$userData['roleid'], (10 * 365 * 24 * 60 * 60));
                Session::put("session_login","");
                Session::put("s_user_id", "");
                Session::put("roleid", "");
                return 1;
            }else{
                Session::put("session_login",1);
                Session::put("s_user_id", $userData['id']);
                Session::put("roleid", $userData['roleid']);
                Cookie::queue("cookie_login","", -(10 * 365 * 24 * 60 * 60));
                Cookie::queue("c_user_id","", -(10 * 365 * 24 * 60 * 60));
                Cookie::queue("roleid","", -(10 * 365 * 24 * 60 * 60));
                return 1;
            }

        }else{

            return 0;

        }


        
    }

    public function userInsert(Request $req){

        $array = array();

        for ($i=0; $i < count($req->phone) ; $i++) {
            if (!empty($req->phone[$i])) {
                array_push($array, $req->phone[$i]);
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
                    "name.*" => "required",
                    "phone.*" =>'required|digits:11|unique:users,phone',
                    "password.*" => "required|min:6",
                    "roleid.*" => "required"
            ],[
                "name.*.required" => "Name must not be empty.",
                "phone.*.required" => "Phone must not be empty.",
                "phone.*.digits" => "Phone number must 11 digit.",
                "phone.*.unique" => "Phone number already exists.",
                "password.*.required" => "Password must not be empty.",
                "password.*.min" => "Password minimum 6 character.",
                "roleid.*.required" => "Please select any options."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }



            for ($i=0; $i < count($req->name) ; $i++) {
                $user = new User();
                $user->name         =   $req->name[$i];
                $user->phone        =   $req->phone[$i];
                $user->password     =   md5($req->password[$i]);
                $user->roleid       =   $req->roleid[$i];
                $user->status       =   $req->status[$i];
                $user->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);


            

        }
    }


    public function userUpdate(Request $req){


        if ($req->isMethod("post")) {

            $user = User::where("id",$req->id)->first();

            if ($user['phone'] == $req->phone) {

                $valid = Validator::make($req->all(),[
                        "name" => "required",
                        "phone" =>'required|digits:11',
                        "roleid" => "required"
                ],[
                    "name.required" => "Name must not be empty.",
                    "phone.required" => "Phone must not be empty.",
                    "phone.digits" => "Phone number must 11 digit.",
                    "roleid.required" => "Please select any options."
                ]);

                if ($valid->fails()) {
                    return response()->json([
                        "status" => 0,
                        "message" => $valid->errors()
                    ]);
                }
                
            }else{
                $valid = Validator::make($req->all(),[
                    "name" => "required",
                    "phone" =>'required|digits:11|unique:users,phone',
                    "roleid" => "required"
                ],[
                    "name.required" => "Name must not be empty.",
                    "phone.required" => "Phone must not be empty.",
                    "phone.digits" => "Phone number must 11 digit.",
                    "phone.unique" => "Phone number already exists.",
                    "roleid.required" => "Please select any options."
                ]);

                if ($valid->fails()) {
                    return response()->json([
                        "status" => 0,
                        "message" => $valid->errors()
                    ]);
                }


            }


            $user             =   User::find($req->id);
            $user->name       =   $req->name;
            $user->phone      =   $req->phone;
            $user->roleid     =   $req->roleid;
            $user->save();
      

            return response()->json([
                "status" => 3,
                "message" => $user,
                "role" => $user->role
            ]);

            

        }


    }


}
