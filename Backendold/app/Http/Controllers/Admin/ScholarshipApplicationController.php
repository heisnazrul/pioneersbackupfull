<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\Http\Request;

class ScholarshipApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ScholarshipApplication::query();

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('application_id', 'like', "%{$search}%")
                    ->orWhere('scholarship_title', 'like', "%{$search}%");
            });
        }

        // Filter by Status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.scholarship_applications.index', compact('applications'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ScholarshipApplication $scholarshipApplication)
    {
        // Placeholder for show view
        return view('admin.scholarship_applications.show', compact('scholarshipApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScholarshipApplication $scholarshipApplication)
    {
        // Get potential assignees (e.g. admins, counselors)
        // For simplicity, we get all users with admin or agent roles, or just all users for now if roles aren't strict
        // Adjust based on your Role handling implementation
        $assignees = User::where('role', 'admin')->orWhere('role', 'agent')->orderBy('name')->get();

        return view('admin.scholarship_applications.edit', compact('scholarshipApplication', 'assignees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScholarshipApplication $scholarshipApplication)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,approved,rejected',
            'assignee_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        $scholarshipApplication->update($validated);

        return back()->with('success', 'Application updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScholarshipApplication $scholarshipApplication)
    {
        $scholarshipApplication->delete();
        return back()->with('success', 'Application deleted successfully');
    }
}
