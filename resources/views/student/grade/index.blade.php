<x-layouts.dash-student active="grade" title="Quản lý điểm">

    @include('components.language')

    <div class="row">

        <div class="col-12">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h4 class="mb-0">
                    <i class="fas fa-edit mr-2"></i>
                    Quản lý điểm
                </h4>

            </div>

            <!-- MAIN CARD -->
            <div class="card shadow-sm">

                <div class="card-body">

                    <!-- THỐNG KÊ -->
                    <div class="row mb-4">

                        <!-- ĐIỂM TRUNG BÌNH -->
                        <div class="col-md-6 mb-3">

                            <div class="card bg-info text-white shadow h-100">

                                <div class="card-body text-center">

                                    <h6 class="mb-2">
                                        Điểm trung bình
                                    </h6>

                                    <h2 class="fw-bold mb-0">

                                        @if($average > 0)

                                            {{ number_format($average, 1) }}

                                        @else

                                            0

                                        @endif

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <!-- XẾP HẠNG -->
                        <div class="col-md-6 mb-3">

                            <div class="card bg-success text-white shadow h-100">

                                <div class="card-body text-center">

                                    <h6 class="mb-2">
                                        Xếp hạng theo khối
                                    </h6>

                                    <h2 class="fw-bold mb-0">

                                        @if($rank)

                                            {{ $rank }}
                                            / {{ $totalStudents }}

                                        @else

                                            Chưa có xếp hạng

                                        @endif

                                    </h2>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">

                        <table class="table table-hover align-middle text-center">

                            <thead class="table-light">

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

                                        <!-- LOẠI ĐIỂM -->
                                        <td>

                                            @switch($grade->grade_type)

                                                @case('homework')

                                                    <span class="badge bg-primary">
                                                        BTVN
                                                    </span>

                                                    @break

                                                @case('minitest')

                                                    <span class="badge bg-warning text-dark">
                                                        Mini Test
                                                    </span>

                                                    @break

                                                @case('monthly_exam')

                                                    <span class="badge bg-success">
                                                        Kiểm tra cuối tháng
                                                    </span>

                                                    @break

                                                @default

                                                    <span class="badge bg-secondary">
                                                        {{ $grade->grade_type }}
                                                    </span>

                                            @endswitch

                                        </td>

                                        <!-- BÀI TẬP -->
                                        <td>
                                            {{ $grade->assignment->title ?? '-' }}
                                        </td>

                                        <!-- ĐIỂM -->
                                        <td>

                                            <span class="badge bg-success">

                                                {{ number_format($grade->score, 1) }}

                                            </span>

                                        </td>

                                        <!-- NGƯỜI CHẤM -->
                                        <td>
                                            {{ $grade->teacher->name ?? '-' }}
                                        </td>

                                        <!-- NGÀY -->
                                        <td>

                                            {{ \Carbon\Carbon::parse($grade->graded_at)->format('d/m/Y') }}

                                        </td>

                                        <!-- NHẬN XÉT -->
                                        <td>

                                            {{ $grade->feedback ?? '-' }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="text-center py-4 text-muted">

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

    </div>

</x-layouts.dash-student>