<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Panel</title>
    <link rel="shortcut icon" href="{{asset('img/icon.png')}}">
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- <script src="js/jquery.min.js"></script> -->

    <script src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/uikit-icons.min.js')}}"></script>
    <style type="text/css">
      
      body{background: #ddd;}

    </style>
  </head>
  <body style="background: #ddd;">

    <section class="my-5 p-3 py-5" style="max-width: 450px;margin: auto;">
      <div class="card">
        <div class="card-body">

          <form class="py-4" method="post" id="login">
            
            <hr>
            @csrf
            <h6 class="text-center text-danger" id="msg"></h6>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone number">
              <small id="phone_err" class="form-text" style="color:red;"></small>
            </div>

            <div class="form-group">
              <label  for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              <small id="password_err" class="form-text" style="color:red;"></small>
            </div>
            <div class="form-check my-2">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="chbox">
              <label class="form-check-label" for="exampleCheck1">Check me login</label>
            </div>

            <input type="submit" value="Login" class="btn btn-primary">
            

          </form>

        </div>
      </div>

    </section>


    <script type="text/javascript">
      

  $("#login").submit(function(){

      if ($('#phone').val() == "") {
        $("#phone_err").text("Field must not be empty.");
        return false;
      }else{
        $("#phone_err").text("");
      }

      if ($('#password').val() == "") {
        $("#password_err").text("Field must not be empty.");
        return false;
      }else{
        $("#password_err").text("");
      }

      if ($('#phone').val() !== "" && $('#password').val() !== "") {

          var form = $("#login").get(0);

          $.ajax({
          url : "{{url('/userlogin')}}",
          method : "post",
          data : new FormData(form),
          processData : false,
          contentType : false,
          success : function(data){
             if ($.trim(data) == 0) {
                $("#msg").text("Phone or pasword no match!");
              }else if($.trim(data) == 2){
                $("#msg").text("Account blocked");
              }else{
                window.location.assign("{{url('/')}}");
              }
          }

        });

      }

      return false;

    });


    </script>
  </body>
</html>