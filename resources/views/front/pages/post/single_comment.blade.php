<div class="border rounded p-2 mb-2">
    <div class="post--top d-flex align-items-center gap-2">
        <div class="post__top--img"><img class="img-fluid rounded-circle"
                src="{{ asset('assets/img/fixed/dp.jpg') }}" alt=""></div>
        <div>
            <p class="mb-0">{{ $comment->user->name }}</p>
            <small>{{ $comment->created_at }}</small>
        </div>
    </div>
    <div class="post--details">
        {!! nl2br(e($comment->comment)) !!}
    </div>
</div>