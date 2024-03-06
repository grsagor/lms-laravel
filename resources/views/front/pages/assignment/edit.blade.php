@extends('front.partials.app')
@section('title')
    Post Edit
@endsection
@section('content')
    <div class="row container mx-auto">
        <form action="{{ route('assignment.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $all_post->assignment->id }}">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $all_post->assignment->title }}">
            </div>
            <div class="mb-3">
                <label for="total_marks" class="form-label">Total marks</label>
                <input type="number" class="form-control" id="total_marks" name="total_marks" value="{{ $all_post->assignment->total_marks }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control richtext" id="description" name="description">{!! $all_post->assignment->description !!}</textarea>
            </div>
            <div class="mb-3 row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{ $all_post->assignment->deadline }}">
                    </div>
                </div>
            </div>
            <div class="mb-3 d-flex">
                <input type="file" class="d-none" name="files" id="files" onchange="previewFiles()" multiple>
                <label for="files" class="btn btn-success flex-grow-1"><i class="fa-solid fa-file"></i></label>
            </div>

            <div id="file-preview" class="row">
                @foreach ($files as $file)
                <div class="col-12 mb-3">
                    <a class="btn border border-primary w-100" href="{{ $file['path'] }}" target="_blank">{{ $file['name'] }}</a>
                </div>
            @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
                    // if (file.type.startsWith('image/')) {
                    //     const div = document.createElement('div');
                    //     div.classList.add('col-3', 'ratio-1x1', 'mb-3')
                    //     const html = `<img src="${URL.createObjectURL(file)}" class="img-fluid h-100">`;
                    //     div.innerHTML = html;
                    //     filePreview.appendChild(div);
                    // } else {
                        const div = document.createElement('div');
                        div.classList.add('col-12', 'mb-3')
                        const html =
                            `<a class="btn border border-primary w-100" href="${URL.createObjectURL(file)}" target="_blank">${file.name}</a>`;
                        div.innerHTML = html;
                        filePreview.appendChild(div);
                    // }
                }
            }
        }
    </script>
@endsection
