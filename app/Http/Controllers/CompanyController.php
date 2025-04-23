<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Utility;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::with('utility')->get();
        return view('companies.index', compact('company'));
    }

    public function getCompanies(Request $request)
    {
        if ($request->ajax()) {
            $sortColumnIndex = $request->get('order')[0]['column'];
            $sortDirection = $request->get('order')[0]['dir'];

            $columns = ['id', 'utility_id', 'name'];
            $sortColumn = $columns[$sortColumnIndex] ?? 'id';

            $data = Company::with('utility:id,name')
                ->select('id','utility_id','name')
                ->orderBy($sortColumn, $sortDirection);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('utility_name', fn($row) => $row->utility->name ?? '-')
                ->addColumn('action', function ($row) {
                    $editUrl = route('companies.edit', $row->id);
                    $deleteUrl = route('companies.destroy', $row->id);

                    return '
                    <div class="d-flex">
                        <a href="' . $editUrl . '" class="mb-1 btn btn-primary btn-sm mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this company?\');">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="mb-1 btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $utilities = Utility::all();
        return view('companies.create', compact('utilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'utility_id' => 'required|exists:utilities,id',
            'name' => 'required|string',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $utilities = Utility::all();
        return view('companies.edit', compact('company', 'utilities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'utility_id' => 'required|exists:utilities,id',
            'name' => 'required|string',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
