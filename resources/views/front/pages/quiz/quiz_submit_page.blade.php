@extends('front.partials.app')
@section('title', 'Quiz')
@section('content')
<div>
    <h1>{{ $quiz->title }}</h1>
    <div>
        {!! $quiz->description !!}
    </div>
    <form action="{{ route('submit.quiz.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        @foreach ($quiz->quizzes as $i => $item)
            <h6>Q{{ $i + 1 }}: {{ $item->question }}</h6>
            <ul class="row">
                @foreach ($item->option as $ii => $single_option)
                    <li class="col-12 col-md-6">
                        <input type="radio" name="answer_{{ $i }}" id="aswer_{{ $i }}_{{ $ii }}" required value="{{ $single_option }}"> <label for="aswer_{{ $i }}_{{ $ii }}">{{ $single_option }}</label>
                    </li>
                @endforeach
            </ul>
        @endforeach

        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('js')
@endsection