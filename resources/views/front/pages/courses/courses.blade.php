@extends('front.partials.app')
@section('title') Courses @endsection
@section('content')
    <div class="d-flex flex-column container pb-3">
        <h3 class="text-primary text-center fw-bold mb-3">Courses</h3>
        @foreach ($courses as $course)
            <a href="{{ route('single.course.page', ['id' => $course->id]) }}" class="btn border mb-2">{{ $course->name }}</a>
        @endforeach
    </div>
@endsection