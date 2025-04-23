<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Utility;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::with('utility')->get();
        return view('providers.index', compact('providers'));
    }

    public function getProviders(Request $request)
    {
        if ($request->ajax()) {
            $sortColumnIndex = $request->get('order')[0]['column'];
            $sortDirection = $request->get('order')[0]['dir'];

            // Match with DataTable columns: DT_RowIndex, name, utility_name, action
            $columns = [
                'id',            // DT_RowIndex is auto-indexed
                'utility_id',    // For sorting by utility if needed
                'name',
            ];

            $sortColumn = $columns[$sortColumnIndex] ?? 'id';

            $data = Provider::with('utility:id,name')
                ->select('id','utility_id','name',)
                ->orderBy($sortColumn, $sortDirection);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('utility_name', function ($row) {
                    return $row->utility->name ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('providers.edit', $row->id);
                    $deleteUrl = route('providers.destroy', $row->id);

                    return '
                    <div class="d-flex">
                        <a href="' . $editUrl . '" class="mb-1 btn btn-primary btn-sm mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this provider?\');">
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
        $utilities = Utility::all();
        return view('providers.create', compact('utilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'utility_id' => 'required|exists:utilities,id',
        ]);

        Provider::create($request->all());
        return redirect()->route('providers.index')->with('success', 'Provider created successfully.');
    }

    // "show" route is defined for resource controller but its mandatory to define it
    public function show(Provider $provider)
    {
        //
    }

    public function edit(Provider $provider)
    {
        $utilities = Utility::all();
        return view('providers.edit', compact('provider', 'utilities'));
    }

    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'name' => 'required|string',
            'utility_id' => 'required|exists:utilities,id',
        ]);

        $provider->update($request->all());
        return redirect()->route('providers.index')->with('success', 'Provider updated successfully.');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')->with('success', 'Provider deleted successfully.');
    }
}
