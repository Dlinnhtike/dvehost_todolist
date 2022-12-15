<!-- Content Wrapper. Contains page content -->
@extends('layouts.admin_master')
@section('title','Project List')

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
      <!-- <div class="callout callout-info">
        <p>Alert Area</p>
      </div> -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <table class="table table-bordered table-hover table-striped table-dark" id="example">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Project Name</td>
                    <td>DeadLine</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @push('scripts')
  <script>
  $(function () {
    var table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('project/list') }}",
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'project', name: 'project'},
            {data: 'deadline', name: 'deadline'},
            {data: 'St', name: 'St'}
        ],
        aLengthMenu: [
            [30, 50, 100, -1],
            [30, 50, 100, "All"]
          ],
    });
  });
  
</script>
@endpush