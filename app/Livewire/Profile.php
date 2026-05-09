<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public function render()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.profile')
                ->layout('components.layouts.dash-admin');
        }

        if ($user->role === 'teacher') {
            return view('teacher.profile')
                ->layout('components.layouts.dash-teacher');
        }

        return view('student.profile')
            ->layout('components.layouts.dash-student');
    }
}