<form action="{{ route('store.normal.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <textarea name="post" id="post" cols="30" rows="5" class="richtext"></textarea>
    <input type="file" class="d-none" name="files" id="files" onchange="previewFiles()" multiple>
    <input type="hidden" name="course_id" value="{{ $course->id }}">
    <div class="d-flex justify-content-center">
        <label for="files" class="btn btn-success flex-grow-1"><i class="fa-solid fa-file"></i></label>
        @if (Auth::user()->role == 'teacher')
        <div class="dropdown flex-grow-1">
            <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Add
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('assignment.create.page', ['course_id' => $course->id]) }}">Assignment</a></li>
              <li><a class="dropdown-item" href="{{ route('quiz.create.page', ['course_id' => $course->id]) }}">Quiz</a></li>
            </ul>
          </div>
        @endif
        <button type="submit" class="btn btn-primary flex-grow-1">Post</button>
    </div>
</form>
<div id="file-preview" class="row"></div>