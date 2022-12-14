<!-- Content Wrapper. Contains page content -->
@extends('layouts.admin_master')
@section('title','Project')
@section('heading','Project')
@section('nav','To Do List')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @php
        $url = Request::segment(3);
        $user= App\Models\User::find($url);
        @endphp
        @if($user)
        {{$user->name}}
        @endif
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
      <!-- <div class="callout callout-info animate__animated animate__slideInLeft" >
        <p>Alert Area</p>
      </div> -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
            
          </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <table class="table table-bordered table-striped table-hover" id="example" style="width:100%;">
                <thead>
                  <tr>
                    <td>#</td>
                    <td>Created</td>
                    <td>Developer</td>
                    <td>Project</td>
                    <td>Description</td>
                    <td>Date</td>
                    <td>Status</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
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
        <div class="modal-footer delete_foot" id="delete_foot">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline delete_confrim">Confirm Delete</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="ajaxModal">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit To Do Record</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" id="editForm" name="editForm">
              <div class="box-body">
              <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Project</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="project" id="project" value="" readonly>
                    <input type="hidden" class="form-control" name="id" id="id" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                  </div>
                </div>
               
                <div class="form-group">
                <label for="" class="col-sm-2 control-label">Status </label>
                  <div class="col-sm-10">
                    <div class="radio">
                      <label>
                        <input type="radio" name="status" id="Process" value="Process">
                        Process
                      </label>
                      <label>
                        <input type="radio" name="status" id="Done" value="Done">
                        Done
                      </label>
                      <label>
                        <input type="radio" name="status" id="Error" value="Error">
                        Error
                      </label>
                      <label>
                        <input type="radio" name="status" id="Pending" value="Pending">
                        Pending
                      </label>
                    </div> 
                    
                  </div>                             
                </div>
                <div class="form-group">
                <label for="" class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-10">
                    <input type="date" name="date" id="date" class="form-control">
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
        ajax: "{{ url('record/me/'.$url) }}",
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'created', name: 'created'},
            {data: 'developer', name: 'developer'},
            {data: 'project_title', name: 'project_title'},
            {data: 'description', name: 'description'},
            {data: 'date', name: 'date'},
            {data: 'status', name: 'status'},
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
      $('#delete_foot').on('click', '.delete_confrim', function(e){
          
            $.ajax({
                type: "GET",
                url: "{{ url('deleterecord') }}"+'/'+row_id,
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
    $('body').on('click', '.edit', function () {
      var user_id = $(this).data('id');
        $.get("{{ url('recorddetail') }}" +'/' + user_id, function (data) {
       
        $('#ajaxModal').modal('show');
        $('#id').val(data.id);
        $('#description').val(data.description);
        $('#date').val(data.date);
        $('#project').val(data.project_title);
        if(data.status=="Process"){
          
          $('#Process').attr("checked",'checked');
        }
        if(data.status=="Done"){
          $('#Done').attr("checked",'checked');
        }
        if(data.status=="Error"){
          $('#Error').attr("checked",'checked');
        }
        if(data.status=="Pending"){
          $('#Pending').attr("checked",'checked');
        }
       });
    });

    $('#saveBtn').click(function (e) {
      
      e.preventDefault();
      $.ajax({
        data: $('#editForm').serialize(),
        url: "{{ url('updaterecord') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#editForm').trigger("reset");
          $('#ajaxModal').modal('hide');
          table.draw();
          
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