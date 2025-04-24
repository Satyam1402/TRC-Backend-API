<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    public function getAnnouncements(Request $request)
    {
        if ($request->ajax()) {
            $sortColumnIndex = $request->get('order')[0]['column'];
            $sortDirection = $request->get('order')[0]['dir'];

            // Columns for DataTable indexing
            $columns = [
                'id',
                'image',
                'text',
                'link',
                'status',
                'created_at',
                'updated_at',
            ];

            $sortColumn = $columns[$sortColumnIndex];

            // Fetch sorted data
            $data = Announcement::select($columns)->orderBy($sortColumn, $sortDirection);

            return DataTables::of($data)
                ->addIndexColumn()
                // ->editColumn('status', function ($row) {
                //     return $row->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-secondary">Inactive</span>';
                // })
                  // Display image in the DataTable
                ->editColumn('image', function ($row) {
                    if ($row->image) {
                        return '<img src="' . url('storage/app/public/' . $row->image) . '" alt="Image" style="width: 50px; height: 50px; object-fit: cover;">';
                    }
                    return 'No Image';
                })
                ->editColumn('link', function ($row) {
                    if ($row->link) {
                        return '<a href="' . $row->link . '" target="_blank">' . 'click' . '</a>';
                    }
                    return 'No Link';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('announcements.edit', $row->id);
                    $deleteUrl = route('announcements.destroy', $row->id);

                    return '
                        <div class="d-flex">
                            <a href="' . $editUrl . '" class="mb-1 btn btn-primary btn-sm mr-2">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this announcement?\');">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="mb-1 btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['image', 'link','action'])
                ->make(true);
        }
    }
    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'text' => 'required|string',
            'link' => 'nullable|url',
            // 'status' => 'nullable|in:0,1',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('announcements','public');
            // Return image path just for debugging
            // return $data['image'];
        }

        // $data['status'] = $request->input('status', 0);

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'text' => 'required|string',
            'link' => 'nullable|url',
            // 'status' => 'nullable|in:0,1',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($announcement->image && Storage::disk('public')->exists($announcement->image)) {
                Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        // $data['status'] = $request->input('status', 0);

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);

        // Delete image file
        if ($announcement->image && Storage::disk('public')->exists($announcement->image)) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
