@extends('front.partials.app')
@section('title') Courses @endsection
@section('content')
    <div class="d-flex flex-column">
        @foreach ($courses as $course)
            <a href="{{ route('single.course.page', ['id' => $course->id]) }}" class="btn btn-primary">{{ $course->name }}</a>
        @endforeach
    </div>
@endsection