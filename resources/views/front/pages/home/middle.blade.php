@if (count($posts))
@foreach ($posts as $post)
<div class="card p-3 mb-3">
    <div class="post--top d-flex mb-3">
        <div class="flex-1 d-flex align-items-center gap-2">
            <div class="post__top--img"><img class="w-100 h-100 object-fit-cover rounded-circle"
                    src="{{ $post->user->dp ? asset($post->user->dp) : asset('assets/img/fixed/dp.jpg') }}"
                    alt=""></div>
            <div>
                <p class="mb-0">{{ $post->user->name }}</p>
                <small>{{ $post->created_at }}</small>
            </div>
        </div>
        @if (Auth::user()->id == $post->user->id)
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-transparent text-dark dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if ($post->post_type == 'normal')
                        <li><a class="dropdown-item" href="{{ route('post.edit', ['id' => $post->id]) }}"
                                type="button">Edit</a></li>
                    @endif
                    @if ($post->post_type == 'assignment')
                        <li><a class="dropdown-item" href="{{ route('assignment.edit', ['id' => $post->id]) }}"
                                type="button">Edit</a></li>
                    @endif
                    @if ($post->post_type == 'quiz')
                        <li><a class="dropdown-item" href="{{ route('quiz.edit', ['id' => $post->id]) }}"
                                type="button">Edit</a></li>
                    @endif
                    <li>
                        <form action="{{ route('post.delete') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <input type="hidden" name="post_type" value="{{ $post->post_type }}">
                            <button class="dropdown-item" type="submit">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @endif
    </div>
    <div class="post--details">
        @if ($post->post_type == 'normal')
            {!! $post->post->post !!}
            @foreach ($post->post->files as $file)
                <a target="_blank" href="{{ $file['path'] }}">{{ $file['name'] }}</a>
            @endforeach
        @endif
        @if ($post->post_type == 'assignment')
            <h6>{{ $post->assignment->title }}</h6>
            <a class="btn bg-primary text-white"
                href="{{ route('assignment.submit.page', ['id' => $post->id]) }}">Assignment Details</a>
        @endif
        @if ($post->post_type == 'quiz')
            <h6>{{ $post->quiz->title }}</h6>
            <a class="btn bg-primary text-white" href="{{ route('quiz.submit.page', ['id' => $post->id]) }}">Quiz
                Details</a>
        @endif
    </div>
    <div class="post--down d-flex gap-2 justify-content-center mt-3">
        <button data-count="{{ $post->like_count }}"
            class="btn border flex-grow-1 {{ $post->is_liked ? 'liked' : '' }}"
            onclick='handleLike(this,"{{ $post->id }}")'><span
                class="count_container">{{ $post->like_count }}</span> <i class="fa-solid fa-heart"></i></button>
        <a href="{{ route('post.details', ['id' => $post->id]) }}" class="btn border flex-grow-1"><i
                class="fa-solid fa-comment"></i></a>
    </div>
</div>
@endforeach
@else
    <h1 class="text-center">No post found.</h1>
@endif