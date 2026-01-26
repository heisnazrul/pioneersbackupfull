<?php

namespace App\Mail;

use App\Models\Agent;
use App\Models\AgentStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentStudentInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Agent $agent, public AgentStudent $student)
    {
    }

    public function build(): self
    {
        return $this->subject('Complete your student profile')
            ->markdown('emails.agent.student-invitation', [
                'agent' => $this->agent,
                'student' => $this->student,
                'onboardUrl' => route('student.onboard.show', $this->student->onboarding_token),
            ]);
    }
}
