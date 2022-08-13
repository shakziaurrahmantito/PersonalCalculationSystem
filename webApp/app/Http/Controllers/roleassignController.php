<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\roleAssign;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class roleassignController extends Controller
{
    public function getRoleassingdata(Request $req){
        $roleAssign = roleAssign::where("roleid", $req->roleid)->get();

        return response()->json([
            "status" => 1,
            "message" => $roleAssign
        ]);
    }
}
