<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prefs' => 'required|array',
            'prefs.necessary' => 'boolean',
            'prefs.analytics' => 'boolean',
        ]);

        session([
            'cookie_prefs_set' => true,
            'cookie_prefs' => $validated['prefs']
        ]);

        return response()->json(['status' => 'ok']);
    }
}