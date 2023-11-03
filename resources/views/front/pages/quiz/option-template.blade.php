<div id="option_container--{{ $o_couonter }}" class="mb-3">
    <label for="option-{{ $o_couonter }}-1" class="form-label">Option</label>
    <div class="d-flex">
        <input type="text" class="form-control" id="option-{{ $o_couonter }}-1">
        <button data-qno="{{ $q_counter }}" data-num="{{ $o_couonter }}" class="remove__option--btn" type="button">Remove</button>
    </div>
</div>