<div id="question_container--{{ $q_counter }}" class="mb-3">
    <input type="hidden" id="option__counter--1" value="1">
    <div class="mb-3">
        <label for="question-1" class="form-label">Question</label>
        <div class="d-flex">
            <input type="text" class="form-control" id="question-1" name="question[]">
            <input type="hidden" name="right_ans[]" id="right_ans--{{ $q_counter }}">
            <button data-qno="{{$q_counter}}" class="remove__question--btn" type="button">Remove Question</button>
        </div>
    </div>
    <div id="main_option_container--{{ $q_counter }}">
        <div id="option_container--1" class="mb-3">
            <label for="option-1-1" class="form-label">Option</label>
            <div class="d-flex">
                <input type="text" class="form-control" id="option-1-1" name="option[{{ $q_counter }}][]">
                <input type="radio" name="right_{{ $q_counter }}" onchange="setRightAnswer('{{ $q_counter }}')">
                <button data-qno="{{ $q_counter }}" data-num="1" class="remove__option--btn"
                    type="button">Remove</button>
            </div>
        </div>
    </div>
    <button data-qno="{{ $q_counter }}" data-num="1" class="add__option--btn" type="button">Add Option</button>
</div>
