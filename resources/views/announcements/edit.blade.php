@extends('dashboard/master')
@section('title', 'Edit Announcement')
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
                            <li class="breadcrumb-item active">Edit Announcement</li>
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
                                <h3 class="card-title">Edit Announcement </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Image -->
                                    <div class="form-group">
                                        <label for="image">Image:</label>
                                        @if ($announcement->image)
                                        <div>
                                            <img id="preview-image"
                                                src="{{ url('storage/app/public/' . $announcement->image) }}"
                                                alt="{{ $announcement->image }}"
                                                style="max-width: 200px; max-height: 200px; border-radius:10px;">
                                        </div>
                                        @endif
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image"
                                                    name="image" accept="image/*" onchange="displayImage(this); updateFileName()">
                                                <label class="custom-file-label" for="image" id='image_change'>{{ !empty($announcement->image) ? env('APP_URL') . '/' . $announcement->image : 'Choose file' }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text -->
                                    <div class="form-group">
                                        <label for="text">Announcement Text</label>
                                        <textarea class="form-control" id="text" name="text" required>{{ old('text', $announcement->text) }}</textarea>
                                    </div>

                                    <!-- Link -->
                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input type="url" class="form-control" id="link" name="link" value="{{ old('link', $announcement->link) }}" placeholder="https://example.com">
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
                                    <button type="submit" class="btn btn-success">Update Announcement</button>

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
<script>
       // Function to display image preview
       function displayImage(input) {
            var preview = document.getElementById('preview-image');

            if (input && input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block"; // Show the preview image when a new image is selected
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Function to update the file name in the input label when the file is selected
        function updateFileName() {
            const image = document.getElementById('image');
            const label = document.querySelector('.custom-file-label');
            const fileName = image.files[0] ? image.files[0].name : 'Choose file';
            label.textContent = fileName;
        }
</script>
@endsection
