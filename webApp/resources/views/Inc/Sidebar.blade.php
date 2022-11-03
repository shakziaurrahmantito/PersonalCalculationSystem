  <?php

      use App\Models\roleAssign;
      use App\Models\User;

      if (Session::get('s_user_id')) {
        $userheaderid = Session::get('s_user_id');
      }else if(Cookie::get('c_user_id')){
        $userheaderid = Cookie::get('c_user_id');
      }
      
      $userheader = User::where("id", $userheaderid)->first();
      $roleAssign    = roleAssign::where("roleid", $userheader['roleid'])->get();
      $roleAssData   = array();
      foreach($roleAssign as $data){
        array_push($roleAssData, $data['name']);
      }

  ?>
<section class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-dark" style="min-height: 550px;">
      <div id="accordian">
        <ul class="list-unstyled side-menu my-3">
                
              <li class="p-1"><a href="{{url('/')}}"><i class="fa fa-tachometer"></i>Dashboard</a>
              </li>

              @if(in_array("adminarea", $roleAssData))

              <li class="p-1"><a href="#select-1" data-toggle="collapse"><i class="fa fa-user"></i>User</a>
                  <ul class="collapse <?php 

                  if(Request::path() == "userAdd" || Request::path() == "userlist"){
                    echo "show";
                  }

                ?> list-unstyled ml-4" id="select-1" data-parent="#accordian">
                    <li><a href="{{url('/userAdd')}}">Add User</a></li>
                    <li><a href="{{url('/userlist')}}">User List</a></li>
                  </ul>
              </li>


              <li class="p-1"><a href="#select-6" data-toggle="collapse"><i class="fa fa-recycle"></i>Role</a>
                  <ul class="collapse <?php 

                  if(Request::path() == "roleadd" || Request::path() == "rolelist" || Request::path() == "roleassign"){
                    echo "show";
                  }

                ?> list-unstyled ml-4" id="select-6" data-parent="#accordian">
                    <li><a href="{{url('/roleadd')}}">Role Add</a></li>
                    <li><a href="{{url('/rolelist')}}">Role List</a></li>
                    <li><a href="{{url('/roleassign')}}">Role Assign</a></li>
                  </ul>
              </li>

              @endif

              <li class="p-1"><a href="#select-5" data-toggle="collapse"><i class="fa fa-users"></i>Member</a>
                  <ul class="collapse <?php 

                  if(Request::path() == "memberAdd" || Request::path() == "memberlist"){
                    echo "show";
                  }

                ?> list-unstyled ml-4" id="select-5" data-parent="#accordian">
                    <li><a href="{{url('/memberAdd')}}">Add Member</a></li>
                    <li><a href="{{url('/memberlist')}}">Member List</a></li>
                  </ul>
              </li>


              <li class="p-1"><a href="#select-8" data-toggle="collapse"><i class="fa fa-google-wallet"></i>Getway</a>
                  <ul class="collapse <?php 

                  if(Request::path() == "getwayadd" || Request::path() == "getwaylist"){
                    echo "show";
                  }

                ?> list-unstyled ml-4" id="select-8" data-parent="#accordian">
                    <li><a href="{{url('/getwayadd')}}">Add Getway</a></li>
                    <li><a href="{{url('/getwaylist')}}">Getway List</a></li>
                  </ul>
              </li>



            <li class="p-1"><a href="#select-3" class="" data-toggle="collapse"><i class="fa fa-indent"></i>Income(In)</a>
                  <ul class="collapse <?php 

                  if(Request::path() == "incomeAdd" || Request::path() == "incomelist"){
                    echo "show";
                  }

                ?> list-unstyled ml-4" id="select-3" data-parent="#accordian">
                    <li><a href="{{url('/incomeAdd')}}">Add Income</a></li>
                    <li><a href="{{url('/incomelist')}}">Income List</a></li>
                  </ul>
            </li>

            <li class="p-1"><a href="#select-2" class="" data-toggle="collapse"><i class="fa fa-outdent"></i>Expense(out)</a>
                  <ul class="collapse <?php 

                  if(Request::path() == "expenseAdd" || Request::path() == "expenselist"){
                    echo "show";
                  }

                ?> list-unstyled ml-4" id="select-2" data-parent="#accordian">
                    <li><a href="{{url('/expenseAdd')}}">Add Expense</a></li>
                    <li><a href="{{url('/expenselist')}}">Expense List</a></li>
                  </ul>
            </li>

            <li class="p-1"><a href="{{url('/logout')}}"><i class="fa fa fa-sign-out"></i>Logout</a>
              </li>



              

             


        </ul>
      </div>
  </div>