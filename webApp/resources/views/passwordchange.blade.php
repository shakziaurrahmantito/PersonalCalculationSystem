@extends('Main.Main')
@section("title","Password Change")
@section("content")
<style type="text/css">
  body{background: #f3f3f3;}
  .dashboard{}
  .dashboard i{font-size: 35px;}
  .dashboard p{font-size: 18px;}
  .dashboard h5{font-size: 24px;}
</style>

<div class="col-md-10">


  <div class="row mt-2 mb-4 dashboard">

      <div class="col-md-8 my-3 ml-auto mr-auto">
            <div class="card">
              <div class="card-body">
                    <h5 class="m-0 text-left">Password Change</h5>
                    <hr>

                    <form method="post" id="myForm">

              <div class="alert alert-warning alert-dismissible fade show" style="display:none" role="alert"></div>
                      
                      @csrf

                      <div class="form-group">
                        <input type="password" name="password" class="form-control" value="" placeholder="Enter old password">
                        <small id="password_err" class="form-text text-muted"></small>
                      </div>

                      <div class="form-group">
                        <input type="password" name="newpassword" class="form-control" value="" placeholder="Enter new password">
                        <small id="newpassword_err" class="form-text text-muted"></small>
                      </div>

                      <button type="submit" class="btn btn-primary">Change</button>

                    </form>



                    <hr>
              </div>
            </div>
      </div>




  </div>  


   
    </div>
      </div>
    </div>
  </section>



  <script type="text/javascript">


    
    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      $.ajax({
        url : "{{url('/passwordchangeupdate')}}",
        method: "post",
        data : new FormData(form),
        contentType : false,
        processData : false,
        beforeSend : function(){
          $(document).find(".form-text").text("");
        },
        success: function(data){

          if (data.status == 0) {

            $.each(data.message, function(prefix, values){
              $("#"+prefix+"_err").text(values);
            })

          }
          else if(data.status == 1){

            $(".alert").css("display","block").removeClass("alert-danger").addClass("alert-info").text(data.message);
            $("#myForm")[0].reset();

          }else if(data.status == 3){

            $(".alert").removeClass("alert-info").addClass("alert-danger").css("display","block").text(data.message);

          }else{

            alert("Something wrong");

          }


        }
      });

      return false;
      
    });




    
  

  </script>



  <!--JavaScript Plugin-->
  <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>

@endsection