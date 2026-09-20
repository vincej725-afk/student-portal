@extends('layouts.app')

@section('content')
<h1>{{ $course->code }} — {{ $course->title }}</h1>
<p class="text-muted">Units: {{ $course->units }} · Total Enrolled: {{ $course->students->count() }}</p>

<h4>Enrolled Students</h4>
<table class="table bg-white">
    <thead>
        <tr>
            <th>Student No.</th>
            <th>Name</th>
            <th>Department</th>
            <th>Year</th>
            <th>Grade</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($course->students as $student)
            <tr>
                <td>{{ $student->student_number }}</td>
                <td><a href="{{ route('students.show', $student) }}" class="text-decoration-none">{{ $student->full_name }}</a></td>
                <td>{{ $student->department->code }}</td>
                <td>{{ $student->year_level }}</td>
                <td>
                    @if ($student->pivot->grade !== null)
                        <span class="badge bg-success">{{ number_format($student->pivot->grade, 2) }}</span>
                    @else
                        <span class="badge bg-secondary">No grade yet</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">No students enrolled in this course yet.</td></tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
@endsection
