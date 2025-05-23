@extends('dashboard/master')
@section('title', 'All Properties')
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
                        <h1>All properties</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Property List</li>
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
                                            <th>Unit Number</th>
                                            <th>Street Number</th>
                                            <th>Street Name</th>
                                            <th>Suburb</th>
                                            <th>State</th>
                                            <th>Postcode</th>
                                            <th>Country</th>
                                            <th>Contract Start Date</th>
                                            <th>Contract End Date</th>
                                            <th>Action</th>
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
                ajax: "{{ route('properties.get') }}",
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
                { data: 'unit_number', name: 'unit_number' },
                { data: 'street_number', name: 'street_number' },
                { data: 'street_name', name: 'street_name' },
                { data: 'suburb', name: 'suburb' },
                { data: 'state_id', name: 'state_id' },
                { data: 'postcode', name: 'postcode' },
                { data: 'country_id', name: 'country_id' },
                { data: 'contract_start_date', name: 'contract_start_date' },
                { data: 'contract_end_date', name: 'contract_end_date' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,className: 'text-right', width: '30px'
                },
                ],
                search: {
                    smart: true,
                    regex: false,
                    caseInsensitive: true
                }
            });
        });
        // Function to view property details (if needed)
        // function viewPropertyDetails(id) {
        //     // Replace the alert with a real view property function
        //     alert('View Property Details for Property ID: ' + id);
        // }

        // Function to print property details
        function printPropertyDetails(id) {
            var url = 'trc/properties/print/' + id;  // Make sure the print URL matches the route for properties
            var printWindow = window.open(url, '_blank');  // Open in a new tab or window
            printWindow.focus();  // Focus on the print window
        }
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
