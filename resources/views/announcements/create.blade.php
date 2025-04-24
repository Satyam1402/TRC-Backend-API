@extends('dashboard/master')
@section('title', 'Add New Announcement')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1>Add New Utility</h1> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            {{-- <li class="breadcrumb-item ">B</li> --}}
                            <li class="breadcrumb-item active">Add Announcement</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Announcement </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                   <!-- Image -->
                                    <div class="form-group">
                                        <label for="image">Image (Optional)</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>

                                    <!-- Text -->
                                    <div class="form-group">
                                        <label for="text">Announcement Text</label>
                                        <textarea class="form-control" id="text" name="text" placeholder="Enter announcement text" required></textarea>
                                    </div>

                                    <!-- Link -->
                                    <div class="form-group">
                                        <label for="link">Link (Optional)</label>
                                        <input type="url" class="form-control" id="link" name="link" placeholder="https://example.com">
                                    </div>

                                    <!-- Status -->
                                    {{-- <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="" disabled selected>Select status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div> --}}

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-success">Add Announcement</button>

                                    <!-- Back Button -->
                                    <a href="{{ route('announcements.index') }}" class="btn btn-primary" style="margin-left: 10px;">
                                        Back
                                    </a>
                                </form>
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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


@endsection
@section('ajax')

@endsection
