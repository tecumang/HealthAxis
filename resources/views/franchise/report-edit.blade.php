@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')
<div class="container mt-5">
    <h3>Edit Report for Appointment #{{ $report->appointment->appointment_id ?? 'N/A' }}</h3>
    <p><strong>Patient:</strong> {{ $report->appointment->patient->name ?? 'N/A' }}</p>

    <form method="POST" action="{{ route('franchise.update.parameter', $report->id) }}">
        @csrf
        @method('PUT')

        <div id="testContainer" data-index="{{ count($report->testResults) }}">
            @foreach($report->testResults as $index => $test)
            <div class="row g-2 mb-2 test-block border border-3 p-2 m-2" id="test-block-{{ $test->id }}">
                <input type="hidden" name="tests[{{ $index }}][id]" value="{{ $test->id }}">

                <div class="col-md-4">
                    <label>Parameter Name</label>
                    <input type="text" name="tests[{{ $index }}][test_name]" class="form-control"
                        value="{{ $test->test_name }}" placeholder="Parameter Name" required>
                </div>

                <div class="col-md-2">
                    <label>Result</label>
                    <input type="text" name="tests[{{ $index }}][result]" class="form-control"
                        value="{{ $test->result }}" placeholder="Result" required>
                </div>

                <div class="col-md-2">
                    <label>Unit</label>
                    <input type="text" name="tests[{{ $index }}][unit]" class="form-control"
                        value="{{ $test->unit }}" placeholder="Unit" required>
                </div>

                <div class="col-md-3">
                    <label>Reference Range</label>
                    <input type="text" name="tests[{{ $index }}][reference_range]" class="form-control"
                        value="{{ $test->reference_range }}" placeholder="Reference Range" required>
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-danger delete-parameter-btn"
                        data-id="{{ $test->id }}" data-bs-toggle="tooltip" title="Delete Parameter">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-outline-primary mt-3" onclick="addTestRow()">➕ Add Parameter</button>
        <br><br>
        <button type="submit" class="btn btn-success">Update Report</button>
    </form>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    let testIndex = parseInt(document.getElementById('testContainer').dataset.index || 0);

    function addTestRow() {
        const container = document.getElementById('testContainer');

        const row = document.createElement('div');
        row.classList.add('row', 'g-2', 'mb-2', 'test-block', 'border', 'border-3', 'p-2', 'm-2');
        row.id = `test-block-new-${testIndex}`;

        row.innerHTML = `
            <div class="col-md-4">
                <label>Parameter Name</label>
                <input type="text" name="tests[${testIndex}][test_name]" class="form-control" placeholder="Parameter Name" required>
            </div>
            <div class="col-md-2">
                <label>Result</label>
                <input type="text" name="tests[${testIndex}][result]" class="form-control" placeholder="Result" required>
            </div>
            <div class="col-md-2">
                <label>Unit</label>
                <input type="text" name="tests[${testIndex}][unit]" class="form-control" placeholder="Unit" required>
            </div>
            <div class="col-md-3">
                <label>Reference Range</label>
                <input type="text" name="tests[${testIndex}][reference_range]" class="form-control" placeholder="Reference Range" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger" onclick="this.closest('.test-block').remove()">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        `;

        container.appendChild(row);
        testIndex++;
    }

    document.querySelectorAll('.delete-parameter-btn').forEach(button => {
        button.addEventListener('click', function () {
            const testId = this.dataset.id;
            if (confirm('Are you sure you want to delete this parameter?')) {
                const form = document.getElementById('deleteForm');
                form.action = `/franchise/report/delete-test/${testId}`; // Make sure this route matches
                form.submit();
            }
        });
    });
</script>
@endsection
