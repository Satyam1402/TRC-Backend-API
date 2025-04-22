<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utility;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UtilityController extends Controller
{
    public function index()
    {
        $utilities = Utility::all();
        return view('utilities.index', compact('utilities'));
    }

    public function getUtilities(Request $request)
    {
        if ($request->ajax()) {
            $sortColumnIndex = $request->get('order')[0]['column'];
            $sortDirection = $request->get('order')[0]['dir'];

            // Map DataTable columns to DB fields
            $columns = [
                'id',
                'name',
                'created_at',
                'updated_at',
            ];

            $sortColumn = $columns[$sortColumnIndex];

            // Fetch utilities with selected columns and apply sorting
            $data = Utility::select($columns)->orderBy($sortColumn, $sortDirection);

            // Use Yajra DataTables to return the data
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('created_at', function ($row) {
                //     return $row->created_at->format('d-m-Y h:i A'); // Format created_at date
                // })
                // ->addColumn('updated_at', function ($row) {
                //     return $row->updated_at->format('d-m-Y h:i A'); // Format updated_at date
                // })
                ->addColumn('action', function ($row) {
                    $editUrl = route('utilities.edit', $row->id);
                    $deleteUrl = route('utilities.destroy', $row->id);

                    return '
                       <div class="d-flex">
                        <a href="' . $editUrl . '" class="mb-1 btn btn-primary btn-sm mr-2">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this utility?\');">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="mb-1 btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                      </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function create()
    {
        return view('utilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Utility::create($request->only('name'));

        return redirect()->route('utilities.index')->with('success', 'Utility created successfully.');
    }

    // "show" route is defined for resource controller but its mandatory to define it
    public function show($id)
    {
        // Optional: redirect or return some message
        // return redirect()->route('utilities.index')->with('info', 'Show method not implemented.');
    }


    public function edit($id)
    {
        $utility = Utility::findOrFail($id);
        return view('utilities.edit', compact('utility'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the utility to update
        $utility = Utility::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        ]);

        $utility->update($request->only('name'));

        return redirect()->route('utilities.index')->with('success', 'Utility updated successfully.');
    }


    public function destroy($id)
    {
        $utility = Utility::findOrFail($id);
        $utility->delete();

        return redirect()->route('utilities.index')->with('success', 'Utility deleted successfully.');
    }
}
