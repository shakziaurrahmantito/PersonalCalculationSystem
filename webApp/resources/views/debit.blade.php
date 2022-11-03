@extends('Main.Main')
@section("title","Expense Out")
@section("content")

<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
          <div style="overflow: hidden;">
            <h3 class="float-left">Expense</h3>
            <button type="button" class="btn btn-primary float-right" id="addNew">Add New</button>
          </div>
          <hr>

            <form method="post" id="myForm" enctype="multipart/form-data">
              @csrf
              <div class="alert alert-warning alert-dismissible fade show" style="display:none" role="alert"></div>
              <div id="addRow"></div>
              <hr>
              <button type="submit" class="btn btn-primary" style="display:none">Save</button>
            </form>
          </div>
      </div>
        </div>

      </div>
    </div>
      </div>
    </div>
  </section>



  <script type="text/javascript">

    $("form").on("click",".remove",function(){

      var length = $(".name").length;
      $(this).parent().parent().remove();

      if (length < 2) {
        $('button[type=submit]').css("display","none");
      }


      
    });


    $("#addNew").click(function(){

      $(".alert").hide();
      var length = $(".name").length;
      $("#addRow").append('<div class="form-row">'+

        '<div class="col-md-3 my-2">'+
        '<input type="text" class="form-control name" placeholder="Amount example 20,000" name="debit[]">'+
        '<small id="debit_'+length+'_err" class="form-text text-muted"></small></div>'+

        '<div class="col-md-3 my-2">'+
        '<select class="form-control" name="memberid[]"><option value="">Select</option>@foreach($member as $data)<option value="{{$data["id"]}}">{{$data["name"]}}</option>@endforeach</select>'+
        '<small id="memberid_'+length+'_err" class="form-text text-muted"></small></div>'+

        '<div class="col-md-2 my-2">'+
        '<select class="form-control" name="getwayid[]"><option value="">Select</option>@foreach($getway as $data)<option value="{{$data["id"]}}">{{$data["name"]}}</option>@endforeach</select>'+
        '<small id="getwayid_'+length+'_err" class="form-text text-muted"></small></div>'+

        '<div class="col-md-2 my-2">'+
        '<input type="date" class="form-control" name="date[]"/>'+
        '<small id="date_'+length+'_err" class="form-text text-muted"></small></div>'+

        '<div class="col-md-2 my-2"><button type="button" class="btn btn-danger remove">X</button></div>'+

        '<div class="col-md-12 my-2"><hr></div>');

        $('button[type=submit]').css("display","block");
    });


    
    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      $.ajax({
        url : "{{url('/expenseInsert')}}",
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
              $("#"+prefix.replace(".","_")+"_err").text(values);
            })
          }else if(data.status == 3){

            $(".alert").show();
            $(".alert").css("display","block").html('<strong>Success!</strong> '+data.message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');

            $("#addRow").html("");
            $("#myForm")[0].reset();
            $("button[type=submit]").css("display","none");

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