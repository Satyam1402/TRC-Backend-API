<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
                'user_id',
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
                ->editColumn('contract_start_date', function ($row) {
                    return $row->contract_start_date ? Carbon::parse($row->contract_start_date)->format('d-m-Y') : '';
                })
                ->editColumn('contract_end_date', function ($row) {
                    return $row->contract_end_date ? Carbon::parse($row->contract_end_date)->format('d-m-Y') : '';
                })

                ->filterColumn('contract_start_date', function($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(contract_start_date, '%d-%m-%Y') like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('contract_end_date', function($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(contract_end_date, '%d-%m-%Y') like ?", ["%{$keyword}%"]);
                })

                // ->addColumn('created_at', function ($row) {
                //     return Carbon::parse($row->created_at)->format('d-m-Y h:i A');
                // })
                // ->addColumn('updated_at', function ($row) {
                //     return Carbon::parse($row->updated_at)->format('d-m-Y h:i A');
                // })
                ->addColumn('action', function ($row) {
                    // Print button
                    $printButton = '<button class="btn btn-primary btn-sm" onclick="printPropertyDetails(' . $row->id . ')">
                                        <i class="fas fa-print"></i>
                                    </button>';

                    return $printButton;
                })
                ->rawColumns(['contract_start_date','contract_end_date','action']) // include 'action' here if you enable it
                ->make(true);
        }
    }

    public function printProperty($id)
    {
        $property = Property::findOrFail($id);

        return view('properties.print', compact('property'));
    }

    public function userProperties($id)
    {
        $user = User::with('properties')->findOrFail($id);
        return view('properties.user_properties', compact('user'));
    }

}
