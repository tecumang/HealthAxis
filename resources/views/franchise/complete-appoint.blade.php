@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')
@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">Completed Appointments Details</h4>
        </div>
        <div class="card-body">
            <!-- Simple status filters -->
            <div class="mb-3">
                <div class="btn-group" role="group">
                    <a href="{{ route('franchise.appoint') }}" class="btn btn-outline-secondary">All</a>
                    <a href="{{ route('franchise.pending.appoint') }}" class="btn btn-outline-warning">Pending</a>
                    <a href="{{ route('franchise.completed.appoint') }}" class="btn btn-success">Completed</a>
                    <a href="{{ route('franchise.cancelled.appoint') }}" class="btn btn-outline-danger">Cancelled</a>
                </div>
            </div>

            <!-- Appointments table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="appointmentsTable">
                    <thead class="table-light">
                        <tr>
                            <th>Appointment ID</th>
                            <th>Patient Details</th>
                            <th>Test Details</th>
                            <th>Payment ID</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Booked On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($completeappointments as $appointment)
                        @if($appointment->report)
                        @continue
                        @endif
                        <tr>
                            <td>{{ $appointment->appointment_id }}</td>
                            <td>
                                <div class="fw-medium">
                                    <a href="{{ route('franchise.patient.show', $appointment->patient_id) }}">
                                        {{ $appointment->patient->name ?? 'N/A' }}
                                    </a>
                                </div>
                                <small class="text-muted">ID: {{ $appointment->patient_id }}</small>
                            </td>
                            <td>
                                <div class="fw-medium">{{ $appointment->test->test_name ?? 'N/A' }}</div>
                                <small class="text-muted">ID: {{ $appointment->test_id }}</small>
                            </td>
                            <td>{{ $appointment->payment->Transaction_id }}</td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</div>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</small>
                            </td>
                            <td>
                                <span class="badge 
                                    {{ 
                                        $appointment->status === 'completed' ? 'bg-success' : 
                                        ($appointment->status === 'pending' ? 'bg-warning' : 
                                        ($appointment->status === 'cancelled' ? 'bg-danger' : 'bg-secondary')) 
                                    }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>

                            <td>{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $appointment->appointment_id }}">
                                        Upload Report
                                    </button>
</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="mb-0">No appointments Complete Yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Upload Report Modal -->
@foreach($completeappointments as $appointment)
<div class="modal fade" id="uploadModal{{ $appointment->appointment_id }}" tabindex="-1" aria-labelledby="uploadModalLabel{{ $appointment->appointment_id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('franchise.report.store') }}" method="POST">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointment->appointment_id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel{{ $appointment->appointment_id }}">Upload Report - {{ $appointment->patient->name ?? 'Patient' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Report Name -->
                    <div class="mb-3">
                        <label for="report_name_{{ $appointment->appointment_id }}" class="form-label">Report Name</label>
                        <input type="text" name="report_name" class="form-control" id="report_name_{{ $appointment->appointment_id }}" value="{{ $appointment->test->test_name ?? 'N/A' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="report_description{{ $appointment->appointment_id }}" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="report_description{{ $appointment->appointment_id }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="doctore_referral{{ $appointment->appointment_id }}" class="form-label">Doctor Referral</label>
                        <input type="text" name="doctore_referral" class="form-control" id="doctore_referral{{ $appointment->appointment_id }}" required>
                    </div>

                    <!-- Test Fields (dynamic) -->
                    <div id="testFieldsContainer{{ $appointment->appointment_id }}">
                        <div class="row g-3 mb-3 test-row">
                            <div class="col-md-3">
                                <input type="text" name="tests[0][test_name]" class="form-control" placeholder="parameter  Name" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="tests[0][result]" class="form-control" placeholder="Result" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="tests[0][unit]" class="form-control" placeholder="Unit">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="tests[0][reference_range]" class="form-control" placeholder="Reference Range">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addTestRow('{{ $appointment->appointment_id }}')">
                        + Add More Parameters
                    </button>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Upload Report</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
    function addTestRow(appointmentId) {
        const container = document.getElementById(`testFieldsContainer${appointmentId}`);
        const index = container.querySelectorAll('.test-row').length;

        const newRow = document.createElement('div');
        newRow.classList.add('row', 'g-3', 'mb-3', 'test-row');
        newRow.innerHTML = `
            <div class="col-md-3">
                <input type="text" name="tests[${index}][test_name]" class="form-control" placeholder="Test Name" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="tests[${index}][result]" class="form-control" placeholder="Result" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="tests[${index}][unit]" class="form-control" placeholder="Unit">
            </div>
            <div class="col-md-3">
                <input type="text" name="tests[${index}][reference_range]" class="form-control" placeholder="Reference Range">
            </div>
        `;

        container.appendChild(newRow);
    }
</script>

@endsection