@extends('front.partials.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="row">
        <div class="col-3 px-3 border text-primary">
            @include('front.pages.home.left-side')
        </div>
        <div class="col-6">
            @include('front.pages.home.middle')
        </div>
        <div class="col-3">
            @include('front.pages.home.right-side')
        </div>
    </div>
@endsection
@section('js')
    <script>
        function handleLike(button, post_id) {
            var isLiked = $(button).hasClass('liked');
            var countContainer = $(button).find('.count_container');
            var count = parseInt(countContainer.text());
            if (isLiked) {
                count--;
            } else {
                count++;
            }

            countContainer.text(count);

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
    </script>
@endsection
