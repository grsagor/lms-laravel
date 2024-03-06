@extends('front.partials.app')
@section('title')
    Post Edit
@endsection
@section('content')
    <div class="row container mx-auto">
        <form action="{{ route('post.update') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $all_post->post->id }}">
            @csrf
            <textarea name="post" id="post" cols="30" rows="5" class="richtext">{!! $all_post->post->post !!}</textarea>
            <input type="file" class="d-none" name="files" id="files" onchange="previewFiles()" multiple>
            <div class="d-flex justify-content-center">
                <label for="files" class="btn btn-success flex-grow-1"><i class="fa-solid fa-file"></i></label>
                <button type="submit" class="btn btn-primary flex-grow-1">Update</button>
            </div>
        </form>
        <div id="file-preview" class="row">
            @foreach ($all_post->post->files as $file)
                <a target="_blank" href="{{ $file['path'] }}">{{ $file['name'] }}</a>
            @endforeach
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
