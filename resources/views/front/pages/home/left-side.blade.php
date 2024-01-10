<div class="w-25 mx-auto">
    <img class="img-fluid rounded-circle" src="{{ asset('assets/img/fixed/dp.jpg') }}" alt="">
</div>
<h6 class="text-center mt-2">Nusrat Jahan</h6>

<div>
    @foreach ($data["courses"] as $course)
        <a class="w-100 border mb-2 btn text-start" href="{{ route('single.course.page', ['id' => $course->id]) }}">{{ $course->name }}</a>
    @endforeach
</div>