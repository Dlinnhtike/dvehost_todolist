
        <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
   
</head>
<body>
        <h1>Information For Dev</h1>
<table class="table table-bordered" id="example">
    <thead>
    <tr>
        <td>#</td>
        <td>Name</td>
        <td>Email</td>
        <td>Rank</td>
        <td>User Type</td>
        <td>User</td>
        <td>Action</td>
    </tr>
</thead>
<tbody>
   
</tbody>
</table>
</body>
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
<script>
  $(function () {
    var table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('information') }}",
        
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'rank', name: 'rank'},
            {data: 'user_type', name: 'User Type'},
            {data: 'user', name: 'user', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        aLengthMenu: [
            [30, 50, 100, -1],
            [30, 50, 100, "All"]
          ],
    });
    $('body').on('click', '.deleteClub', function () {
        var row_id = $(this).data("id");
      //if(!confirm('Are You sure want to delete !'+club_id)) return;
      $('#delModal').modal('show');
      $('#del_foot').on('click', '.delete_confrim', function(e){
          //window.location = 'delete_emp/' + id;
            $.ajax({
                type: "GET",
                url: "{{ url('delete') }}"+'/'+row_id,
                success: function (data) {
                table.draw();
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 5;
                toastr.success(data.success);
               
                $('#delModal').modal('hide');
                alert(data.success);
                },
                error: function (data) {
                console.log('Error:', data);
                }
            });
        });
    });
  });
  
</script>

<html>

        




    
