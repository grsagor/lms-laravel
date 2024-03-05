@if (Auth::user()->role == 'teacher')
    <div class="d-flex justify-content-between">
        <p>Course Name:</p>
        <p class="fw-bold">{{ $course->name }}</p>
    </div>
    <div class="d-flex justify-content-between">
        <p>Course Code:</p>
        <p class="fw-bold">{{ $course->code }}</p>
    </div>
    <form action="{{ route('course.delete') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $course->id }}">
        <button class="btn btn-danger w-100" type="submit">Delete</button>
    </form>
    @if (count($requests))
        <h6 class="fw-bold mt-3">Requests</h6>
        @foreach ($requests as $request)
            <div class="row">
                <div class="col-6">{{ $request->user->name }}</div>
                <div class="col-6 d-flex justify-content-end">
                    <button data-type="1" data-id="{{ $request->id }}" class="btn btn-success request_action__btn"><i
                            class="fa-solid fa-circle-check"></i></button>
                    <button data-type="0" data-id="{{ $request->id }}" class="btn btn-danger ms-1 request_action__btn"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
        @endforeach
    @endif
    @if (count($students))
        <h6 class="fw-bold mt-3">All Students</h6>
        @foreach ($students as $student)
            <div class="row">
                <div class="col-6">{{ $student->user->name }}</div>
                <div class="col-6 d-flex justify-content-end">
                    <form action="{{ route('kick.student') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->user->id }}">
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <button class="btn btn-danger mb-1"><i
                            class="fa-solid fa-xmark"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@else
    <h6 class="fw-bold">Assignment Stats</h6>
    <div>
        <div class="d-flex justify-content-between">
            <p>Total Assignment:</p>
            <p>{{ $assignment_stats['count'] }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <p>Marks Percentage:</p>
            <p>{{ $assignment_stats['percentage'] }}%</p>
        </div>
    </div>
    <h6 class="fw-bold">Quiz Stats</h6>
    <div>
        <div class="d-flex justify-content-between">
            <p>Total Quiz:</p>
            <p>{{ $quiz_stats['count'] }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <p>Marks Percentage:</p>
            <p>{{ $quiz_stats['percentage'] }}%</p>
        </div>
    </div>

    <form action="{{ route('course.delete') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $course->id }}">
        <button class="btn btn-danger w-100" type="submit">Leave</button>
    </form>
@endif
