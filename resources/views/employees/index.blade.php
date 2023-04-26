<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
      <!-- datatable css and js files starts -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css')}}" />
      <script src="{{ asset('js/jquery.min.js') }}"></script>
      <script src="{{ asset('js/dataTables.min.js')}}"></script>
      <script src="{{ asset('js/dataTables.bootstrap5.min.js')}}"></script>
      <!-- Scripts -->

    <title>Document</title>
</head>
<body>
    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Add Employee
        </button>
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-success d-none" role="alert"> </div>
                <div class="alert alert-danger d-none">
                    <ul>
                       
                    </ul>
                </div>

                <table class="table table-responsive table-bordered" id="table_id">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th  style="width:20%">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

               
            </div>
        </div>

       
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Add Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">
                <form method="post" id="form_id">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username" name="username">
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter your phone number" name="phone">

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">

                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                        <option value="" selected disabled>Select Gender </option>
                        <option value="male" >Male</option>
                        <option value="female">Female</option>
                        
                        </select>
                    </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal" id="btn_id" >Submit</button>
                </div>

                </div>
            </div>
        </div>
        <div class="modal" id="edit-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">
                <form method="post" id="form_id">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="editUsername" placeholder="Enter your username" name="username">
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="editPhone" placeholder="Enter your phone number" name="phone">

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="editEmail" placeholder="name@example.com" name="email">

                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="editGender" name="gender">
                        <option value="" selected disabled>Select Gender </option>
                        <option value="male" >Male</option>
                        <option value="female">Female</option>
                        
                        </select>
                    </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal" id="btn_update" data-id="" >Update</button>
                </div>

                </div>
            </div>
        </div>
    </div>    
</body>
</html>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        master_list();
        function master_list() {
           
            $("#table_id").DataTable().clear().destroy();
            $('#table_id').DataTable({
                "processing": true,
                "lengthChange": false,
                "serverSide": true,
                "paging": true,
                "searching": true,
                "scrollX": false,
                "pageLength": 10,
                "ordering": true,
                "bAutoWidth": false,
                "lengthChange": false,
                "language": {
                    search: "",
                    searchPlaceholder: "Search..."
                },
                "order": [
                    [0, "desc"]
                ],
                "ajax": {
                    "url": "{{ route('show') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{csrf_token()}}",
                    
                    },
                    "dataType": "json",
                },
                'columnDefs': [{
                    'targets': [0,3,4,5],
                    'orderable': false,
                }],
                "columns": [{
                        data: "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        data: "username",
                        render: function(data, type, row, meta) {
                            return ((row.username) ? row.username : "NA")
                        }
                    },
                   
                    {
                        data: "email",
                        render: function(data, type, row, meta) {
                            return ((row.email) ? row.email : "NA")
                        }
                    },
                    {
                        data: "phone",
                        render: function(data, type, row, meta) {
                            return ((row.phone) ? row.phone : "NA")
                        }
                    },
                    {
                        data: "gender",
                        render: function(data, type, row, meta) {
                            return ((row.gender) ? row.gender : "NA")
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-primary btn-edit" data-id="' + data.id + '" >Edit</button>' +
                                '<button class="btn btn-danger btn-delete" data-id="' + data.id + '" >Delete</button>';
                        }
                    },
                    
                    
                ],
                
            });
        }

        $(document).on('click','#btn_id',function(e) {
          
            e.preventDefault();
            let username = $('#username').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let gender = $('#gender').val();
        
            $.ajax({
                url: "{{route('store')}}", 
                type: "POST",
                dataType: "json",
                data: { username: username,
                        email: email,
                        phone:phone,
                        gender:gender,
                        _token: "{{csrf_token()}}", 
                    },
                    success: function (result) {
                        master_list();
                        $('#username').val("");
                        $('#email').val("");
                        $('#phone').val("");
                        $('#gender').val("")
                        $(".alert-success").removeClass("d-none");

                        $(".alert-success").html(result.message);
                        $( setTimeout(function () {
                            $(".alert-success").addClass("d-none");

                        }, 3000));
                        
                    },
                    error: function (err) {
                        master_list();
                        $('#username').val("");
                        $('#email').val("");
                        $('#phone').val("");
                        $('#gender').val("");
                        if (err.responseJSON.errors) {
                            $(".alert-danger").removeClass("d-none");
                            $.each(err.responseJSON.errors, function(key, value) {
                                
                                $('.alert-danger ul').append('<li>'+ value + '</li>');
                            });
                            $( setTimeout(function () {
                                $(".alert-danger").addClass("d-none");
                                $('.alert-danger ul li').remove()

                            }, 3000));
                        }
                        
                        
                       
                    }
            });

        });

        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '{{ route("delete",':id') }}'.replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        master_list();
                        if (response.success) {
                            $(".alert-success").removeClass("d-none");

                            $(".alert-success").html(response.message);
                            $( setTimeout(function () {
                                $(".alert-success").addClass("d-none");

                            }, 3000));

                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        master_list();
                        if (xhr.responseJSON.errors) {
                            $(".alert-danger").removeClass("d-none");
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                
                                $('.alert-danger ul').append('<li>'+ value + '</li>');
                            });
                            $( setTimeout(function () {
                                $(".alert-danger").addClass("d-none");

                            }, 3000));
                        }
                    }
                });
            }
        });

        $(document).on('click', '.btn-edit', function () {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("edit",':id') }}'.replace(':id', id), 
                type: "POST",
                dataType: "json",
                data: { 
                        _token: "{{csrf_token()}}", 
                    },
                success: function (result) {
                
                    $('#editUsername').val(result.username);
                    $('#editEmail').val(result.email);
                    $('#editPhone').val(result.phone);
                    $('#editGender').val(result.gender);
                    $('#btn_update').data('id',result.id);
                    $('#edit-modal').modal('show');
                }
            })
        });

        $(document).on('click','#btn_update',function(e) {
            var id = $(this).data('id');
            e.preventDefault();
            let username = $('#editUsername').val();
            let email = $('#editEmail').val();
            let phone = $('#editPhone').val();
            let gender = $('#editGender').val();
            console.log("here")
        
            $.ajax({
                url: '{{ route("update",':id') }}'.replace(':id', id), 
                type: "POST",
                dataType: "json",
                data: { username: username,
                        email: email,
                        phone:phone,
                        gender:gender,
                        _token: "{{csrf_token()}}", 
                    },
                    success: function (result) {
                        master_list();
                        $('#username').val("");
                        $('#email').val("");
                        $('#phone').val("");
                        $('#gender').val("")
                        $(".alert-success").removeClass("d-none");

                        $(".alert-success").html(result.message);
                        $( setTimeout(function () {
                            $(".alert-success").addClass("d-none");

                        }, 3000));
                        
                    },
                    error: function (err) {
                        master_list();
                        $('#username').val("");
                        $('#email').val("");
                        $('#phone').val("");
                        $('#gender').val("");
                        if (err.responseJSON.errors) {
                            $(".alert-danger").removeClass("d-none");
                            $.each(err.responseJSON.errors, function(key, value) {
                                
                                $('.alert-danger ul').append('<li>'+ value + '</li>');
                            });
                            $( setTimeout(function () {
                                $(".alert-danger").addClass("d-none");

                            }, 3000));
                        }
                    }
            });

        });


    });



</script>