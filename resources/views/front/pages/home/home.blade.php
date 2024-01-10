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
