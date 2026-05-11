<div>

<x-layouts.dash-teacher active="reports">

    @include('components.language')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-0 text-primary fs-4">
                <i class="bi bi-bar-chart mr-2"></i>
                Báo cáo học tập
            </h4>

        </div>

    </div>

    <!-- FILTER -->
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">

                    <label class="form-label">
                        Lọc theo lớp
                    </label>

                    <select
                        class="form-control"
                        wire:model.live="selectedClass"
                    >

                        <option value="">
                            Tất cả lớp
                        </option>

                        @foreach ($classrooms as $classroom)

                            <option value="{{ $classroom->id }}">
                                {{ $classroom->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <label class="form-label">
                        &nbsp;
                    </label>

                    <button
                        class="btn btn-outline-secondary w-100"
                        wire:click="resetFilters"
                    >

                        <i class="bi bi-arrow-clockwise mr-1"></i>

                        Đặt lại

                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Học viên</th>

                            <th>Lớp</th>

                            <th>Điểm trung bình</th>

                            <th>Xếp hạng</th>

                            <th>Tỷ lệ nộp bài</th>

                            <th>Số buổi tham gia</th>

                        </tr>

                    </thead>

                    <tbody>

                        @php
                            $currentGrade = null;

                            $currentRank = 0;

                            $displayRank = 0;

                            $lastScore = null;
                        @endphp

                        @forelse ($students as $student)

                            @php

                                $classroomName =
                                    $student->classrooms
                                        ->first()?->name ?? '';

                                preg_match(
                                    '/\d+/',
                                    $classroomName,
                                    $matches
                                );

                                $studentGrade =
                                    $matches[0] ?? null;

                                /**
                                 * Reset rank khi sang khối mới
                                 */
                                if (
                                    $currentGrade !=
                                    $studentGrade
                                ) {

                                    $currentGrade =
                                        $studentGrade;

                                    $currentRank = 0;

                                    $displayRank = 0;

                                    $lastScore = null;
                                }

                                /**
                                 * Đồng điểm = cùng hạng
                                 */
                                if (
                                    $student->average_score > 0
                                ) {

                                    $currentRank++;

                                    if (
                                        $lastScore
                                        !==
                                        $student->average_score
                                    ) {

                                        $displayRank =
                                            $currentRank;

                                        $lastScore =
                                            $student->average_score;
                                    }

                                } else {

                                    $displayRank = null;
                                }

                            @endphp

                            <tr>

                                <!-- TÊN -->
                                <td class="fw-semibold">
                                    {{ $student->name }}
                                </td>

                                <!-- LỚP -->
                                <td>

                                    @forelse ($student->classrooms as $classroom)

                                        <span class="badge bg-primary me-1">
                                            {{ $classroom->name }}
                                        </span>

                                    @empty

                                        <span class="text-muted">
                                            Chưa có lớp
                                        </span>

                                    @endforelse

                                </td>

                                <!-- ĐIỂM TB -->
                                <td>

                                    @if($student->average_score > 0)

                                        <span class="fw-bold text-primary">
                                            {{ number_format($student->average_score, 1) }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Chưa có điểm
                                        </span>

                                    @endif

                                </td>

                                <!-- XẾP HẠNG -->
                                <td>

                                    @if($displayRank)

                                        <span class="badge bg-warning text-dark">
                                            #{{ $displayRank }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Chưa có xếp hạng
                                        </span>

                                    @endif

                                </td>

                                <!-- TỶ LỆ NỘP BÀI -->
                                <td>

                                    <div class="fw-bold">
                                        {{ $student->submit_rate }}%
                                    </div>

                                    <small class="text-muted">

                                        {{ $student->graded_assignments }}
                                        /
                                        {{ $student->assignments_checked }}
                                        bài

                                    </small>

                                </td>

                                <!-- SỐ BUỔI THAM GIA -->
                                <td>

                                     <div class="fw-bold text-info">

        {{ $student->present_count }}
        /
        {{ $student->total_attendance }}
        buổi

    </div>

    <small class="text-muted">

        @if($student->total_attendance > 0)

            {{ round(($student->present_count / $student->total_attendance) * 100) }}%

        @else

            0%

        @endif
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-4 text-muted">

                                    Không có dữ liệu

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-layouts.dash-teacher>

</div>