<?php
    $student = Auth::user()->student;
    $needEvaluation = false;
$currentRounds = collect(); // ← Add this line

    if ($student) {
        $currentRounds = \App\Models\EvaluationRound::current()->get();
        if ($currentRounds->count() > 0) {
            $evaluatedRounds = \App\Models\Evaluation::where('student_id', $student->id)
                ->whereIn('evaluation_round_id', $currentRounds->pluck('id'))
                ->whereNotNull('submitted_at')
                ->count();

            $needEvaluation = $evaluatedRounds < $currentRounds->count();
        }
    }

    // Debug information
    \Log::info('Evaluation component debug:', [
        'student' => $student ? $student->id : 'null',
        'currentRounds' => $currentRounds->count() ?? 0,
        'needEvaluation' => $needEvaluation,
        'user_id' => Auth::id(),
    ]);
?>

<!--[if BLOCK]><![endif]--><?php if($student && $needEvaluation): ?>
    <!-- Modal đánh giá bắt buộc - không thể đóng -->
    <div class="modal fade show d-block" id="requiredEvaluationModal" tabindex="-1"
        style="background-color: rgba(0,0,0,0.8); overflow-y: auto; z-index: 1050;">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 90%;">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        <?php echo e(__('general.evaluation_required')); ?>

                    </h5>
                </div>
                <div class="modal-body p-0" style="max-height: 80vh; overflow-y: auto;">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('student.evaluation.index', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-4221990201-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
        </div>
    </div>

    <!-- Nội dung bị khóa -->
    <div class="container-fluid py-5 text-center" style="opacity: 0.3; pointer-events: none;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <i class="bi bi-lock-fill fs-1 text-muted mb-3"></i>
                <h4 class="text-muted"><?php echo e(__('general.function_locked')); ?></h4>
                <p class="text-muted"><?php echo e(__('general.complete_evaluation_first')); ?>

                </p>
            </div>
        </div>
    </div>

    <style>
        /* Đảm bảo modal hiển thị đúng */
        #requiredEvaluationModal {
            display: block !important;
            background-color: rgba(0, 0, 0, 0.8) !important;
            z-index: 1050 !important;
        }

        #requiredEvaluationModal .modal-dialog {
            max-width: 90% !important;
            margin: 1.75rem auto !important;
        }

        #requiredEvaluationModal .modal-content {
            border: none !important;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        /* Đảm bảo nội dung bị khóa hiển thị đúng */
        .container-fluid.py-5 {
            opacity: 0.3 !important;
            pointer-events: none !important;
        }
    </style>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\xampp\htdocs\educore\resources\views/components/evaluation.blade.php ENDPATH**/ ?>