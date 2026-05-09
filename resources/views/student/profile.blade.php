<x-layouts.dash-student active="profile">
<div class="container-fluid py-4">

    <div class="card">
        <div class="card-header">
            <h4>Thông tin tài khoản</h4>
        </div>
        <div class="card-body">

            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session()->has('password_success'))
                <div class="alert alert-success">{{ session('password_success') }}</div>
            @endif

            {{-- Thông tin cá nhân --}}
            <form wire:submit.prevent="updateProfile">
                <div class="mb-3">
                    <label class="font-weight-bold">Họ tên</label>
                    <input type="text" wire:model="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Email</label>
                    <input type="text" value="{{ auth()->user()->email }}" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Số điện thoại</label>
                    <input type="text" wire:model="phone" class="form-control">
                </div>
                <button class="btn btn-primary mb-4">Cập nhật thông tin</button>
            </form>

            <hr>

            {{-- Đổi mật khẩu --}}
            <h5 class="mb-3">Đổi mật khẩu</h5>
            <form wire:submit.prevent="updatePassword">
                <div class="mb-3">
                    <label class="font-weight-bold">Mật khẩu hiện tại</label>
                    <input type="password" wire:model="current_password" class="form-control">
                    @error('current_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Mật khẩu mới</label>
                    <input type="password" wire:model="new_password" class="form-control">
                    @error('new_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Xác nhận mật khẩu mới</label>
                    <input type="password" wire:model="new_password_confirmation" class="form-control">
                </div>
                <button class="btn btn-warning">Đổi mật khẩu</button>
            </form>

        </div>
    </div>

</div>
</x-layouts.dash-student>