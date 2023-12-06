@foreach ($posts as $post)
    <div class="card p-3 mb-3">
        <div class="post--top d-flex align-items-center gap-2 mb-3">
            <div class="post__top--img"><img class="img-fluid rounded-circle" src="{{ asset('assets/img/fixed/dp.jpg') }}" alt=""></div>
            <div>
                <p class="mb-0">{{ $post->user->name }}</p>
                <small>{{ $post->created_at }}</small>
            </div>
        </div>
        <div class="post--details">
            @if ($post->post_type == 'normal')
                {!! $post->post->post !!}
            @endif
            @if ($post->post_type == 'assignment')
                <h6>{{ $post->assignment->title }}</h6>
                <a href="{{ route('assignment.submit.page', ['id' => $post->id]) }}">Assignment Details</a>
            @endif
            @if ($post->post_type == 'quiz')
                <h6>{{ $post->quiz->title }}</h6>
                <a href="{{ route('quiz.submit.page', ['id' => $post->id]) }}">Quiz Details</a>
            @endif
        </div>
        <div class="post--down d-flex justify-content-center">
            <button class="flex-grow-1">Like</button>
            <button class="flex-grow-1">Comment</button>
        </div>
    </div>
@endforeach