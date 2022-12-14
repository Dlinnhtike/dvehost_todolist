<!-- Content Wrapper. Contains page content -->
@extends('layouts.admin_master')
@section('title','Setup')
@section('heading','Setup')
@section('nav','Users')
@section('content')
<style>
    #alert_area{
        display:none;
    }
   
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      @yield('heading')
        <small>@yield('nav')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> @yield('heading')</a></li>
        <li class="active"> @yield('nav')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info" id="alert_area">
        
        <p id="showmsg"></p>
        
      </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">User List
            <button class="btn btn-sm btn-success" id="createUser">Create User</button>
            <!-- <a class="btn btn-danger float-end" href="{{ url('export') }}">Export Excel </a> -->
          </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="example">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Full Name</td>
                    <td>Login Name</td>
                    <td>Email</td>
                    <td>Rank</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- /.content-wrapper -->
<div class="modal modal-danger fade" id="delModal">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
        <p>Are you sure you wnat to DELETE!&hellip;</p>
        </div>
        <div class="modal-footer del_foot" id="del_foot">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline delete_confrim">Confirm Delete</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal end -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create New User</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" id="createFrom" name="createForm">
              <div class="box-body">
              <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="" placeholder="Full Name">
                  </div>
                </div>
				      <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="phone" class="form-control" name="phone" id="" placeholder="phone">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                <label for="" class="col-sm-2 control-label">Login Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" id="" placeholder="Login Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" id="" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="confirm-password" id="" placeholder="Confirm Password">
                  </div>
                </div>
                <div class="form-group">
                <label for="" class="col-sm-2 control-label">User Rank</label>
                  <div class="col-sm-10">
                    <div class="radio">
                      <label>
                        <input type="radio" name="rank" id="" value="1" required>
                        Administrator
                      </label>
                    </div> 
                    <div class="radio">
                      <label>
                        <input type="radio" name="rank" id="" value="2">
                        User
                      </label>
                    </div> 
                  </div>                             
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="createBtn">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
        </div>
        <div class="modal-footer del_foot" id="del_foot">
        <button type="button" class="btn pull-left" data-dismiss="modal">Close</button>
                
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal end -->
<div class="modal fade" id="ajaxModal">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" id="editForm" name="editForm">
              <div class="box-body">
              <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    <input type="hidden" class="form-control" name="user_id" id="user_id">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Login Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Login Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" id="" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                <label for="" class="col-sm-2 control-label">User Rank</label>
                  <div class="col-sm-10">
                    <div class="radio">
                      <label>
                        <input type="radio" name="rank" id="admin" value="1" required>
                        Administrator
                      </label>
                    </div> 
                    <div class="radio">
                      <label>
                        <input type="radio" name="rank" id="user" value="2">
                        User
                      </label>
                    </div> 
                  </div>                             
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="saveBtn">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
        </div>
        <div class="modal-footer del_foot" id="del_foot">
        <button type="button" class="btn pull-left" data-dismiss="modal">Close</button>
                
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal end -->
  @endsection
  @push('scripts')
  <script>
  $(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('setup/users') }}",
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'rank', name: 'rank'},
           
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        aLengthMenu: [
            [30, 50, 100, -1],
            [30, 50, 100, "All"]
          ],
    });

    $('body').on('click', '.delete', function () {
        var row_id = $(this).data("id");
      //if(!confirm('Are You sure want to delete !'+club_id)) return;
      $('#delModal').modal('show');
      $('#del_foot').on('click', '.delete_confrim', function(e){
          //window.location = 'delete_emp/' + id;
            $.ajax({
                type: "GET",
                url: "{{ url('deleteuser') }}"+'/'+row_id,
                success: function (data) {
                table.draw();
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 5;
                toastr.success(data.success);
               
                $('#delModal').modal('hide');
                document.getElementById('showmsg').innerHTML=data.success;
                //alert(data.success);
                $('#alert_area').show('slow');
                
                },
                error: function (data) {
                console.log('Error:', data);
                }
            });
        });
    });
    $('body').on('click', '#createUser', function () {
        $('#createModal').modal('show');
    });
    $('body').on('click', '.edit', function () {
      var user_id = $(this).data('id');
      //alert(user_id);
        $.get("{{ url('getuserdetail') }}" +'/' + user_id, function (data) {
       
        $('#ajaxModal').modal('show');
        $('#user_id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#username').val(data.username);
        if(data.rank==1){
          
          $('#admin').attr("checked",'checked');
        }
        if(data.rank==2){
          $('#user').attr("checked",'checked');
        }
       });
    });

    $('#createBtn').click(function (e) {
     
      e.preventDefault();
      $(this).html('Sending..');
      $.ajax({
        data: $('#createFrom').serialize(),
        url: "{{ url('setup/create_user') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#createFrom').trigger("reset");
          $('#createModal').modal('hide');
          table.draw();
          document.getElementById('showmsg').innerHTML=data.success;
                //alert(data.success);
                //$('#alert_area').show('slow');
                toastr.success(data.success);
        },
        error: function (data) {
          if (data.status == 422) { 
            $.each(data.responseJSON.errors, function(key, value){
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 5;
              toastr.error(value);
            });
          }
          console.log('Error:', data);
          $('#saveBtn').html('Save Error');
          
        }
      });
    });

    $('#saveBtn').click(function (e) {
      
      e.preventDefault();
      $.ajax({
        data: $('#editForm').serialize(),
        url: "{{ url('update') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#editForm').trigger("reset");
          $('#ajaxModal').modal('hide');
          table.draw();
          document.getElementById('showmsg').innerHTML=data.success;
                //alert(data.success);
                //$('#alert_area').show('slow');
                toastr.success(data.success);
                $('#saveBtn').html('Save');
        },
        error: function (data) {
          if (data.status == 422) { 
            $.each(data.responseJSON.errors, function(key, value){
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 5;
              toastr.error(value);
            });
          }
          console.log('Error:', data);
         
          
        }
      });
    });
  });
  
</script>
@endpush