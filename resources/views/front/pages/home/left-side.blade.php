<div class="w-25 aspect-ratio-1x1 mx-auto mt-3">
    <img class="w-100 h-100 object-fit-cover rounded-circle" src="{{ Auth::user()->dp ? asset(Auth::user()->dp) : asset('assets/img/fixed/dp.jpg') }}" alt="">
</div>
<a href="{{ route('profile') }}" class="btn text-primary d-flex justify-content-center mt-2 mb-3">{{ Auth::user()->name }}</a>

<div>
    @foreach ($data["courses"] as $course)
        <a class="w-100 border mb-2 btn text-start" href="{{ route('single.course.page', ['id' => $course->id]) }}">{{ $course->name }}</a>
    @endforeach
</div>