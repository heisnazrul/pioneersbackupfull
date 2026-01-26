<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RoleDashboardController extends Controller
{
    protected array $dashboards = [
        'lg_agent' => [
            'title' => 'Local Guardian Agent Hub',
            'description' => 'Track campus visits, manage local guardians, and coordinate logistics.',
            'actions' => [
                ['label' => 'View Students', 'url' => '#', 'style' => 'primary'],
                ['label' => 'Upload Reports', 'url' => '#', 'style' => 'outline'],
            ],
        ],
        'uni_agent' => [
            'title' => 'University Agent Overview',
            'description' => 'Follow up on university leads, review applications, and share updates with the admissions team.',
            'actions' => [
                ['label' => 'New Lead', 'url' => '#', 'style' => 'primary'],
                ['label' => 'Admissions Calendar', 'url' => '#', 'style' => 'outline'],
            ],
        ],
        'team' => [
            'title' => 'Operations Control Room',
            'description' => 'Monitor KPIs, handle escalations, and keep the ecosystem running smoothly.',
            'actions' => [
                ['label' => 'View KPIs', 'url' => '#', 'style' => 'primary'],
                ['label' => 'Open Tickets', 'url' => '#', 'style' => 'outline'],
            ],
        ],
        'counsellor' => [
            'title' => 'Counselor Workspace',
            'description' => 'Stay close to your student pipeline, schedule sessions, and collaborate with agents.',
            'actions' => [
                ['label' => 'Upcoming Sessions', 'url' => '#', 'style' => 'primary'],
                ['label' => 'Student Notes', 'url' => '#', 'style' => 'outline'],
            ],
        ],
        'school' => [
            'title' => 'School Partner Console',
            'description' => 'Review intakes, manage classroom availability, and communicate with the HQ team.',
            'actions' => [
                ['label' => 'Manage Intakes', 'url' => '#', 'style' => 'primary'],
                ['label' => 'Share Assets', 'url' => '#', 'style' => 'outline'],
            ],
        ],
        'lg_student' => [
            'title' => 'Local Guardian Student Board',
            'description' => 'See your progress, upcoming events, and messages from guardians.',
            'actions' => [
                ['label' => 'View Schedule', 'url' => '#', 'style' => 'primary'],
            ],
        ],
        'uni_student' => [
            'title' => 'University Student Center',
            'description' => 'Follow your applications, deadlines, and counselor feedback.',
            'actions' => [
                ['label' => 'Application Tracker', 'url' => '#', 'style' => 'primary'],
            ],
        ],
    ];

    public function show(Request $request, string $roleKey): View
    {
        abort_unless($request->user()?->role === $roleKey, 403);

        $config = $this->dashboards[$roleKey] ?? [
            'title' => 'Dashboard',
            'description' => 'Stay informed and take action.',
            'actions' => [],
        ];

        return view('roles.dashboard', [
            'user' => $request->user(),
            'config' => $config,
        ]);
    }
}
