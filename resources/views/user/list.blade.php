@extends('adminlte::page')

@section('title', 'Developers')

@section('content_header')
    <h1>Developers</h1>
@stop

@section('content')
    <!-- <p>Welcome to this beautiful admin panel.</p> -->
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Developer List </h3><br>
                <button type="button" id="newDeveloper" class="btn btn-success" data-toggle="modal" data-target="#myAdd">New</button>
                <button type="button" id="bulkDeleteDeveloper" class="btn btn-danger" data-dismiss="modal">Delete</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Avatar</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th><center>Action</center></th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($users as $user)
                  <tr>
                    <td width="5%"><input type="checkbox" name="check" class="deleteCheckBox" value="{{$user->id}}"></td>
                    <td width="20%"><img src="{{$user->avatar}}" width="50px"></td>
                    <td width="20%">{{$user->first_name}}</td>
                    <td width="20%">{{$user->last_name}}</td>
                    <td width="20%">{{$user->email}}</td>
                    <td width="10%">{{$user->phone_number}}</td>
                    <td width="10%" align="center"> 
                        <a href="#" class="fa fa-user fa-sm setStatus" role="button" data-toggle="modal" data-target="#myEdit" data-id="{{$user->id}}" data-first_name="{{$user->first_name}}" data-email="{{$user->email}}" data-phone_number="{{$user->phone_number}}" data-last_name="{{$user->last_name}}" data-avatar="{{$user->avatar}}" style="font-size: 1.2rem;">
                        </a>
                        <a href="/developer/destroy/{{$user->id}}" class="fa fa-trash-alt fa-sm" title="Remove" onclick="return confirm('You are going to delete {{$user->first_name}}. Confirm?')" role="button" style="font-size: 1.2rem;"></a>
                    
                    </td>
                  </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th></th>
                    <th>Avatar</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th><center>Action</center></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



    <!-- Modal -->
    <div id="myEdit" class="modal fade" role="dialog" style="display:none">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Developer</h4>
                    <div class="alert alert-success alert-dismissable" style="display:none">
                        <p>Success! </p>
                    </div>
                    <br/>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                
                <form action="/developer/update" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <input type="hidden" id="id_hidden" name="id_hidden">
                        <div class="form-group col-md-12">
                            <label for="new_avatar">Avatar</label><br>
                            <img id="display_avatar" src="" width="100px">
                            <input type="file" class="form-control" id="avatar" name="avatar" value="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="first_name">First Name</label><br>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="" required>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="last_name">Last Name</label><br>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="" required>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="email">Email</label><br>
                            <input type="email" class="form-control" id="email" name="email" value="" readonly>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="phone_number">Phone Number</label><br>
                            <input type="number" class="form-control" id="phone_number" name="phone_number" value="">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="submitStatus" class="btn btn-success" data-dismiss="modal">Update</button> -->
                <button type="submit" id="updateDeveloperOFF" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
                </form>
            </div>

        </div>
    </div>

    
    <!-- Modal -->
    <div id="myAdd" class="modal fade" role="dialog" style="display:none">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Developer</h4>
                    <div class="alert alert-success alert-dismissable" style="display:none">
                        <p>Success! </p>
                    </div>
                    <br/>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/developer/insert" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" id="id_hidden" name="id_hidden">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="new_avatar">Avatar</label><br>
                        <input type="file" class="form-control" id="new_avatar" name="new_avatar" value="" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="first_name">First Name</label><br>
                        <input type="text" class="form-control" id="new_first_name" name="new_first_name" value="" required>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="last_name">Last Name</label><br>
                        <input type="text" class="form-control" id="new_last_name" name="new_last_name" value="" required>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="email">Email</label><br>
                        <input type="email" class="form-control" id="new_email" name="new_email" value="" required>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="phone_number">Phone Number</label><br>
                        <input type="number" class="form-control" id="new_phone_number" name="new_phone_number" value="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="submitStatus" class="btn btn-success" data-dismiss="modal">Update</button> -->
                <button type="submit" id="insertDeveloperOFF" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    
    <script>

        $('#updateDeveloper').on("click", function(){
            var envVal = '{{ env('SERVER_URL') }}';
            // alert(envVal);
            var dataId = $('#id_hidden').val();
            var dataFN = $('#first_name').val();
            var dataLN = $('#last_name').val();
            var dataPN = $('#phone_number').val();
            // var dataUserId = $('#user_id').val();

            // alert('Test '+ dataId + " user id " + dataUserId);
        
            var custom_url = envVal+"developer/update?id="+dataId+"&first_name="+dataFN+"&last_name="+dataLN+"&phone_number="+dataPN;
            // var custom_url = "/csms-vtwo/public/customer_service/tickets/assign?id="+dataId+"&assign="+dataUserId;
            console.log(custom_url);
            // return false;
            $.ajax({url: custom_url, success: function(result){
                // $("#div1").html(result);
                var jsonData = JSON.parse(result);
                // if(jsonData.status==1){
                //     $('#status-span-'+dataId).removeClass( "badge-danger" ).addClass( "badge-success" );
                // }else{
                //     $('#status-span-'+dataId).removeClass( "badge-success" ).addClass( "badge-danger" );
                // }
                // $('#status-span-'+dataId).html(jsonData.statusname);
                // alert(jsonData.assignname);
                // alert('test -> '+jsonData.cost_amount);
                // $('.alert-success').show();
                // var sale_amount_edit_id = $('input[name="sale_amount_edit"]').attr('id');  
                // $("#"+sale_amount_edit_id).val(jsonData.sale_amount);
                location.reload();
            }});
        });

        $('.setStatus').on("click", function(){
            var dataId = $(this).attr("data-id");
            var dataFirstName = $(this).attr("data-first_name");
            var dataLastName = $(this).attr("data-last_name");
            var dataEmail = $(this).attr("data-email");
            var dataPhoneNumber = $(this).attr("data-phone_number");
            var dataAvatar = $(this).attr("data-avatar");
            
            $('#id_hidden').val(dataId);
            $('#first_name').val(dataFirstName);
            $('#last_name').val(dataLastName);
            $('#email').val(dataEmail);
            $('#phone_number').val(dataPhoneNumber);
            $("#display_avatar").attr("src",dataAvatar);

        });


        $('#insertDeveloper').on("click", function(){
            var envVal = '{{ env('SERVER_URL') }}';
            
            var dataId = 0;
            var dataFN = $('#new_first_name').val();
            var dataLN = $('#new_last_name').val();
            var dataPN = $('#new_phone_number').val();
            var dataEmail = $('#new_email').val();
        
            var custom_url = envVal+"developer/insert?id="+dataId+"&first_name="+dataFN+"&last_name="+dataLN+"&phone_number="+dataPN+"&email="+dataEmail;
            
            console.log(custom_url);
            
            $.ajax({url: custom_url, success: function(result){
                
                var jsonData = JSON.parse(result);
                location.reload();
            }});
        });

        
        $('#bulkDeleteDeveloper').on("click", function(){
            var envVal = '{{ env('SERVER_URL') }}';
            
            // $(".deleteCheckBox").find('[value=' + values.join('], [value=') + ']').prop("checked", true);

            
              var arr = [];
              $.each($("input[name='check']:checked"), function(){
                  arr.push($(this).val());
              });

              var delete_check_box = arr.join("|");
              if(delete_check_box==""){
                alert("No records selected");
              }else{
                alert("Your favourite programming languages are: " + delete_check_box);
                    
                var custom_url = envVal+"developer/bulkDelete?delete_check_box_value="+delete_check_box;
                
                $.ajax({url: custom_url, success: function(result){
                    
                    var jsonData = JSON.parse(result);
                    location.reload();
                }});
              }
            
        });

    </script>
@stop
