<?php 
  
  use App\Models\User;
  if (Session::get('s_user_id')) {
    $userheaderid = Session::get('s_user_id');
  }else if(Cookie::get('c_user_id')){
    $userheaderid = Cookie::get('c_user_id');
  }

  $userheader = User::where("id", $userheaderid)->first();
  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--JavaScript-->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/uikit-icons.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('js/printThis.js')}}"></script>
    <style type="text/css">
      .side-menu{}
      .side-menu li{font-size: 18px;
          border-bottom: 1px solid #9db3c9;
          margin-top: 10px;
        }
      .side-menu li:last-child{
        border-bottom: none;
      }
      .side-menu li a{color: #eedddd;}
      .side-menu li i{margin-right: 10px;}
      .side-menu li ul li{
        font-size: 18px;
        border-bottom: none;
        margin-top: 10px;
      }
      .side-menu li a:hover{
        color: #b39292;
      }
      .side-menu li a:hover{
        text-decoration: none;
      }
      .navbar-nav li a{
        font-size: 18px;
      }
      .navbar-nav li a i{
        font-size: 18px;
        margin-right: 5px;
      }
    </style>
  </head>
  <body>

    <!--Navbar-->

    <nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top">
      <!-- <div class="container"> -->
        <!-- <a href="" class="navbar-brand">Online Shopping</a> -->
        <button data-target="#myNav" data-toggle="collapse" class="navbar-toggler navbar-toggler-right"><span class="navbar-toggler-icon"></span></button>

        <div class="navbar-collapse collapse" id="myNav">
          <ul class="navbar-nav">
            <!-- <li class="nav-item"><a class="nav-link" target="_blank" href=""><i class="fa fa-arrows" aria-hidden="true"></i>Visite Site</a></li>
             <li class="nav-item"><a class="nav-link" href=""><i class="fa fa-envelope-open-o" aria-hidden="true"></i>Inbox</a></li> -->

             <li class="nav-item"><a class="nav-link" href="" id="profilename">Welcome! {{$userheader['name']}}</a></li>

          </ul>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item"></li>
            <li class="nav-item" title="Change your image"><a class="nav-link" href="">
              <img style="height:30px;width: 30px;border-radius: 50%;" src="{{$userheader['picture']}}" id="profileimg">
            </a></li>

            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profile
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url('/profile')}}">Profile Update</a>
                <a class="dropdown-item" href="{{url('/passwordchange')}}">Password Change</a>
              </div>
            </li>




            <li class="nav-item"><a class="nav-link" href="{{url('/logout')}}">Logout</a></li>
          </ul>
        </div>




    </nav>