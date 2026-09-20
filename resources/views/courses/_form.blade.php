@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Course Code</label>
        <input name="code" class="form-control" value="{{ old('code', $course->code ?? '') }}" placeholder="e.g. CS101">
    </div>
    <div class="col-md-6">
        <label class="form-label">Course Title</label>
        <input name="title" class="form-control" value="{{ old('title', $course->title ?? '') }}" placeholder="e.g. Introduction to Programming">
    </div>
    <div class="col-md-2">
        <label class="form-label">Units</label>
        <input type="number" name="units" class="form-control" min="1" max="6" value="{{ old('units', $course->units ?? 3) }}">
    </div>
</div>
