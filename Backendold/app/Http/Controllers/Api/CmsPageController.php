<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsPageController extends Controller
{
    public function show(string $slug)
    {
        $page = \App\Models\CmsPage::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => $page
        ]);
    }
}
