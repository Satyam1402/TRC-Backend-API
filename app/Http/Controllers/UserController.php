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
                'status',
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
                // ->addColumn('status', function ($row) {
                //     if ($row->status == 'active') {
                //         return '<button class="btn btn-success btn-sm toggle-status" data-id="' . $row->id . '">Active</button>';
                //     } else {
                //         return '<button class="btn btn-danger btn-sm toggle-status" data-id="' . $row->id . '">Inactive</button>';
                //     }
                // })
                ->addColumn('action', function ($row) {
                    $viewButton = '<button class="btn btn-info btn-sm">
                                         <i class="fas fa-eye"></i> Properties
                    </button>';
                    // $viewButton = '<a href="' . route('users.properties', $row->id) . '" class="btn btn-info btn-sm">

                    $printButton = '<button class="btn btn-primary btn-sm" onclick="printUserDetails(' . $row->id . ')">
                                        <i class="fas fa-print"></i>
                                    </button>';

                    return $viewButton . ' ' . $printButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function printUser($id)
    {
        $user = User::findOrFail($id);
        return view('users.print', compact('user'));
    }

    // public function toggleStatus(Request $request)
    // {
    //     $user = User::findOrFail($request->id);

    //     $user->status = $user->status === 'active' ? 'inactive' : 'active';
    //     $user->save();

    //     return response()->json(['message' => 'User status updated successfully']);
    // }

}
