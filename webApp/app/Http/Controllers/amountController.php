<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\amount;
use App\Models\paymentgetway;
use App\Models\member;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class amountController extends Controller
{


    public function expenseAdd(){
        $member = member::where("status",1)->get();
        $getway = paymentgetway::where("status",1)->get();
        return view("debit",compact('member','getway'));
    }

    public function incomeAdd(){
        $member = member::where("status",1)->get();
        $getway = paymentgetway::where("status",1)->get();
        return view("credit",compact('member','getway'));
    }


    public function incomelist(){
        $amount = amount::orderby("id","DESC")->get();
        $member = member::orderby("id","DESC")->get();
        $getway = paymentgetway::orderby("id","DESC")->get();
        return view("incomelist",compact('member','amount','getway'));
    }


    public function amountGetupdatedata(Request $req){
        $amount    = amount::select("id","credit","debit","memberid","getwayid","date")->where("id", $req->id)->first();
        return response()->json([
            "status" => 0,
            "message" => $amount
        ]);
    }


    public function creditamountUpdate(Request $req){

        if ($req->isMethod("post")) {
            $valid = Validator::make($req->all(),[
                "credit" => "required|integer",
                "memberid" => "required",
                "getwayid" => "required",
                "date" => "required"
            ],[
                "credit.required" => "Amount must not be empty.",
                "memberid.required" => "Member name must not be empty.",
                "getwayid.required" => "Getway name must not be empty.",
                "date.required" => "Date must not be empty."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }
                
            $amount             =   amount::find($req->id);
            $amount->credit     =   $req->credit;
            $amount->memberid   =   $req->memberid;
            $amount->getwayid   =   $req->getwayid;
            $amount->date       =   $req->date;
            $amount->prepare_by    =   Session::get('s_user_id') == 1 ? Session::get('s_user_id') : Cookie::get('c_user_id');
            $amount->save();

            return response()->json([
                "status" => 3,
                "message" => $amount,
                "member" => $amount->member,
                "getway" => $amount->paymentgetway,
                "user" => $amount->User,
                "senderdate" => date("d-M-Y",strtotime($amount->date))
            ]);
        }

    }


    public function debitamountUpdate(Request $req){

        if ($req->isMethod("post")) {
            $valid = Validator::make($req->all(),[
                "debit" => "required|integer",
                "memberid" => "required",
                "getwayid" => "required",
                "date" => "required"
            ],[
                "debit.required" => "Amount must not be empty.",
                "memberid.required" => "Member name must not be empty.",
                "getwayid.required" => "Getway name must not be empty.",
                "date.required" => "Date must not be empty."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }
                
            $amount             =   amount::find($req->id);
            $amount->debit      =   $req->debit;
            $amount->memberid   =  $req->memberid;
            $amount->getwayid   =  $req->getwayid;
            $amount->date       =  $req->date;
            $amount->prepare_by =   Session::get('s_user_id') == 1 ? Session::get('s_user_id') : Cookie::get('c_user_id');
            $amount->save();

            return response()->json([
                "status" => 3,
                "message" => $amount,
                "member" => $amount->member,
                "getway" => $amount->paymentgetway,
                "user" => $amount->User,
                "senderdate" => date("d-M-Y",strtotime($amount->date))
            ]);
        }

    }

    public function expenselist(){
        $amount = amount::orderby("id","DESC")->get();
        $member = member::orderby("id","DESC")->get();
        $getway = paymentgetway::orderby("id","DESC")->get();
        return view("expenselist",compact('amount','member','getway'));
    }



    public function expenseInsert(Request $req){

        date_default_timezone_set("Asia/Dhaka");

        if ($req->isMethod("post")) {
            $valid = Validator::make($req->all(),[
                    "debit.*" => "required|integer",
                    "memberid.*" =>'required',
                    "getwayid.*" => "required",
                    "date.*" => "required"
            ],[
                "debit.*.required" => "Amount must not be empty.",
                "debit.*.integer" => "Please input valid amount.",
                "memberid.*.required" => "Please select anyone.",
                "getwayid.*.required" => "Please select anyone.",
                "date.*.required" => "please choose date."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }



            for ($i=0; $i < count($req->debit) ; $i++) {
                $amount = new amount();
                $amount->debit       =   $req->debit[$i];
                $amount->memberid      =   $req->memberid[$i];
                $amount->getwayid    =   $req->getwayid[$i];
                $amount->prepare_by    =   Session::get('s_user_id') == 1 ? Session::get('s_user_id') : Cookie::get('c_user_id');
                $amount->date        =   $req->date[$i];
                $amount->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);
        }

    }


    public function insertInsert(Request $req){

        if ($req->isMethod("post")) {
            $valid = Validator::make($req->all(),[
                    "credit.*" => "required|integer",
                    "memberid.*" =>'required',
                    "getwayid.*" => "required",
                    "date.*" => "required"
            ],[
                "credit.*.required" => "Amount must not be empty.",
                "credit.*.integer" => "Please input valid amount.",
                "memberid.*.required" => "Please select anyone.",
                "getwayid.*.required" => "Please select anyone.",
                "date.*.required" => "please choose date."
            ]);

            if ($valid->fails()) {
                return response()->json([
                    "status" => 0,
                    "message" => $valid->errors()
                ]);
            }



            for ($i=0; $i < count($req->credit) ; $i++) {
                $amount = new amount();
                $amount->credit      =   $req->credit[$i];
                $amount->memberid    =   $req->memberid[$i];
                $amount->getwayid    =   $req->getwayid[$i];
                $amount->prepare_by  =   Session::get('s_user_id') == 1 ? Session::get('s_user_id') : Cookie::get('c_user_id');
                $amount->date        =   $req->date[$i];
                $amount->save();
            }

            return response()->json([
                "status" => 3,
                "message" => "Data insert successfully!"
            ]);
        }

    }





}
