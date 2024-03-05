@extends('front.partials.app')
@section('title')
    Courses
@endsection
@section('content')
    <div class="d-flex flex-column container pb-3">
        @if (count($courses))
            <h3 class="text-primary text-center fw-bold mb-3">Courses</h3>
            @foreach ($courses as $course)
                <a href="{{ route('single.course.page', ['id' => $course->id]) }}"
                    class="btn border mb-2">{{ $course->name }}</a>
            @endforeach
        @else
            <h1 class="text-center">No course found.</h1>
        @endif
    </div>
@endsection
