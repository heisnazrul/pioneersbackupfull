<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class StudentDashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();

        $progress = [
            ['label' => 'Application', 'value' => 65],
            ['label' => 'Documents', 'value' => 40],
            ['label' => 'Payments', 'value' => 20],
        ];

        $tasks = [
            ['title' => 'Upload passport copy', 'status' => 'Pending'],
            ['title' => 'Complete placement test', 'status' => 'Pending'],
            ['title' => 'Confirm accommodation preference', 'status' => 'Done'],
        ];

        $shortcuts = [
            ['label' => 'My Courses', 'description' => 'See schedules & attendance', 'url' => '#'],
            ['label' => 'Finance', 'description' => 'Invoices & payments', 'url' => '#'],
            ['label' => 'Messages', 'description' => 'Chat with counselor', 'url' => '#'],
        ];

        return view('student.dashboard', compact('user', 'progress', 'tasks', 'shortcuts'));
    }
}
