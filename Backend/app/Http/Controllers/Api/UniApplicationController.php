<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UniApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'intake' => 'required|string',
            'course_id' => 'nullable|exists:university_courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application = UniApplication::create($request->all());

        return response()->json([
            'message' => 'Application submitted successfully',
            'data' => $application
        ], 201);
    }
}
