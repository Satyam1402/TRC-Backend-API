<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $sortColumnIndex = $request->get('order')[0]['column'];
            $sortDirection = $request->get('order')[0]['dir'];

            // Update these to match actual DB columns
            $columns = [
                'id',
                'first_name',
                'last_name',
                'email',
                'phone',
                'created_at',
                'updated_at',
            ];

            $sortColumn = $columns[$sortColumnIndex];

            $data = User::select($columns)->orderBy($sortColumn, $sortDirection);

            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('created_at', function ($row) {
                //     return Carbon::parse($row->created_at)->format('d-m-Y h:i A');
                // })
                // ->addColumn('updated_at', function ($row) {
                //     return Carbon::parse($row->updated_at)->format('d-m-Y h:i A');
                // })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-info btn-sm" onclick="viewUserDetails(' . $row->id . ')">
                                <i class="fas fa-eye"></i> Properties
                            </button>';
                })
                ->rawColumns(['action']) // include 'action' here if you enable it
                ->make(true);
        }
    }

}
