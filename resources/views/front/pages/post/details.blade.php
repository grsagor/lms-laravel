@extends('front.partials.app')
@section('title')
    Post
@endsection
@section('css')
    <style>
        .comment-btn-icon {
            visibility: visible !important;
        }
        .comment-btn-loading .comment-btn-icon {
            visibility: hidden !important;
        }
        .comment-btn-loader {
            visibility: hidden !important;
        }
        .comment-btn-loading .comment-btn-loader {
            visibility: visible !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-3 px-3 border text-primary">
            @include('front.pages.home.left-side')
        </div>
        <div class="col-6">
            <div class="card p-3 mb-3">
                <div class="post--top d-flex align-items-center gap-2 mb-3">
                    <div class="post__top--img"><img class="w-100 h-100 object-fit-cover rounded-circle"
                            src="{{ Auth::user()->dp ? asset(Auth::user()->dp) : asset('assets/img/fixed/dp.jpg') }}" alt=""></div>
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
                        <a class="btn bg-primary text-white"
                            href="{{ route('assignment.submit.page', ['id' => $post->id]) }}">Assignment Details</a>
                    @endif
                    @if ($post->post_type == 'quiz')
                        <h6>{{ $post->quiz->title }}</h6>
                        <a class="btn bg-primary text-white"
                            href="{{ route('quiz.submit.page', ['id' => $post->id]) }}">Quiz Details</a>
                    @endif
                </div>
                <div class="post--down d-flex gap-2 justify-content-center mt-3">
                    <button class="btn border flex-grow-1 {{ $post->is_liked ? 'liked' : '' }}"
                        onclick='handleLike(this,"{{ $post->id }}")'>Like</button>
                    <a href="{{ route('post.details', ['id' => $post->id]) }}" class="btn border flex-grow-1">Comment</a>
                </div>

                <div class="comment_section_container mt-3">
                    <label for="comment" class="form-label">Comment</label>
                    <div class="d-flex gap-2">
                        <div class="mb-3 flex-grow-1">
                            <textarea class="form-control resize-none" id="comment" rows="3"></textarea>
                        </div>
                        <div>
                            <button class="btn btn-primary position-relative" id="comment_store">
                                <i class="fa-solid fa-paper-plane comment-btn-icon"></i>
                                <div class="comment-btn-loader position-absolute top-0 bottom-0 start-0 end-0 d-flex justify-content-center align-items-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                      </div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="comments_container">
                        @foreach ($post->comments as $comment)
                            @include('front.pages.post.single_comment')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            @include('front.pages.home.right-side')
        </div>
    </div>
@endsection
@section('js')
    <script>
        function handleLike(button, post_id) {
            $(button).toggleClass('liked disliked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('post.like.store') }}",
                type: "POST",
                data: {
                    post_id: post_id
                },
                success: function(response) {

                },
                error: function(xhr) {

                },
            })
        }

        $(document).ready(function() {
            $(document).on('click', '#comment_store', function() {
                $(this).addClass('comment-btn-loading');
                var data = {
                    id: "{{ $post->id }}",
                    comment: $('#comment').val()
                };
                $('#comment').val('');
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: "{{ route('post.comment.store') }}",
                    type: "POST",
                    data: data,
                    dataType: "html",
                    success: function(html) {
                        $('#comment_store').removeClass('comment-btn-loading');
                        $('.comments_container').prepend(html);
                    }
                })
            })
        })
    </script>
@endsection
