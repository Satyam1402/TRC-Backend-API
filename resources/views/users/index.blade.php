@extends('dashboard/master')
@section('title', 'All Users')
@section('css')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">All Users</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <a href="{{ route('daily_reports.add') }}" class="btn btn-primary">+ Create a new user</a> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="data-table" class="table table-bordered table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            {{-- <th>Status</th> --}}
                                            <th style="text-align: right;">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.get') }}",
                pageLength: 15,
                lengthMenu: [
                    [15, 30, 50, 100, 500, -1],
                    [15, 30, 50, 100, 500, "All"]
                ],
                order: [
                    [0, 'desc']
                ],
                columns: [

                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,className: 'text-right', width: '200px'
                },
                ],
                search: {
                    smart: true,
                    regex: false,
                    caseInsensitive: true
                }
            });
        });
            // function viewUserDetails(id) {
            //     // Your existing function to view properties
            //     alert('View Properties of User ID: ' + id);
            // }

            function printUserDetails(id) {
                var url = 'trc/users/print/' + id; // Update the URL if needed
                var printWindow = window.open(url, '_blank');
                printWindow.focus();
            }
            // function printUserDetails(id) {
            //     var url = '/users/print/' + id; // Update the URL if needed
            //     window.location.href = url;  // This will navigate to the print page in the same tab
            // }
    </script>
@endsection


@section('ajax')
    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel it'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>


@endsection

  {{-- <script>
        $(document).ready(function() {
             var table = $('#data-table').DataTable({  //assign the datatable to a variable
                 responsive: true,
                 processing: true,
                 serverSide: true,
                 ajax: "{{ route('users.get') }}",
                 pageLength: 15,
                 lengthMenu: [
                     [15, 30, 50, 100, 500, -1],
                     [15, 30, 50, 100, 500, "All"]
                 ],
                 order: [
                     [0, 'desc']
                 ],
                 columns: [
                     { data: 'id', name: 'id' },
                     { data: 'first_name', name: 'first_name' },
                     { data: 'last_name', name: 'last_name' },
                     { data: 'email', name: 'email' },
                     { data: 'phone', name: 'phone' },
                     {
                         data: 'status',
                         name: 'status',
                         orderable: false,
                         searchable: false,
                         className: 'text-center',
                         width: '100px'
                     },
                     {
                         data: 'action',
                         name: 'action',
                         orderable: false,
                         searchable: false,
                         className: 'text-right',
                         width: '120px'
                     },
                 ],
                 search: {
                     smart: true,
                     regex: false,
                     caseInsensitive: true
                 }
             });

             //  Move this inside document ready
             $(document).on('click', '.toggle-status', function(){
                 var user_id = $(this).data('id');

                 $.ajax({
                     url: "{{ route('users.toggleStatus') }}",
                     type: 'POST',
                     data: {
                         _token: '{{ csrf_token() }}',
                         id: user_id,
                     },
                     beforeSend: function() {
                         Swal.fire({
                             title: 'Please Wait...',
                             allowOutsideClick: false,
                             didOpen: () => {
                                 Swal.showLoading()
                             }
                         });
                     },
                     success: function(response){
                         table.ajax.reload(null, false); //now table is defined
                         Swal.fire('Success!', response.message, 'success');
                     },
                     error: function(){
                         Swal.fire('Error!', 'Something went wrong.', 'error');
                     }
                 });
             });

         });
    </script> --}}
