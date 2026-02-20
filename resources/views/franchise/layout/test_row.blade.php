<div class="row mb-2 test-row">
    <div class="col-md-3">
        <input type="text" name="tests[][test_name]" class="form-control" placeholder="Test Name" value="{{ $testResult->test_name ?? '' }}">
    </div>
    <div class="col-md-2">
        <input type="text" name="tests[][result]" class="form-control" placeholder="Result" value="{{ $testResult->result ?? '' }}">
    </div>
    <div class="col-md-2">
        <input type="text" name="tests[][unit]" class="form-control" placeholder="Unit" value="{{ $testResult->unit ?? '' }}">
    </div>
    <div class="col-md-3">
        <input type="text" name="tests[][reference_range]" class="form-control" placeholder="Reference Range" value="{{ $testResult->reference_range ?? '' }}">
    </div>
</div>
