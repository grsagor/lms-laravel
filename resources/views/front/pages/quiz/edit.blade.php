@extends('front.partials.app')
@section('title')
    Post Edit
@endsection
@section('content')
    <div class="row container mx-auto">
        <form action="{{ route('quiz.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="question__counter" value="{{ $question__counter }}">
            <input type="hidden" name="id" value="{{ $all_post->quiz->id }}">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ $all_post->quiz->title }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control richtext" id="description" name="description">{!! $all_post->quiz->description !!}</textarea>
            </div>
            <div class="mb-3 row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline"
                            value="{{ $all_post->quiz->deadline }}">
                    </div>
                </div>
            </div>
            <div id="main__question--container">

                @foreach ($quizzes as $qi => $quiz)
                    <div id="question_container--{{ $qi }}" class="mb-3">
                        <input type="hidden" id="option__counter--{{ $qi }}"
                            value="{{ $quiz->option__counter }}">
                        <div class="mb-3">
                            <label for="question-{{ $qi }}" class="form-label">Question</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" id="question-{{ $qi + 1 }}" name="question[]"
                                    value="{{ $quiz->question }}">
                                <input type="hidden" name="right_ans[]" id="right_ans--{{ $qi + 1 }}" value="{{ $quiz->right_ans }}">
                                <button data-qno="{{ $qi }}" class="remove__question--btn btn btn-danger" type="button"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                        <div id="main_option_container--{{ $qi }}">
                            @foreach ($quiz->option as $oi => $item)
                                <div id="option_container--{{ $oi }}" class="mb-3">
                                    <label for="option-{{ $qi }}-{{ $oi }}" class="form-label">Option</label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control" id="option-{{ $qi }}-{{ $oi }}" name="option[{{ $qi + 1 }}][]" value="{{ $item }}">
                                        <input {{ $quiz->right_ans == $item ? 'checked' : '' }} type="radio" name="right_{{ $qi + 1 }}" onchange="setRightAnswer('{{ $qi + 1 }}')">
                                        <button data-qno="{{ $qi }}" data-num="{{ $quiz->option__counter }}" class="remove__option--btn btn btn-danger"
                                            type="button"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button data-qno="{{ $qi }}" data-num="{{ $quiz->option__counter }}" class="btn btn-success add__option--btn" type="button"><i class="fa-solid fa-plus"></i></button>
                    </div>
                @endforeach
            </div>

            <button id="add__question--btn" type="button" class="btn btn-success add__question--btn"><i class="fa-solid fa-circle-plus"></i></button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            /* Add Question */
            $('.add__question--btn').click(function() {
                var qCounter = $('#question__counter').val();
                var qCounter = parseInt(qCounter, 10) + 1;
                $('#question__counter').val(qCounter);

                var data = {
                    q_counter: qCounter,
                };

                $.ajax({
                    url: "/quiz/add-question",
                    method: "GET",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        var container = $(`#main__question--container`);
                        container.append(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    }
                });
            })

            /* Add Option */
            $(document).on('click', '.add__option--btn', function() {
                console.log('add option')
                var num = $(this).data('num');
                var oConnter = $(`#option__counter--${num}`).val();
                var oConnter = parseInt(oConnter, 10) + 1;
                var qCounter = $(this).data('qno');
                $(`#option__counter--${num}`).val(oConnter)

                var data = {
                    q_counter: qCounter,
                    o_couonter: oConnter,
                };

                $.ajax({
                    url: "/quiz/add-option",
                    method: "GET",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        var container = $(
                            `#question_container--${qCounter} #main_option_container--${qCounter}`
                        );
                        container.append(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    }
                });
            });

            /* Remove Option */
            $(document).on('click', '.remove__option--btn', function() {
                var qCounter = $(this).data('qno');
                var num = $(this).data('num');
                $(`#main_option_container--${qCounter} #option_container--${num}`).empty();
            });

            /* Remove Question */
            $(document).on('click', '.remove__question--btn', function() {
                var qCounter = $(this).data('qno');
                $(`#question_container--${qCounter}`).empty();
            });
        });
    </script>
    <script>
        function setRightAnswer(questionNumber) {
            // const parentDiv = document.querySelector(`input[name="right_${questionNumber}"]`).parentNode;
            // const inputField = parentDiv.children[0];
            // const inputValue = inputField.value;
            // $(`#right_ans--${questionNumber}`).val(inputValue);
            // console.log(inputValue)
            const radioInputs = document.querySelectorAll(`input[name="right_${questionNumber}"]`);
            radioInputs.forEach(input => {
                if (input.checked) {
                    const parentDiv = input.parentNode;
                    const inputField = parentDiv.children[0];
                    const inputValue = inputField.value;
                    $(`#right_ans--${questionNumber}`).val(inputValue);
                    console.log(inputValue)
                }
            });
        }
    </script>
@endsection
