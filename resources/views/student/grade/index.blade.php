<x-layouts.dash-student active="grade" title="Nhập điểm mới">

    @include('components.language')

    <div class="row">
        <div class="col-12">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="fas fa-edit mr-2"></i>Quản lý điểm
                </h4>
            </div>
            <!--Filter-->
            <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">


            <div class="card card-outline card-primary mx-auto">
                <div class="card-body">
                    <div class="row mb-4">

    <div class="col-md-6">
        <div class="card bg-info text-white shadow">
            <div class="card-body text-center">
                <h6>Điểm trung bình</h6>
                <h3>{{ number_format($average,2) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-success text-white shadow">
            <div class="card-body text-center">
                <h6>Xếp hạng</h6>
                <h3>{{ $rank }}/{{ $totalStudents }}</h3>
            </div>
        </div>
    </div>

</div>
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle w-100">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>Loại điểm</th>
                                    <th>Bài tập</th>
                                    <th>Số điểm</th>
                                    <th>Người chấm</th>
                                    <th>Ngày chấm</th>
                                    <th>Nhận xét</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($grades as $grade)

                                <tr>
                                    <td>{{ ucfirst($grade->grade_type) }}</td>
                                    <td>{{ $grade->assignment->title ?? '-' }}</td>
                                    <td><span class="badge bg-success">{{ $grade->score }}</span></td>
                                    <td>{{ $grade->teacher->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($grade->graded_at)->format('d/m/Y') }}</td>
                                    <td>{{ $grade->feedback ?? '-' }}</td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-database mr-2"></i>
                                        Chưa có dữ liệu
                                    </td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </div>

</x-layouts.dash-student>
