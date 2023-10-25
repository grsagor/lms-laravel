@extends('front.partials.app')
@section('title')
    Create Assignment
@endsection
@section('content')
    <h1 class="text-center">Assign Task</h1>
    <form action="{{ route('store.create.assignment') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
        <div class="mb-3 d-flex">
            <input type="file" class="d-none" name="files" id="files" onchange="previewFiles()" multiple>
            <label for="files" class="btn btn-success flex-grow-1"><i class="fa-solid fa-file"></i></label>
        </div>

        <div id="file-preview" class="row"></div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
    </script>
@endsection
