<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortCode = Str::random(6);

        $url = Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
            'clicks' => 0,
        ]);

        return response()->json([
            'short_code' => $shortCode,
            'short_url' => url('/' . $shortCode),
            'original_url' => $url->original_url,
        ], 201);
    }


    public function redirect($code)
    {
        $url = Url::where('short_code', $code)->first();

        if (!$url) {
            return response()->json(['error' => 'Short URL not found'], 404);
        }

        $url->increment('clicks');

        return redirect($url->original_url);
    }

    public function stats($code)
    {
        $url = Url::where('short_code', $code)->first();

        if (!$url) {
            return response()->json(['error' => 'Short URL not found'], 404);
        }

        return response()->json([
            'short_code' => $url->short_code,
            'original_url' => $url->original_url,
            'clicks' => $url->clicks,
            'created_at' => $url->created_at,
        ]);
    }
}
