@extends('front.partials.app')
@section('title', 'Quiz')
@section('content')
    <div class="container">

        @if (Auth::user()->role == 'teacher')
        {{-- Teacher --}}
        <table id="datatable" class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Marks</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <h3 class="text-center text-primary fw-bold">{{ $quiz->title }}</h3>
        <div>
            {!! $quiz->description !!}
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            @foreach ($quiz->quizzes as $i => $item)
                <h6>Q{{ $i + 1 }}: {{ $item->question }}</h6>
                <ul class="row list-style-none">
                    @foreach ($item->option as $ii => $single_option)
                        <li
                            class="col-12 col-md-6 {{ $answered && $item->answer == $single_option && $item->right_ans != $single_option ? 'wrong-answer' : '' }} {{ $answered && $item->right_ans == $single_option ? 'right-answer' : '' }}">
                            <input disabled {{ $answered ? 'disabled' : '' }}
                                {{ $answered && $item->answer == $single_option ? 'checked' : '' }} type="radio"
                                name="answer_{{ $i }}" id="aswer_{{ $i }}_{{ $ii }}"
                                required value="{{ $single_option }}"> <label
                                for="aswer_{{ $i }}_{{ $ii }}">{{ $single_option }}</label>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </form>
        @endif
        @if (Auth::user()->role == 'student')
            {{-- Student --}}

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
                            <li
                                class="col-12 col-md-6 {{ $answered && $item->answer == $single_option && $item->right_ans != $single_option ? 'wrong-answer' : '' }} {{ $answered && $item->right_ans == $single_option ? 'right-answer' : '' }}">
                                <input {{ $answered ? 'disabled' : '' }}
                                    {{ $answered && $item->answer == $single_option ? 'checked' : '' }} type="radio"
                                    name="answer_{{ $i }}" id="aswer_{{ $i }}_{{ $ii }}"
                                    required value="{{ $single_option }}"> <label
                                    for="aswer_{{ $i }}_{{ $ii }}">{{ $single_option }}</label>
                            </li>
                        @endforeach
                    </ul>
                @endforeach

                <button class="btn btn-primary {{ $answered ? 'd-none' : '' }}">Submit</button>
                <p class="{{ $answered ? 'd-block' : 'd-none' }}">Your mark: <strong>{{ $quiz->marks }}</strong></p>
            </form>
        @endif

    </div>

    <!-- Modal -->
    <div class="modal fade" id="quizReviewModal" tabindex="-1" aria-labelledby="quizReviewLabel" aria-hidden="true">

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            function loadDatatable() {
                var quiz_id = "{{ $quiz->id }}";
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('get.quiz.submission.list') }}",
                        type: 'GET',
                        data: {
                            quiz_id: quiz_id
                        },
                    },
                    columns: [{
                            data: 'student_name',
                            name: 'student_name'
                        },
                        {
                            data: 'marks',
                            name: 'marks'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            }
            loadDatatable();

            $(document).on('click', '.edit_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('teacher.quiz.review.modal') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('#quizReviewModal').html(html);
                        $('#quizReviewModal').modal('show');
                    }
                })
            })

            $(document).on('click', '#updateBtn', function(e) {
                e.preventDefault();
                let go_next_step = true;
                let form = document.getElementById('assignmentReviewForm');
                var formData = new FormData(form);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('teacher.quiz.review.update') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success('Edited');

                        $('#datatable').DataTable().destroy();
                        loadDatatable();
                        $('#quizReviewModal').modal('hide');
                    },
                    error: function(xhr) {
                        let errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        $('#assignmentReviewForm .server_side_error').html(
                            '<div class="alert alert-danger" role="alert">' + errorMessage);
                    },
                })
            })

            $(document).on('click', '.delete_btn', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('teacher.quiz.submission.delete') }}",
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(data) {
                                toastr.success('Deleted');
                                $('#datatable').DataTable().destroy();
                                loadDatatable();
                            }
                        })

                    }
                })
            })
        });
    </script>
@endsection
