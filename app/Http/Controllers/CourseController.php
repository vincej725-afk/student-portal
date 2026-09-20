<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('students')
            ->orderBy('code')
            ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'  => 'required|string|max:12|unique:courses',
            'title' => 'required|string|max:120',
            'units' => 'required|integer|between:1,6',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course added.');
    }

    public function show(Course $course)
    {
        $course->load(['students' => function ($query) {
            $query->with('department')->orderBy('last_name');
        }]);

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'code'  => 'required|string|max:12|unique:courses,code,' . $course->id,
            'title' => 'required|string|max:120',
            'units' => 'required|integer|between:1,6',
        ]);

        $course->update($data);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted.');
    }
}
