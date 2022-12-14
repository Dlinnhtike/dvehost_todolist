<!-- Content Wrapper. Contains page content -->
@extends('layouts.admin_master')
@section('title','Setup')
@section('heading','Setup')
@section('nav','Project')
@section('content')
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
      <!-- <div class="callout callout-info animate__animated animate__slideInLeft" >
        <p>Alert Area</p>
      </div> -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
            <button class="btn btn-sm btn-primary" id="createProject">Create Project</button>
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
                    <td>Project Name</td>
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
  <div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create New Project</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" id="createFrom" name="createForm">
              <div class="box-body">
              <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Project Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="project" id="" placeholder="">
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
        <div class="modal-footer del_foot" id="">  
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal end -->
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
<div class="modal fade" id="ajaxModal">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Project</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" id="editForm" name="editForm">
              <div class="box-body">
              <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Project Name</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="projectname" id="projectname" value="">
                    <input type="hidden" class="form-control" name="id" id="id" value="">
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
        ajax: "{{ url('setup/project') }}",
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'project', name: 'project'},
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
                url: "{{ url('deleteproject') }}"+'/'+row_id,
                success: function (data) {
                table.draw();
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 5;
                toastr.success(data.success);
               
                $('#delModal').modal('hide');
                },
                error: function (data) {
                console.log('Error:', data);
                }
            });
        });
    });
    $('body').on('click', '#createProject', function () {
        $('#createModal').modal('show');
    });
    

    $('#createBtn').click(function (e) {
     
      e.preventDefault();
      
      $.ajax({
        data: $('#createFrom').serialize(),
        url: "{{ url('setup/save_project') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#createFrom').trigger("reset");
          $('#createModal').modal('hide');
          table.draw();
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
        
        }
      });
    });

    $('body').on('click', '.edit', function () {
      var id = $(this).data('id');
     
        $.get("{{ url('projectdetail') }}" +'/' + id, function (data) {
          
        $('#ajaxModal').modal('show');
          $('#id').val(data.id);
          $('#projectname').val(data.project);
        });
       });
      
      $('#saveBtn').click(function (e) {
      e.preventDefault();
      $.ajax({
        data: $('#editForm').serialize(),
        url: "{{ url('updateproject') }}",
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