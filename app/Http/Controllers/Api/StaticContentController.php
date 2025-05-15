<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\StaticContent;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class StaticContentController extends Controller
{
    /**
     * Get static content by type (e.g., terms, privacy)
     */
    public function getContent($type)
    {
        $content = Cache::remember("static_content_{$type}", 60, function () use ($type) {
            return StaticContent::where('type', $type)->first();
        });

        if (!$content) {
            return response()->json([
                'status' => 'error',
                'message' => ucfirst($type) . ' not found.'
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'type' => $content->type,
                'content' => $content->content
            ]
        ], 200);
    }
}

