<?php

namespace App\Http\Controllers;
use App\Models\SocialMediaChallenge;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SocialMediaChallengeController extends Controller
{
    public function index()
    {
        $challenges = SocialMediaChallenge::all();
        return view('social_media_challenges.index', compact('challenges'));
    }

    public function getSocialMediaChallenges(Request $request)
    {
        if ($request->ajax()) {
            $sortColumnIndex = $request->get('order')[0]['column'];
            $sortDirection = $request->get('order')[0]['dir'];

            // Columns for DataTable indexing
            $columns = [
                'id',
                'title',
                'start_date',
                'end_date',
                'social_link',
                'created_at',
                'updated_at',
            ];

            $sortColumn = $columns[$sortColumnIndex];

            // Fetch sorted data
            $data = SocialMediaChallenge::select($columns)->orderBy($sortColumn, $sortDirection);

            return DataTables::of($data)
                ->addIndexColumn()
                // ->editColumn('social_link', function ($row) {
                //     if ($row->social_link) {
                //         return '<a href="' . $row->social_link . '" target="_blank">' . 'click' . '</a>';
                //     }
                //     return 'No Social-Link';
                // })
                ->addColumn('action', function ($row) {
                    $editUrl = route('social-media-challenges.edit', $row->id);
                    $deleteUrl = route('social-media-challenges.destroy', $row->id);

                    return '
                        <div class="d-flex">
                            <a href="' . $editUrl . '" class="mb-1 btn btn-primary btn-sm mr-2">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this challenge?\');">
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
        return view('social_media_challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'social_link' => 'nullable|url',
        ]);

        SocialMediaChallenge::create($request->all());

        return redirect()->route('social-media-challenges.index')->with('success', 'Challenge created successfully.');
    }

    // "show" route is defined for resource controller but its mandatory to define it
    public function show($id)
    {
        //
    }

    public function edit(SocialMediaChallenge $social_media_challenge)
    {
        return view('social_media_challenges.edit', compact('social_media_challenge'));
    }

    public function update(Request $request, SocialMediaChallenge $social_media_challenge)
    {
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'social_link' => 'nullable|url',
        ]);

        $social_media_challenge->update($request->all());

        return redirect()->route('social-media-challenges.index')->with('success', 'Challenge updated successfully.');
    }

    public function destroy(SocialMediaChallenge $social_media_challenge)
    {
        $social_media_challenge->delete();

        return redirect()->route('social-media-challenges.index')->with('success', 'Challenge deleted successfully.');
    }
}
