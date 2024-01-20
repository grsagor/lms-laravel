<form action="" id="assignmentReviewForm">
    @csrf
    <input type="hidden" name="id" value="{{ $assignment->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="assignmentReviewLabel">Review Quiz</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="server_side_error"></div>
                
                <div class="mb-3">
                    <label for="teachers_feedback" class="form-label">Feedback</label>
                    <input type="text" class="form-control" id="teachers_feedback" name="teachers_feedback" value="{{ $assignment->teachers_feedback }}">
                </div>
                <div class="mb-3">
                    <label for="marks" class="form-label">Marks</label>
                    <input type="text" class="form-control" id="marks" name="marks" value="{{ $assignment->marks }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateBtn">Save changes</button>
            </div>
        </div>
    </div>
</form>
