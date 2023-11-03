<div id="question_container-{{$number_of_question}}" class="border border-1 p-3">
    <input type="hidden" name="q{{$number_of_question}}_option_no" value="1" id="q{{$number_of_question}}_option_no">
    <div class="mb-3">
        <label for="question-{{$number_of_question}}" class="form-label">Question</label>
        <input type="text" class="form-control" id="question-{{$number_of_question}}">
    </div>
    <div id="option_container-1">
        <div class="mb-3 row" id="option-{{$number_of_question}}-1">
            <div class="col-4"><label for="input-{{$number_of_question}}-1" class="form-label">Option</label></div>
            <div class="col-8">
                <input type="text" class="form-control" id="input-{{$number_of_question}}-1" name="option[{{$number_of_question}}][]">
            </div>
        </div>
    </div>
</div>