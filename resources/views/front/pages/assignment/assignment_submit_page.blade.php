@extends('front.partials.app')
@section('title', 'Assignment')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">

        {{-- Teacher --}}
        @if (Auth::user()->role == 'teacher')
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Marks</th>
                        <th>Files</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        @endif
        @if (Auth::user()->role == 'student')
            {{-- Student --}}
            <p><strong>Title:</strong> {{ $post->assignment->title }}</p>
            <p><strong>Description: </strong> {!! $post->assignment->description !!}</p>

            <p><strong>Attatchments:</strong></p>
            @foreach ($files as $file)
                <a class="btn bg-primary text-white" href="{{ asset($file['path']) }}" target="_blank">{{ $file['name'] }}</a>
            @endforeach

            <div>
                <form action="{{ route('submit.assignment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="assignment_id" value="{{ $post->assignment->id }}">
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label>
                        <textarea type="text" class="form-control richtext" id="comments" name="comments"></textarea>
                    </div>
                    <div class="mb-3 d-flex">
                        <input type="file" class="d-none" name="files" id="files" onchange="previewFiles()"
                            multiple>
                        <label for="files" class="btn border flex-grow-1"><i class="fa-solid fa-file"></i></label>
                    </div>
                    <div id="file-preview" class="row"></div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            @endif

    </div>


    <!-- Modal -->
    <div class="modal fade" id="assignmentReviewModal" tabindex="-1" aria-labelledby="assignmentReviewLabel"
        aria-hidden="true">

    </div>
@endsection
@section('js')
    <script>
        function previewFiles() {
            const fileInput = document.getElementById('files');
            const filePreview = document.getElementById('file-preview');

            filePreview.innerHTML = '';

            if (fileInput.files.length > 0) {
                for (let i = 0; i < fileInput.files.length; i++) {
                    const file = fileInput.files[i];
                    if (file.type.startsWith('image/')) {
                        const div = document.createElement('div');
                        div.classList.add('col-3', 'ratio-1x1')
                        const html = `<img src="${URL.createObjectURL(file)}" class="img-fluid h-100">`;
                        div.innerHTML = html;
                        filePreview.appendChild(div);
                    } else {
                        const div = document.createElement('div');
                        div.classList.add('col-12')
                        const html =
                            `<a class="btn border border-primary w-100" href="${URL.createObjectURL(file)}" target="_blank">${file.name}</a>`;
                        div.innerHTML = html;
                        filePreview.appendChild(div);
                    }
                }
            }
        }

        $(document).ready(function() {
            function loadDatatable() {
                var assignment_id = "{{ $post->assignment->id }}";
                console.log(assignment_id)
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('get.assignment.submission') }}",
                        type: 'GET',
                        data: {
                            assignment_id: assignment_id
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
                            data: 'files',
                            name: 'files'
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
                    url: "{{ route('assignment.review.modal') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(html) {
                        $('#assignmentReviewModal').html(html);
                        $('#assignmentReviewModal').modal('show');
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
                    url: "{{ route('assignment.review.update') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success('Edited');

                        $('#datatable').DataTable().destroy();
                        loadDatatable();
                        $('#assignmentReviewModal').modal('hide');
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
                            url: "{{ route('teacher.assignment.submission.delete') }}",
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
