<div class="w-25 aspect-ratio-1x1 mx-auto mt-3">
    <img class="w-100 h-100 object-fit-cover rounded-circle" src="{{ Auth::user()->dp ? asset(Auth::user()->dp) : asset('assets/img/fixed/dp.jpg') }}" alt="">
</div>
<a href="{{ route('profile') }}" class="btn text-primary d-flex justify-content-center mt-2 pb-0">{{ Auth::user()->name }}</a>
<p class="mb-3 text-center text-black">{{ Auth::user()->role == 'teacher' ? 'Teacher' : 'Student' }}</p>

<div>
    @foreach ($data["courses"] as $course)
        <a class="w-100 border mb-2 btn text-start {{ (request()->route()->getName() == 'single.course.page' && request()->route('id') == $course->id) ? 'active_course' : '' }}" href="{{ route('single.course.page', ['id' => $course->id]) }}">{{ $course->name }}</a>
    @endforeach
</div>