@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')

<div class="container-fluid px-4 py-4">
    <!-- Header with stats cards -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1"> Payment Details</h4>
            <p class="text-muted">View and manage patient payment status</p>
        </div>
        <div class="d-flex gap-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search appointments..." id="appointmentSearch">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-calendar-check text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Total Appointments</h6>
                        <h4 class="mb-0">{{ count($appointments) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fas fa-check-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Paid</h6>
                        <h4 class="mb-0">{{ $appointments->where('payment.payment_status', 'successful')->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="fas fa-clock text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Pending</h6>
                        <h4 class="mb-0">{{ $appointments->where('payment.payment_status', 'pending')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                        <i class="fas fa-times-circle text-danger fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Failed</h6>
                        <h4 class="mb-0">{{ $appointments->where('payment.payment_status', 'failed')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 rounded-start ps-4">
                                <div class="d-flex align-items-center">
                                    <span>Appointment ID</span>
                                    <i class="fas fa-sort ms-2 text-muted fs-6"></i>
                                </div>
                            </th>
                            <th class="border-0">
                                <div class="d-flex align-items-center">
                                    <span>Patient Name</span>
                                    <i class="fas fa-sort ms-2 text-muted fs-6"></i>
                                </div>
                            </th>
                            <th class="border-0">Test Name</th>
                            <th class="border-0">
                                <div class="d-flex align-items-center">
                                    <span>Appointment Date</span>
                                    <i class="fas fa-sort ms-2 text-muted fs-6"></i>
                                </div>
                            </th>
                            <th class="border-0">Payment ID</th>
                            <th class="border-0">Amount</th>
                            <th class="border-0">Status</th>
                            <th class="border-0 rounded-end">Payment Date</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentTableBody">
                        @forelse ($appointments as $appointment)
                        <tr class="appointment-row">
                            <td class="ps-4 fw-medium">{{ $appointment->appointment_id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span>{{ $appointment->patient->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>{{ $appointment->test->test_name ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2 text-muted"></i>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y, h:i A') }}
                                </div>
                            </td>
                            <td>{{ $appointment->payment->Transaction_id ?? 'N/A' }}</td>
                            <td class="fw-medium">₹{{ $appointment->payment->amount ?? '0.00' }}</td>
                            <td>
                                <span
                                    class="badge rounded-pill 
                                    {{ $appointment->payment->payment_status === 'successful' ? 'bg-success' : 
                                       ($appointment->payment->payment_status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst($appointment->payment->payment_status ?? 'N/A') }}
                                </span>
                            </td>
                            <td>
                                {{ $appointment->payment ?
                                \Carbon\Carbon::parse($appointment->payment->payment_date)->format('d M Y') : 'N/A' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-folder-open text-muted mb-3 fs-2"></i>
                                    <p class="text-muted mb-0">No appointment records found.</p>
                                    <a href="#" class="btn btn-sm btn-outline-primary mt-3">Add New Appointment</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if(count($appointments) > 0)
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Showing <span class="fw-medium">{{ count($appointments) }}</span> records
        </div>
        <nav>
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    @endif
</div>

<style>
    .avatar-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .table thead tr th {
        font-weight: 600;
        padding-top: 12px;
        padding-bottom: 12px;
        color: #344767;
    }

    .table tbody tr td {
        padding-top: 16px;
        padding-bottom: 16px;
        color: #344767;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .badge {
        padding: 6px 12px;
        font-weight: 500;
    }

    .pagination .page-link {
        border-radius: 0.25rem;
        margin: 0 2px;
        color: #344767;
    }

    .pagination .page-item.active .page-link {
        background-color: #4361ee;
        border-color: #4361ee;
    }

    .card {
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #4361ee;
        border-color: #4361ee;
    }

    .btn-outline-primary {
        color: #4361ee;
        border-color: #4361ee;
    }

    .text-primary {
        color: #4361ee !important;
    }

    .bg-primary {
        background-color: #4361ee !important;
    }
</style>

<script>
    const searchInput = document.getElementById('appointmentSearch');
    const rows = document.querySelectorAll('.appointment-row');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>


@endsection