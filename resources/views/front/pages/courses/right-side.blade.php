@if (Auth::user()->role == 'teacher')
<div class="d-flex justify-content-between">
    <p>Course Name:</p>
    <p class="fw-bold">{{ $course->name }}</p>
</div>
    <div class="d-flex justify-content-between">
        <p>Course Code:</p>
        <p class="fw-bold">{{ $course->code }}</p>
    </div>

    @if (count($requests))
        <h6 class="fw-bold mt-3">Requests</h6>
        @foreach ($requests as $request)
            <div class="row">
                <div class="col-6">{{ $request->user->name }}</div>
                <div class="col-6 d-flex justify-content-end">
                    <button data-type="1" data-id="{{ $request->id }}" class="request_action__btn"><i
                            class="fa-solid fa-circle-check"></i></button>
                    <button data-type="0" data-id="{{ $request->id }}" class="request_action__btn"><i
                            class="fa-solid fa-xmark"></i></button>
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
@endif
