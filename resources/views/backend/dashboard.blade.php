<!-- Content Wrapper. Contains page content -->
@extends('layouts.admin_master')
@section('title','Dashboard')
@section('heading','Dashboard')
@section('nav','')
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
     <!-- Small boxes (Stat box) -->
     @if(Auth::user()->rank==1)
     <div class="row">
      @foreach($users as $user)
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <p style="text-align:center;">{{$user->name}}</p>
            </div>
            <a href="{{url('record/me/'.$user->id)}}" class="small-box-footer">View To Do List <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endforeach
        <!-- ./col -->
       
      </div>
      <!-- /.row -->
     @endif
      <!-- TO DO List -->
      <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">To Do List 
                <button class='btn btn-primary btn-sm' id="createRecord">Create</button>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <td>#</td>
                    <td>Date</td>
                    <td>Developer</td>
                    <td>Project</td>
                    <td>Description</td>
                    <td>Status</td>
                  </tr>
                </thead>
                <tbody>
                  @php($count=1)
                  @foreach($records as $rec) 
                  <tr>
                  <td>{{$count++}}</td>
                    <td>{{$rec->date}}</td>
                    <td>{{$rec->developer}}</td>
                    <td>{{$rec->project_title}}</td>
                    <td>{{$rec->description}}</td>
                    <td>
                      @if($rec->status=="Process")
                      <span class="text-primary">
                      @elseif($rec->status=="Done")
                      <span class="text-success">
                      @elseif($rec->status=="Error")
                      <span class="text-danger">
                      @elseif($rec->status=="Pending")
                      <span class="text-warning">
                      @endif
                      {{$rec->status}}
                      </span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
             
            </div>
            <!-- /.box-body -->
            
          </div>
          <!-- /.box -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

  <div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add New To Do List</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" id="createFrom" name="createFrom">
              <div class="box-body">
              <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Project</label>
                  <div class="col-sm-10">
                    <select name="project" id="" class="form-control">
                      <option value="">Select Project</option>
                      @foreach($project as $p)
                      <option value="{{$p->project}}">{{$p->project}}</option>
                      @endforeach
                    </select>
                    <input type="hidden" class="form-control" name="user_id" id="" value="{{Auth::user()->id}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea name="description" id="" class="form-control" cols="30" rows="10"></textarea>
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select name="status" id="" class="form-control">
                      <option value=""> Select Status</option>
                      <option value="Process">Process</option>
                      <option value="Done">Done</option>
                      <option value="Error">Error</option>
                      <option value="Error">Pending</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                <label for="" class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-10">
                    <input type="date" name="date" class="form-control" value="{{date('Y-m-d')}}">
                  </div>                             
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                  <button type="reset" class="btn btn-warning " id="cancel">Cancel <i class="fa fa-times"></i></button>
                  <button type="submit" class="btn btn-info " id="createBtn">Save <i class="fa fa-check"></i></button>
                  </div>                             
                </div>
                
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
@push('scripts')
  <script>
  $(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   
    $('body').on('click', '#createRecord', function () {
        $('#createModal').modal('show');
    });
   

    $('#createBtn').click(function (e) {
     
      e.preventDefault();
      $(this).html('Sending..');
      $.ajax({
        data: $('#createFrom').serialize(),
        url: "{{ url('record/create') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#createFrom').trigger("reset");
          $('#createModal').modal('hide');
          //table.draw();
          //document.getElementById('showmsg').innerHTML=data.success;
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
          $('#saveBtn').html('Save Error');
          
        }
      });
    });

  
  });
  
</script>
@endpush