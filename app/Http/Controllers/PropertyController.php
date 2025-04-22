<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PropertyController extends Controller
{
    public function index()
    {
        return view('properties.index'); // Your blade file
    }

    public function getProperties(Request $request)
    {
        if ($request->ajax()) {
            $sortColumnIndex = $request->get('order')[0]['column'];
            $sortDirection = $request->get('order')[0]['dir'];

            // Map DataTable columns to DB fields
            $columns = [
                'id',
                'unit_number',
                'street_number',
                'street_name',
                'suburb',
                'state',
                'postcode',
                'country',
                'contract_start_date',
                'contract_end_date',
                'created_at',
                'updated_at',
            ];

            $sortColumn = $columns[$sortColumnIndex];

            $data = Property::select($columns)->orderBy($sortColumn, $sortDirection);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('contract_start_date', function ($row) {
                    return $row->contract_start_date ? Carbon::parse($row->contract_start_date)->format('d-m-Y') : '';
                })
                ->addColumn('contract_end_date', function ($row) {
                    return $row->contract_end_date ? Carbon::parse($row->contract_end_date)->format('d-m-Y') : '';
                })
                // ->addColumn('created_at', function ($row) {
                //     return Carbon::parse($row->created_at)->format('d-m-Y h:i A');
                // })
                // ->addColumn('updated_at', function ($row) {
                //     return Carbon::parse($row->updated_at)->format('d-m-Y h:i A');
                // })
                // ->addColumn('action', function ($row) {
                //     return '
                //         <div class="d-flex">
                //             <a href="' . route('properties.edit', $row->id) . '" class="mb-1 btn btn-primary btn-sm mr-2">
                //                 <i class="fas fa-edit"></i>
                //             </a>
                //             <a href="#" class="mb-1 btn btn-danger btn-sm" onclick="confirmDelete(\'' . route('properties.destroy', $row->id) . '\');">
                //                 <i class="fas fa-trash"></i>
                //             </a>
                //         </div>
                //     ';
                // })
                ->rawColumns([])
                ->make(true);
        }
    }

}
