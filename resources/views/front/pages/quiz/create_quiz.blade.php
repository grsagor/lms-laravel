@extends('front.partials.app')
@section('title')
    Create Quiz
@endsection
@section('content')
    <h1 class="text-center">Assign Quiz</h1>
    <form action="{{ route('store.create.assignment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course_id }}">
        <div id="addable-form">
            <div>
                <div class="mb-3">
                    <label for="question-0" class="form-label">Question</label>
                    <input type="text" class="form-control" id="question-0">
                </div>
                <div id="option_container-0">
                    <div class="mb-3" id="option-0-0">
                        <label for="input-0-0" class="form-label">Option</label>
                        <input type="text" class="form-control" id="input-0-0">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
@section('js')
@endsection
