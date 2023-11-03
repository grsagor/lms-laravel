@extends('front.partials.app')
@section('title')
    Create Quiz
@endsection
@section('content')
    <h1 class="text-center">Assign Quiz</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course_id }}">
        <input type="hidden" name="number_of_question" value="1" id="number_of_question">
        <div id="addable-form">
            <div id="question_container-1" class="border border-1 p-3">
                <input type="hidden" name="q1_option_no" value="1" id="q1_option_no">
                <div class="mb-3">
                    <label for="question-1" class="form-label">Question</label>
                    <input type="text" class="form-control" id="question-1">
                </div>
                <div id="option_container-1">
                    <div class="mb-3 row" id="option-1-1">
                        <div class="col-4"><label for="input-1-1" class="form-label">Option</label></div>
                        <div class="col-8">
                            <input type="text" class="form-control" id="input-1-1" name="option[1][]">
                        </div>
                    </div>
                </div>
                <button id="add_option" data-num="1" type="button">Add Option</button>
            </div>
        </div>
        <button id="add_question" type="button">Add Question</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#add_question').click(function() {
                var number_of_question = Number($('#number_of_question').val()) + 1;
                $('#number_of_question').val(number_of_question);
                var data = {
                    number_of_question: number_of_question,
                };
                $.ajax({
                    url: '/add-question',
                    type: 'GET',
                    dataType: 'json',
                    data: data,
                    success: function(response) {
                        $('#addable-form').append(response.html);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error: ' + textStatus, errorThrown);
                    }
                });
            })
        })
    </script>
@endsection
