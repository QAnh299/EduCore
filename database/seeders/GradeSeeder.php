<?php

namespace Database\Seeders;
use App\Models\Assignment;
use App\Models\Grade;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        $assignments = Assignment::all();

        if ($assignments->isEmpty()) {
            return;
        }

        foreach ($assignments as $assignment) {

            $students = $assignment->classroom
                ->students()
                ->with('studentProfile')
                ->get();

            if ($students->isEmpty()) {
                continue;
            }

            $submissionRate = rand(70, 90);
            $submissionCount = ceil($students->count() * $submissionRate / 100);

            $submittingStudents = $students->random($submissionCount)->values();

            foreach ($submittingStudents as $student) {

                $submittedAt = $faker->boolean(20)
                    ? $assignment->deadline->copy()->addDays(rand(1,3))
                    : $assignment->deadline->copy()->subDays(rand(0,2));

                $isGraded = $faker->boolean(80);
                $score = $isGraded ? rand(5,10) : null;

                Grade::create([
                    'student_id' => $student->studentProfile->id,
                    'class_id' => $assignment->class_id,
                    'assignment_id' => $assignment->id,
                    'grade_type' => 'homework',
                    'score' => $score,
                    'feedback' => $score ? $this->generateTeacherNotes($score,$faker) : null,
                    'created_at' => $submittedAt,
                ]);
            }
        }
    }

    private function generateTeacherNotes($score, $faker)
    {
        if ($score >= 9) {
            return $faker->randomElement([
                'Bài làm xuất sắc!',
                'Hoàn thành rất tốt.',
                'Trình bày rõ ràng và đầy đủ.',
            ]);
        }

        if ($score >= 7) {
            return $faker->randomElement([
                'Bài làm tốt.',
                'Đáp ứng yêu cầu cơ bản.',
                'Cần chú ý thêm chi tiết.',
            ]);
        }

        if ($score >= 5) {
            return $faker->randomElement([
                'Cần cải thiện thêm.',
                'Chưa đầy đủ nội dung.',
            ]);
        }

        return $faker->randomElement([
            'Chưa đạt yêu cầu.',
            'Cần làm lại bài tập.',
        ]);
    }
}
