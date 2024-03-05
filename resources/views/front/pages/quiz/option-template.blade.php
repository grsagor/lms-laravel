<div id="option_container--{{ $o_couonter }}" class="mb-3">
    <label for="option-{{ $o_couonter }}-1" class="form-label">Option</label>
    <div class="d-flex">
        <input type="text" class="form-control" id="option-{{ $o_couonter }}-1" name="option[{{ $q_counter }}][]">
        <input type="radio" name="right_{{ $q_counter }}" onchange="setRightAnswer('{{ $q_counter }}')">
        <button data-qno="{{ $q_counter }}" data-num="{{ $o_couonter }}" class="remove__option--btn btn btn-danger" type="button"><i class="fa-solid fa-xmark"></i></button>
    </div>
</div>