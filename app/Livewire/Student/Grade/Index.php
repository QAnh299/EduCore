<?php

namespace App\Livewire\Student\Grade;

use Livewire\Component;
use App\Models\User;
use App\Models\Grade;
use App\Models\Assignment;
class Index extends Component
{
    public $grades;
    public $average = 0;
    public $rank = 0;
    public $totalStudents = 0;

    public function mount()
    {
        $this->grades = Grade::where('student_id', auth()->id())
            ->with(['teacher','assignment'])
            ->orderByDesc('graded_at')
            ->get();
        $this->calculateAverage();
        $this->calculateRank();
    }
    private function calculateAverage()
    {
        $homework = Grade::where('student_id', auth()->id())
            ->where('grade_type','homework')
            ->sum('score');

        $minitest = Grade::where('student_id', auth()->id())
            ->where('grade_type','minitest')
            ->sum('score');

        $exam = Grade::where('student_id', auth()->id())
            ->where('grade_type','monthly_exam')
            ->sum('score');

        if($homework && $minitest && $exam){
            $this->average =
                $homework * 0.1 +
                $minitest * 0.3 +
                $exam * 0.6;
        } else {
            $this->average = 0;
        }
    }

    private function calculateRank()
    {
        $students = User::where('role','student')->get();

        $scores = [];

        foreach($students as $student){

            $homework = Grade::where('student_id',$student->id)
                ->where('grade_type','homework')->sum('score');

            $minitest = Grade::where('student_id',$student->id)
                ->where('grade_type','minitest')->sum('score');

            $exam = Grade::where('student_id',$student->id)
                ->where('grade_type','monthly_exam')->sum('score');

            if($homework && $minitest && $exam){
                $avg = $homework*0.1 + $minitest*0.3 + $exam*0.6;
            }else{
                $avg = 0;
            }

            $scores[$student->id] = $avg;
        }

        arsort($scores);

        $this->rank = array_search(auth()->id(), array_keys($scores)) + 1;
        $this->totalStudents = count($scores);
    }

    public function render()
    {
        return view('student.grade.index', [
            'grades' => $this->grades
        ]);
    }
}
