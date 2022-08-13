@extends('Main.Main')
@section("title","Profile")
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
                    <h5 class="m-0 text-left">Profile</h5>
                    <hr>

                    <form method="post" id="myForm" enctype="multipart/form-data">

              <div class="alert alert-warning alert-dismissible fade show" style="display:none" role="alert"></div>
                      
                        @csrf
                      <div class="form-group">
                        <input type="text" name="name" class="form-control" value="{{$user['name']}}" placeholder="Enter name">

                    <input type="hidden" name="id"  value="{{$user['id']}}">

                        <small id="name_err" class="form-text text-muted"></small>
                      </div>

                      <div class="form-group">
                        <input type="text" name="phone" class="form-control" value="{{$user['phone']}}" placeholder="Enter phone">
                        <small id="phone_err" class="form-text text-muted"></small>
                      </div>

                      <div class="form-group">
                        <input type="file" name="picture" class="form-control-file">
                        <small id="picture_err" class="form-text text-muted"></small>
                      </div>

                      <button type="submit" class="btn btn-primary">Save</button>

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
        url : "{{url('/userUpdateProfile')}}",
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
          else if(data.status == 3){


            $("#profilename").text("Welcome! "+data.message.name);
            $("#profileimg").attr("src",data.message.picture);

            $(".alert").css("display","block").text('Data updated successfully!');

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