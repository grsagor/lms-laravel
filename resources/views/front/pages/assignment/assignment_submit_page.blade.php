@extends('front.partials.app')
@section('title', 'Assignment')
@section('content')
    <div>
        <h1>Title: {{ $post->assignment->title }}</h1>
        <p><strong>Description: </strong> {!! $post->assignment->description !!}</p>
        @foreach ($files as $file)
            <a href="{{ asset($file['path']) }}" target="_blank">{{ $file['name'] }}</a>
        @endforeach

        <div>
            <form action="{{ route('submit.assignment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control richtext" id="description" name="description"></textarea>
                </div>
                <div class="mb-3 d-flex">
                    <input type="file" class="d-none" name="files" id="files" onchange="previewFiles()" multiple>
                    <label for="files" class="btn btn-success flex-grow-1"><i class="fa-solid fa-file"></i></label>
                </div>
                <div id="file-preview" class="row"></div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
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
    </script>
@endsection