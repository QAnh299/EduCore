<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    // Thông tin cá nhân
    public string $name = '';
    public string $phone = '';

    // Đổi mật khẩu
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->phone = Auth::user()->phone ?? '';
    }

    public function updateProfile()
    {
        $user = Auth::user();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->save();

        session()->flash('success', 'Cập nhật thông tin thành công!');
    }

    public function updatePassword()
    {
        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'Mật khẩu hiện tại không đúng!');
            return;
        }

        // Kiểm tra mật khẩu mới
        $this->validate([
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.required' => 'Vui lòng nhập mật khẩu mới!',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự!',
            'new_password.confirmed' => 'Xác nhận mật khẩu không khớp!',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->new_password);
        $user->save();

        // Reset fields
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        session()->flash('password_success', 'Đổi mật khẩu thành công!');
    }

    public function render()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('profile')->layout('components.layouts.app');
        }

        if ($user->role === 'teacher') {
            return view('teacher.profile')->layout('components.layouts.app');
        }

        return view('student.profile')->layout('components.layouts.app');
    }
}