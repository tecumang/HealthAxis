@extends('patient.layout.app')

@section('title', 'Patient Dashboard')

@section('content')
<style>
    .dashboard-header {
        background-color: white;
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
        padding: 20px;
        margin-bottom: 24px;
    }

    .welcome-text {
        color: var(--primary-color);
        font-weight: 600;
    }

    .stats-card {
        height: 100%;
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .card {
        border: none;
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .card-header {
        font-weight: 600;
        padding: 15px 20px;
    }

    .primary-card .card-header {
        background-color: var(--primary-color);
        color: white;
    }

    .secondary-card .card-header {
        background-color: var(--secondary-color);
        color: white;
    }

    .profile-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .profile-card .card-body {
        padding: 25px;
    }

    .profile-info {
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
    }

    .profile-label {
        font-weight: 500;
        opacity: 0.8;
    }

    .profile-value {
        font-weight: 600;
    }

    .btn-dashboard {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-dashboard:hover {
        background-color: #303f9f;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-action {
        border-radius: 20px;
        font-size: 0.85rem;
        padding: 5px 15px;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-cancelled {
        background-color: #ffebee;
        color: #f44336;
    }

    .empty-state {
        text-align: center;
        padding: 30px;
        color: #78909c;
    }

    .summary-icon {
        font-size: 24px;
        margin-right: 10px;
        color: var(--primary-color);
    }

    .stats-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .stats-label {
        color: #78909c;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .report-item {
        border-left: 3px solid var(--primary-color);
        padding: 10px 15px;
        margin-bottom: 10px;
        background-color: white;
    }

    .prescription-item {
        border-left: 3px solid var(--secondary-color);
        padding: 10px 15px;
        margin-bottom: 10px;
        background-color: white;
    }

    @media (max-width: 767.98px) {
        .stats-card {
            margin-bottom: 15px;
        }
    }
</style>
<div class="container py-4">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="welcome-text mb-0">
                <i class="fas fa-user-circle me-2"></i> Welcome, {{ $profile['name'] }}
            </h2>
            <a href="{{route('patient.Pathlab')}}" class="btn btn-dashboard">
                <i class="fas fa-calendar-plus me-1"></i> Book New Test
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <!-- Profile Card -->
        <div class="col-md-4 mb-3">
            <div class="card profile-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Personal Profile</h5>
                    <a href="{{route('patient.profile')}}" class="text-white"><i class="fas fa-edit"></i></a>
                </div>
                <div class="card-body">
                    <div class="profile-info">
                        <span class="profile-label">ID:</span>
                        <span class="profile-value">{{ $profile['id'] }}</span>
                    </div>
                    <div class="profile-info">
                        <span class="profile-label">Name:</span>
                        <span class="profile-value">{{ $profile['name'] }}</span>
                    </div>
                    <div class="profile-info">
                        <span class="profile-label">Age:</span>
                        <span class="profile-value">{{ $profile['age'] }} Years</span>
                    </div>
                    <div class="profile-info">
                        <span class="profile-label">Date Of Birth:</span>
                        <span class="profile-value">{{ $profile['dob'] }}</span>
                    </div>
                    <div class="profile-info">
                        <span class="profile-label">Gender:</span>
                        <span class="profile-value">{{ $profile['gender'] }}</span>
                    </div>
                    <div class="profile-info">
                        <span class="profile-label">Contact:</span>
                        <span class="profile-value">{{ $profile['contact'] }}</span>
                    </div>
                    <div class="profile-info">
                        <span class="profile-label">Address:</span>
                        <span class="profile-value">{{ $profile['address'] }}, {{ $profile['city'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing Stats -->
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-file-invoice-dollar summary-icon"></i>
                        <h5 class="card-title mb-0">Billing Summary</h5>
                    </div>
                    <div class="row">
                        <div class="col-6 border-end">
                            <div class="stats-value">₹{{ $totalPaid }}</div>
                            <div class="stats-label">Total Paid</div>
                        </div>
                        <div class="col-6">
                            <div class="stats-value text-danger">₹{{ $outstanding }}</div>
                            <div class="stats-label">Outstanding</div>
                        </div>
                    </div>
                    <hr>
                    <a href="{{route('patient.payment')}}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-history me-1"></i> Payment History
                    </a>
                </div>
            </div>
        </div>

        <!-- PathLabs Card -->
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-flask summary-icon"></i>
                        <h5 class="card-title mb-0">Available PathLabs</h5>
                    </div>
                    <div class="stats-value mb-2">{{ $franchiseCount }}</div>
                    <div class="stats-label mb-3">Labs in Network</div>
                    <a href="{{route('patient.Pathlab')}}" class="btn btn-dashboard w-100">
                        <i class="fas fa-search-location me-1"></i> Find Nearest PathLab
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="card primary-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i> Upcoming Appointments</h5>
            <a href="{{route('patient.upcoming.test')}}" class="btn btn-light btn-sm">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Appointment ID</th>
                            <th>Date</th>
                            <th>PathLab Name</th>
                            <th>Location</th>
                            <th>Test</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingAppointments as $appointment)
                        <tr>
                            <td><strong>{{ $appointment->appointment_id }}</strong></td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->franchise->lab_name ?? 'N/A' }}</td>
                            <td>
                                <small>{{ $appointment->franchise->lab_location ?? 'N/A' }}</small><br>
                                <small class="text-muted">{{ $appointment->franchise->contact ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $appointment->test->test_name ?? 'N/A' }}</td>
                            <td><span class="status-badge badge-success">{{ $appointment->status }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <form
                                        action="{{ route('patient.upcomingtest.delete', $appointment->appointment_id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-times-circle me-1"></i> Cancel
                                        </button>
                                    </form>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#rescheduleModal{{ $appointment->appointment_id }}">
                                        Reschedule
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                    <p>No upcoming appointments found.</p>
                                    <a href="{{route('patient.Pathlab')}}" class="btn btn-dashboard">Book an
                                        Appointment</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Test History -->
    <div class="card secondary-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-history me-2"></i> Recent Test History</h5>
            <a href="{{route('patient.history.test')}}" class="btn btn-light btn-sm">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Appointment ID</th>
                            <th>Date</th>
                            <th>PathLab Details</th>
                            <th>Test Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testHistory as $history)
                        <tr>
                            <td><strong>{{ $history->appointment_id }}</strong></td>
                            <td>{{ $history->appointment_date }}</td>
                            <td>
                                <strong>{{ $history->franchise->lab_name ?? 'N/A' }}</strong><br>
                                <small>{{ $history->franchise->lab_location ?? 'N/A' }}</small><br>
                                <small class="text-muted">{{ $history->franchise->contact ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $history->test->test_name ?? 'N/A' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                                    <p>No test history available.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@foreach($upcomingAppointments as $appointment)
<!-- Modal -->
<div class="modal fade" id="rescheduleModal{{ $appointment->appointment_id }}" tabindex="-1"
    aria-labelledby="rescheduleModalLabel{{ $appointment->appointment_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('appointment.reschedule', $appointment->appointment_id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rescheduleModalLabel{{ $appointment->appointment_id }}">Reschedule
                        Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="appointment_date{{ $appointment->appointment_id }}" class="form-label">New
                            Appointment
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
@endforeach

@endsection