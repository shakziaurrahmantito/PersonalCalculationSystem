@extends('Main.Main')
@section("title","Dashboard")
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


      @foreach($member as $memberData)

      <div class="col-md-4 my-2">
            <div class="card">
              <div class="card-body text-center">
                    <h5 class="m-0">{{$memberData['name']}}</h5>
                    <hr>

                    @php 
                      $creditAmount = 0;
                      $debitAmount = 0;
                    @endphp

                    @foreach($memberData->amount as $data)
                        @if($data['credit'] != null)
                          @php
                            $creditAmount += $data['credit'];
                          @endphp
                        @else
                          @php
                            $debitAmount += $data['debit'];
                          @endphp
                        @endif
                    @endforeach
                    <p class="mt-0 mb-0">Total Income: {{number_format($creditAmount)}} TK</p>
                    <p class="mt-0 mb-0">Total Expense: {{number_format($debitAmount)}} TK</p>
                    <hr>
              </div>
            </div>
      </div>
      @endforeach



  </div>  


   
    </div>
      </div>
    </div>
  </section>



  <script type="text/javascript">


    
    $("#myForm").submit(function(){

      var form = $("#myForm").get(0);

      $.ajax({
        url : "{{}}",
        method: "post",
        data : new FormData(form),
        contentType : false,
        processData : false,
        beforeSend : function(){
          $(document).find(".errror").text("");
        },
        success: function(data){

          if (data.status == 0) {
            $.each(data.message, function(prefix, values){
              $("#"+prefix+"_error").text(values);
            })
          }else{
            $("#myForm")[0].reset();
            $(".msg").css("display","block");
            $(".msg").text(data.message);
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