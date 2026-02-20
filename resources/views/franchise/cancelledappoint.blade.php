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
                    <a href="{{ route('franchise.completed.appoint') }}" class="btn btn-outline-success">Completed</a>
                    <a href="{{ route('franchise.cancelled.appoint') }}" class="btn btn-danger">Cancelled</a>
                </div>
            </div>

            <!-- Appointments table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Appointment ID</th>
                            <th>Patient Details</th>
                            <th>Test Details</th>
                            <th>Payment ID</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Booked On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cancelledappointments as $appointment)
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="mb-0">No  appointments Cancelled </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection