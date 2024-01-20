@extends('front.partials.app')
@section('title')
    Create Quiz
@endsection
@section('content')
<div class="container">
    <h1 class="text-center">Assign Quiz</h1>
    <form action="{{ route('store.quiz.question') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="question__counter" value="1">
        <input type="hidden" name="course_id" value="{{ $course_id }}">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control richtext" id="description" name="description"></textarea>
        </div>
        <div class="mb-3 row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="deadline" class="form-label">Deadline</label>
                    <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                </div>
            </div>
        </div>
        <div id="main__question--container">
            <div id="question_container--1" class="mb-3">
                <input type="hidden" id="option__counter--1" value="1">
                <div class="mb-3">
                    <label for="question-1" class="form-label">Question</label>
                    <div class="d-flex">
                        <input type="text" class="form-control" id="question-1" name="question[]">
                        <input type="hidden" name="right_ans[]" id="right_ans--1">
                        <button data-qno="1" class="remove__question--btn" type="button">Remove Question</button>
                    </div>
                </div>
                <div id="main_option_container--1">
                    <div id="option_container--1" class="mb-3">
                        <label for="option-1-1" class="form-label">Option</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" id="option-1-1" name="option[1][]">
                            <input type="radio" name="right_1" onchange="setRightAnswer('1')">
                            <button data-qno="1" data-num="1" class="remove__option--btn" type="button">Remove</button>
                        </div>
                    </div>
                </div>
                <button data-qno="1" data-num="1" class="add__option--btn" type="button">Add Option</button>
            </div>
        </div>

        <button id="add__question--btn" type="button" class="btn btn-success add__question--btn">Add Question</button>
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
