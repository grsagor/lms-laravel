@extends('front.partials.app')
@section('title')
    {{ $course->name }}
@endsection
@section('content')
    <div class="row">
        <div class="col-3 px-3 border text-primary">
            @include('front.pages.home.left-side')
        </div>
        <div class="col-6">
            @include('front.pages.courses.main_post')
            @include('front.pages.home.middle')
        </div>
        <div class="col-3">
            @include('front.pages.home.right-side')
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
                        const html = `<a class="btn border border-primary w-100" href="${URL.createObjectURL(file)}" target="_blank">${file.name}</a>`;
                        div.innerHTML = html;
                        filePreview.appendChild(div);
                    }
                }
            }
        }
    </script>
@endsection
