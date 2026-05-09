<x-layouts.dash-student active="profile">

<div class="container-fluid py-4">

    <div class="card">
        <div class="card-header">
            <h4>Thông tin tài khoản (Học viên)</h4>
        </div>

        <div class="card-body">

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="updateProfile">

                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" wire:model="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" value="{{ auth()->user()->email }}" class="form-control" disabled>
                </div>

                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" wire:model="phone" class="form-control">
                </div>

                <button class="btn btn-primary">Cập nhật</button>

            </form>

        </div>
    </div>

</div>

</x-layouts.dash-student>