@extends('Main.Main')
@section("title","User List")
@section("content")

<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">

          <div style="overflow: hidden;">
            <h3 class="float-left">User list</h3>
          </div>
          <hr>
            <table class="table">
              <tr>
                <th>#SL</th>
                <th>#Name</th>
                <th>#Phone</th>
                <th>#Role</th>

              @if(in_array("status", $roleAssData))
                <th>#Status</th>
              @endif


              @if(in_array("edit", $roleAssData) || in_array("delete", $roleAssData))
                <th>#Action</th>
              @endif

              </tr>
              @php
                $i = 1;
              @endphp

              <!-- For foreach -->
              @foreach($user as $data)

                @if($userid != $data['id'])

                  <tr>
                    <td>{{$i++}}</td>
                    <td id="name_{{$data['id']}}">{{$data['name']}}</td>
                    <td id="phone_{{$data['id']}}">{{$data['phone']}}</td>
                    <td id="role_{{$data['id']}}">{{$data->role['name']}}</td>

                  <!-- For Role assign -->
                  @if(in_array("status", $roleAssData))
                    <td>

                      @if($data['status'] == 1)
                        <button type="button" onclick="activedeactive(this.value, {{$data['id']}})" value="{{$data['status']}}" class="btn btn-info" id="status_{{$data['id']}}">Active</button>
                      @else
                        <button type="button" onclick="activedeactive(this.value, {{$data['id']}})" value="{{$data['status']}}" class="btn btn-danger" id="status_{{$data['id']}}">Deactive</button>
                      @endif

                    </td>
                  @endif

                  @if(in_array("edit", $roleAssData) || in_array("delete", $roleAssData))
                    <td>

                      @if(in_array("edit", $roleAssData))
                          <button class="btn btn-primary" data-toggle="modal" value="{{$data['id']}}" id="updateid_{{$data['id']}}" onclick="updateToModel(this.value, this.id)" data-target="#updateModal"><i class="fa fa-edit"></i></button>
                      @endif

                      @if(in_array("delete", $roleAssData))
                        <button type="button" class="btn btn-danger" data-toggle="modal" value="{{$data['id']}}" id="delid_{{$data['id']}}" onclick="deleteToModel(this.value, this.id)" data-target="#myModal">
                         <i class="fa fa-trash"></i>
                        </button>
                      @endif

                    </td>
                  @endif

                  </tr>
                  @endif
              @endforeach
              <!-- foreach -->
            </table>
          </div>
      </div>
        </div>

      </div>
    </div>
      </div>
    </div>
  </section>


<!-- The Modal For Delete-->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
<!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Are you sure?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <!-- <div class="modal-body">
        Modal body..
      </div> -->
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="deleteById(this.value)" id="del_ok">Ok</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- The Modal For Update-->
<div class="modal fade" id="updateModal">
  <div class="modal-dialog">
    <div class="modal-content">
<!-- Modal Header -->
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form id="myForm">
        @csrf
      <div class="modal-body">
          <div class="form-group">
            <input type="text" name="name" value="" class="form-control" placeholder="Name">
            <input type="hidden" name="id" value="">
            <small class="form-text text-muted" id="name_err"></small>
          </div>

          <div class="form-group">
            <input type="text" name="phone" value="" class="form-control" placeholder="Phone">
            <small class="form-text text-muted" id="phone_err"></small>
          </div>

          <div class="form-group">
            <select class="form-control" name="roleid">
              <option value="">Select</option>
              @foreach($role as $data)
                <option value="{{$data['id']}}">{{$data['name']}}</option>
              @endforeach
            </select>
            <small class="form-text text-muted" id="roleid_err"></small>
          </div>

        
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>



  <script type="text/javascript">


    function deleteToModel(value, id){
      $("#del_ok").val(value);
    }

    function updateToModel(value, id){
      $.ajax({
          url   : "{{url('/userGetupdatedata')}}",
          data  : {
            id      : value
          },
          success : function(data){
            $("input[name=id]").val(data.message.id);
            $("input[name=name]").val(data.message.name);
            $("input[name=phone]").val(data.message.phone);
            $("select[name=roleid]").val(data.message.roleid);
          }
      });
    }


    function deleteById(id){
      $("#myModal").modal('hide');
      $("#delid_"+id).parent().parent().remove();

      $.ajax({
          url   : "{{url('/userDelete')}}",
          data  : {
            id      : id
          } 
      });
    }



    function activedeactive(value, id){

        if (value == 1) {
          $("#status_"+id).removeClass("btn-info").addClass("btn-danger").text("Deactive").val(0);

          var id = id;
          $.ajax({
            url   : "{{url('/userAction')}}",
            data  : {
              id      : id,
              getVal  : 0
            } 
          });
 
        }else{

          $("#status_"+id).removeClass("btn-danger").addClass("btn-info").text("Active").val(1);
          var id = id;
          $.ajax({
            url   : "{{url('/userAction')}}",
            data  : {
              id      : id,
              getVal  : 1
            } 
          });

        }

    }


    
    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      $.ajax({
        url : "{{url('/userUpdate')}}",
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
            $("#name_"+data.message.id).text(data.message.name);
            $("#phone_"+data.message.id).text(data.message.phone);
            $("#role_"+data.message.id).text(data.role.name);
            $("#updateModal").modal('hide');
            
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