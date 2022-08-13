@extends('Main.Main')
@section("title","Income list")
@section("content")

<div class="col-md-10">

    <div class="m-2 my-4">
      <div class="card my-2">
      <div class="card-body">

          <div style="overflow: hidden;">
            <h3 class="float-left">Income list</h3>
          </div>
          <hr>
            <table class="table">
              <tr>
                <th>#SL</th>
                <th>#Amount</th>
                <th>#Member</th>
                <th>#Getway</th>
                <th>#Prepare By</th>
                <th>#Sender Date</th>
                <th>#Action</th>

              @php
                $i = 1;
              @endphp
              <!-- For foreach -->

              @foreach($amount as $data)
                @if($data['credit'] != "")

                    <tr>
                      <td>{{$i++}}</td>
                      <td  id="credit_{{$data['id']}}">Tk. {{number_format($data['credit'])}}</td>
                      <td id="name_{{$data['id']}}">{{$data->member['name']}}</td>
                      <td id="getwayid_{{$data['id']}}">{{$data->paymentgetway['name']}}</td>
                      <td id="prepareby_{{$data['id']}}">{{$data->user['name']}}</td>
                      <td id="date_{{$data['id']}}">{{date("d-M-Y",strtotime($data['date']))}}</td>

                  @if(date("d-m-y", strtotime($data['created_at'])) == date("d-m-y"))
                      <td>
                        <button class="btn btn-primary" data-toggle="modal" value="{{$data['id']}}" id="updateid_{{$data['id']}}" onclick="updateToModel(this.value, this.id)" data-target="#updateModal"><i class="fa fa-edit"></i></button>
                      </td>
                  @else
                    <td>N/A</td>
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
            <input type="text" name="credit" value="" class="form-control" placeholder="Enter amount">
            <input type="hidden" name="id" value="">
            <small class="form-text text-muted" id="credit_err"></small>
          </div>

          <div class="form-group">
            <select class="form-control" name="memberid">
              <option value="">Select</option>
              @foreach($member as $data)
              <option value="{{$data['id']}}">{{$data["name"]}}</option>
              @endforeach
            </select>
            <small id="memberid_err" class="form-text text-muted"></small>
          </div>

          <div class="form-group">
            <select class="form-control" name="getwayid">
              <option value="">Select</option>
              @foreach($getway as $data)
              <option value="{{$data['id']}}">{{$data["name"]}}</option>
              @endforeach
            </select>

            <small id="getwayid_err" class="form-text text-muted"></small>
          </div>

          <div class="form-group">
            <input type="date" name="date" value="" class="form-control" placeholder="Date">
            <small class="form-text text-muted" id="date_err"></small>
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


  
    function updateToModel(value, id){
      $.ajax({
          url   : "{{url('/amountGetupdatedata')}}",
          data  : {
            id      : value
          },
          success : function(data){
            $("input[name=id]").val(data.message.id);
            $("input[name=credit]").val(data.message.credit);
            $("select[name=memberid]").val(data.message.memberid);
            $("select[name=getwayid]").val(data.message.getwayid);
            $("input[name=date]").val(data.message.date);
          }
      });
    }

    
    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      $.ajax({
        url : "{{url('/creditamountUpdate')}}",
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
          }else if(data.status == 3){
            $("#credit_"+data.message.id).text("Tk. "+data.message.credit);
            $("#name_"+data.message.id).text(data.member.name);
            $("#getwayid_"+data.message.id).text(data.getway.name);
            $("#prepareby_"+data.message.id).text(data.user.name);
            $("#date_"+data.message.id).text(data.senderdate);
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