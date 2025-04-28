@extends('dashboard/master')

@section('title', 'Print Property Details')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" onload="window.print()">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 text-center">
                        <h1>Print Property Details</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card card-primary">
                            <div class="card-header text-center">
                                <h3 class="card-title" style="font-size: 24px; font-weight: bold;">Property Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered" style="border-collapse: collapse; width: 100%; font-size: 18px;">
                                    {{-- <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold; width: 30%;">ID</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->id }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Unit Number</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->unit_number }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Street Number</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->street_number }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Street Name</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->street_name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Suburb</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->suburb }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">State</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->state }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Postcode</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->postcode }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Country</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->country }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Contract start date</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->contract_start_date }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f4f4f4; padding: 15px; text-align: left; font-weight: bold;">Contract end date</th>
                                        <td style="padding: 15px; text-align: left;">{{ $property->contract_end_date }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        /* Custom styles for better print and page layout */
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 16px;
                margin: 0;
                padding: 0;
            }
            body * {
                visibility: hidden;
            }
            .content-wrapper, .content-wrapper * {
                visibility: visible;
            }
            .content-wrapper {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 15mm;
            }

            /* Improved table layout */
            .table {
                width: 100% !important;
                border: 1px solid #ddd;
                font-size: 18px;
                margin-top: 20px;
            }
            .table th, .table td {
                padding: 15px;
                text-align: left;
            }
            .table th {
                background-color: #f4f4f4;
                font-weight: bold;
            }
            /* Title styling */
            h1, .card-title {
                font-size: 28px;
                text-align: center;
                margin-bottom: 20px;
            }
            .card-header {
                background-color: #f4f4f4;
                padding: 10px 0;
                text-align: center;
            }
            .card-body {
                padding: 10px;
            }

            /* Center align content */
            .content-wrapper {
                text-align: left;
            }

            /* Improve page margins */
            @page {
                margin: 20mm;
            }
        }
    </style>
@endsection

@section('js')
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
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
