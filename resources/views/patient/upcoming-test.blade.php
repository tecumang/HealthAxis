@extends('patient.layout.app')

@section('title', 'Patient Dashboard')

@section('content')
<style>
    .dashboard-card {
        border-radius: var(--border-radius);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: none;
        overflow: hidden;
    }

    .dashboard-title {
        color: var(--secondary-color);
        font-weight: 600;
    }

    .table-responsive {
        border-radius: var(--border-radius);
    }

    .custom-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table thead th {
        background-color: var(--light-gray);
        color: #495057;
        font-weight: 600;
        padding: 1rem;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        white-space: nowrap;
    }

    .franchise-cell {
        border-left: 4px solid var(--primary-color) !important;
    }

    .test-cell {
        border-left: 4px solid var(--accent-color) !important;
    }

    .custom-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        color: #495057;
    }

    .custom-table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    .id-badge {
        background-color: #f8f9fa;
        border-radius: 4px;
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #495057;
        display: inline-block;
    }

    .delete-btn {
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s;
    }

    .delete-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
<div class="container py-5">
    <h2 class="dashboard-title mb-4">Upcoming Tests</h2>
    <div class="dashboard-card card">
        <div class="table-responsive">
            <table class="custom-table table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Franchise</th>
                        <th>Location</th>
                        <th>Test Details</th>
                        <th>Transaction ID</th>
                        <th>Scheduled For</th>
                        <th>Booked On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingappointments as $appointment)
                    <tr>
                        <td>
                            <span class="id-badge">{{$appointment->appointment_id}}</span>
                        </td>
                        <td class="franchise-cell">{{ $appointment->franchise->lab_name ?? 'N/A' }}</td>
                        <td>{{ $appointment->franchise->lab_location ?? 'N/A' }}</td>
                        <td class="test-cell">
                            <div>
                                <span class="id-badge">{{$appointment->test_id}}</span>
                            </div>
                            <div class="mt-1 fw-semibold">{{ $appointment->test->test_name ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <span class="id-badge">{{$appointment->payment->Transaction_id}}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar me-2 text-primary"></i>
                                <span>{{$appointment->appointment_date}}</span>
                            </div>
                        </td>
                        <td>
                            <small class="text-muted">{{$appointment->created_at}}</small>
                        </td>
                        <td>
                            <form action="{{ route('patient.upcomingtest.delete', $appointment->appointment_id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn m-2">
                                    <i class="fas fa-times-circle me-1"></i> Cancel
                                </button>
                            </form>
                            <button class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal"
                                data-bs-target="#rescheduleModal{{ $appointment->appointment_id }}">
                                Reschedule
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <i class="far fa-calendar-times d-block"></i>
                            <p class="mb-0">No upcoming appointments scheduled</p>
                            <small class="text-muted">Your future appointments will appear here</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rescheduleModal{{ $appointment->appointment_id }}" tabindex="-1"
    aria-labelledby="rescheduleModalLabel{{ $appointment->appointment_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('appointment.reschedule', $appointment->appointment_id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rescheduleModalLabel{{ $appointment->appointment_id }}">Reschedule Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="appointment_date{{ $appointment->appointment_id }}" class="form-label">New Appointment
                            Date</label>
                        <input type="datetime-local" name="appointment_date" class="form-control"
                            id="appointment_date{{ $appointment->appointment_id }}" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection