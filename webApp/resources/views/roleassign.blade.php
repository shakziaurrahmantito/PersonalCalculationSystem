@extends('Main.Main')
@section("title","Role Assign")
@section("content")

<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">
          <div style="overflow: hidden;">
            <h3 class="float-left">Add Assign</h3>
            <!-- <button type="button" class="btn btn-primary float-right" id="addNew">Add New</button> -->
          </div>
          <hr>

        <form method="post" id="myForm">
          @csrf

          <div class="alert alert-warning alert-dismissible fade show" style="display:none" role="alert"></div>

            <div class="form-row">
              <div class="col-md-12 my-2">

               <select name="role_assign" id="role_assign" class="form-control">
                 <option value="">Select Role</option>
                @foreach($role as $data)
                <option value="{{$data['id']}}">{{$data['name']}}</option>
                @endforeach
              </select>

              <small id="role_assign_err" class="form-text text-muted"></small>

              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 my-2">

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="role_option[]" id="status_edit" value="edit">
                  <label class="form-check-label" for="status_edit">Edit</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="role_option[]" id="status_delete" value="delete">
                  <label class="form-check-label" for="status_delete">Delete</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="role_option[]" id="status_status" value="status">
                  <label class="form-check-label" for="status_status">Status</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="role_option[]" id="status_print" value="print">
                  <label class="form-check-label" for="status_print">Print</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="role_option[]" id="status_adminarea" value="adminarea">
                  <label class="form-check-label" for="status_adminarea">Admin Area</label>
                </div>

                <small id="role_option_err" class="form-text text-muted"></small>


              </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Save</button>
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

    $("#role_assign").change(function(){

      var roleid = $("#role_assign").val();
      
      $.ajax({
        url : "{{url('/getRoleassingdata')}}",
        data :{
          roleid : roleid
        },
        beforeSend : function(){
          $(document).find(".form-text").text("");
        },
        success: function(data){
          $(".alert").css("display","none");
          $("input[type=checkbox]:checked").prop("checked",false);
          $.each(data.message, function(prefix, values){
            $("input[value="+values.name+"]").prop("checked",true);
          });
        }
      });
      return false;
    });



    
    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      $.ajax({
        url : "{{url('/roleassingInsert')}}",
        method: "post",
        data : new FormData(form),
        contentType : false,
        processData : false,
        beforeSend : function(){
          $(document).find(".form-text").text("");
        },
        success: function(data){
          $(".alert").css("display","none");
          if (data.status == 0) {
            $.each(data.message, function(prefix, values){
              $("#role_assign_err").text(values);
            });
          }else if(data.status == 1){
             $(".alert").css("display","block").text(data.message);
          }else{
            alert("Ops! Something wrong...");
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