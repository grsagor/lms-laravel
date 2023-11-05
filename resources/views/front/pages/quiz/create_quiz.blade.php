@extends('front.partials.app')
@section('title')
    Create Quiz
@endsection
@section('content')
    <h1 class="text-center">Assign Quiz</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="question__counter" value="1">
        <div id="main__question--container">
            <div id="question_container--1" class="mb-3">
                <input type="hidden" id="option__counter--1" value="1">
                <div class="mb-3">
                    <label for="question-1" class="form-label">Question</label>
                    <div class="d-flex">
                        <input type="text" class="form-control" id="question-1">
                        <button data-qno="1" class="remove__question--btn" type="button">Remove Question</button>
                    </div>
                </div>
                <div id="main_option_container--1">
                    <div id="option_container--1" class="mb-3">
                        <label for="option-1-1" class="form-label">Option</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" id="option-1-1">
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
                        var container = $(`#question_container--${qCounter} #main_option_container--${qCounter}`);
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
@endsection
