@extends('admin.layout.app')
@section('title', 'Admin Dashboard | Appointments')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="my-2">Appointment Management</h2>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-check me-1 text-primary"></i>
                    Filter Appointments
                </h5>
                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="fas fa-filter me-1"></i> Show/Hide Filters
                </button>
            </div>
        </div>
        
        <div class="collapse show" id="filterCollapse">
            <div class="card-body bg-light">
                <form id="appointmentFilterForm" class="row g-3">
                    <div class="col-md-3">
                        <label for="statusFilter" class="form-label">Appointment Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dateFilter" class="form-label">Date Range</label>
                        <input type="date" class="form-control" id="dateFilter">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="pathologyFilter" class="form-label">Pathology</label>
                        <select class="form-select" id="pathologyFilter">
                            <option value="">All Pathologies</option>
                            @foreach($franchise as $franchise)
                                <option value="{{ $franchise->id }}">{{ $franchise->lab_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="searchFilter" class="form-label">Search</label>
                        <input type="text" class="form-control" id="searchFilter" placeholder="Patient name, ID...">
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="button" id="applyFilters" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> Apply Filters
                            </button>
                            <button type="reset" id="resetFilters" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list-alt me-1 text-primary"></i>
                    Appointments List
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="appointmentsTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Pathology</th>
                            <th>Test</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr class="appointment-row"
                            data-status="{{ $appointment->status }}"
                            data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}"
                            data-franchise="{{ $appointment->franchise_id }}"
                            data-patient="{{ strtolower($appointment->patient->name ?? '') }}"
                            data-patient-id="{{ $appointment->patient_id }}">

                                <td>{{ $appointment->appointment_id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="fw-medium">{{ $appointment->patient->name ?? 'N/A' }}</span>
                                            <br>
                                            <small class="text-muted">ID: {{ $appointment->patient_id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $appointment->franchise->lab_name ?? 'N/A' }}</td>
                                <td>{{ $appointment->test->test_name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y h:i A') }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-warning text-dark',
                                            'confirmed' => 'bg-info',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            'rescheduled' => 'bg-secondary'
                                        ];
                                        $badgeClass = $statusClass[$appointment->status] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $badgeClass }} status-badge">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($appointment->payment_id)
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-danger">Unpaid</span>
                                    @endif
                                    <small>#{{ $appointment->payment_id ?? 'N/A' }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                        <h5>No Appointments Found</h5>
                                        <p class="text-muted">There are no appointments matching your criteria</p>
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

<!-- Status Change Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Appointment Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusChangeForm" action="#" method="POST">
                @csrf
                <input type="hidden" name="appointment_id" id="appointment_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="rescheduled">Rescheduled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status_note" class="form-label">Note (Optional)</label>
                        <textarea class="form-control" id="status_note" name="status_note" rows="3" placeholder="Add a note about this status change"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
    }
    
    .avatar-initials {
        font-weight: 500;
        font-size: 14px;
    }
    
    .status-badge {
        padding: 0.5em 0.75em;
        font-size: 0.75em;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
    }
    
    .table th {
        font-weight: 600;
        white-space: nowrap;
    }
    
    .pagination {
        margin-bottom: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusFilter = document.getElementById('statusFilter');
        const dateFilter = document.getElementById('dateFilter');
        const pathologyFilter = document.getElementById('pathologyFilter');
        const searchFilter = document.getElementById('searchFilter');
        const rows = document.querySelectorAll('.appointment-row');

        function applyFilters() {
            const status = statusFilter.value.trim().toLowerCase();
            const date = dateFilter.value.trim();
            const pathology = pathologyFilter.value.trim();
            const search = searchFilter.value.trim().toLowerCase();

            rows.forEach(row => {
                const rowStatus = (row.dataset.status || '').toLowerCase();
                const rowDate = (row.dataset.date || '');
                const rowFranchise = (row.dataset.franchise || '');
                const rowPatient = (row.dataset.patient || '').toLowerCase();
                const rowPatientId = (row.dataset.patientId || '').toLowerCase();

                const matchStatus = !status || rowStatus === status;
                const matchDate = !date || rowDate === date;
                const matchFranchise = !pathology || rowFranchise === pathology;
                const matchSearch = !search || rowPatient.includes(search) || rowPatientId.includes(search);

                const visible = matchStatus && matchDate && matchFranchise && matchSearch;
                row.style.display = visible ? '' : 'none';
            });
        }

        document.getElementById('applyFilters').addEventListener('click', applyFilters);

        document.getElementById('resetFilters').addEventListener('click', () => {
            statusFilter.value = '';
            dateFilter.value = '';
            pathologyFilter.value = '';
            searchFilter.value = '';
            applyFilters();
        });
    });
</script>




@endsection