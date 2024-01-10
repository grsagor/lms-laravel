@extends('front.partials.app')
@section('title', 'Quiz')
@section('content')
<div class="container">
    <h3 class="text-center text-primary fw-bold">{{ $quiz->title }}</h3>
    <div>
        {!! $quiz->description !!}
    </div>
    <form action="{{ route('submit.quiz.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        @foreach ($quiz->quizzes as $i => $item)
            <h6>Q{{ $i + 1 }}: {{ $item->question }}</h6>
            <ul class="row list-style-none">
                @foreach ($item->option as $ii => $single_option)
                    <li class="col-12 col-md-6 {{ $answered && $item->answer == $single_option && $item->right_ans != $single_option ? 'wrong-answer' : '' }} {{ $answered && $item->right_ans == $single_option ? 'right-answer' : '' }}">
                        <input {{ $answered ? 'disabled' : '' }} {{ $answered && ($item->answer == $single_option) ? 'checked' : '' }} type="radio" name="answer_{{ $i }}" id="aswer_{{ $i }}_{{ $ii }}" required value="{{ $single_option }}"> <label for="aswer_{{ $i }}_{{ $ii }}">{{ $single_option }}</label>
                    </li>
                @endforeach
            </ul>
        @endforeach

        <button class="btn btn-primary {{ $answered ? 'd-none' : '' }}">Submit</button>
        <p class="{{ $answered ? 'd-block' : 'd-none' }}">Your mark: <strong>{{ $quiz->marks }}</strong></p>
    </form>
</div>
@endsection
@section('js')
@endsection