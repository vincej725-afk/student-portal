<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DepartmentSeeder::class);

        $courseCount = Course::count();
        if ($courseCount < 8) {
            Course::factory(8 - $courseCount)->create();
        }

        $courses = Course::query()->limit(8)->get();

        $studentCount = Student::count();
        if ($studentCount < 30) {
            Student::factory(30 - $studentCount)->create()->each(function (Student $student) use ($courses) {
                $picked = $courses->random(min(3, $courses->count()));
                foreach ($picked as $course) {
                    $student->courses()->syncWithoutDetaching([
                        $course->id => [
                            'grade' => fake()->randomElement([
                                1.00, 1.25, 1.50, 1.75, 2.00, 2.50, 3.00, null,
                            ]),
                        ],
                    ]);
                }
            });
        }
    }
}
