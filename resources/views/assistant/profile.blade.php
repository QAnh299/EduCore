<x-layouts.dash-student active="profile">

<div class="container-fluid py-4">

<div class="text-center mb-4">
<img src="{{ asset('smash-logo.png') }}" style="width:80px;">
<h3 class="mt-2 text-primary">Thông tin tài khoản</h3>
</div>

<form method="POST" action="{{ route('profile.update') }}">
@csrf

<div class="mb-3">
<label class="form-label">Họ và tên</label>
<input type="text" name="name" class="form-control"
value="{{ auth()->user()->name }}">
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="text" class="form-control"
value="{{ auth()->user()->email }}" disabled>
</div>

<div class="mb-4">
<label class="form-label">Số điện thoại</label>
<input type="text" name="phone" class="form-control"
value="{{ auth()->user()->phone }}">
</div>

<div class="d-flex justify-content-between">
<button class="btn btn-primary">
Cập nhật
</button>

<a href="{{ route('dashboard') }}" class="btn btn-danger">
Quay về trang chủ
</a>
</div>

</form>

</div>

</x-layouts.dash-student>