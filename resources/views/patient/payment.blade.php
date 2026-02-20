@extends('patient.layout.app')

@section('title', 'Patient Dashboard - Transaction History')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary">Transaction History</h2>
            <p class="text-muted">View and track all your payment records</p>
        </div>
        <div class="col-md-4 d-flex justify-content-md-end align-items-center">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search transactions..." id="txnSearchInput">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <span class="fw-bold text-dark">Your Payment Records</span>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="all">All Statuses</option>
                        <option value="successful">Successful</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            @if($transactions->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="transactionsTable">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Transaction ID</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date & Time</th>
                            <th class="px-4 py-3 text-center">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $txn)
                        <tr class="transaction-row" data-status="{{ $txn->payment_status }}">
                            <td class="px-4 py-3">
                                <span class="fw-medium">{{ $txn->Transaction_id }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="fw-medium">₹{{ number_format($txn->amount, 2) }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if($txn->payment_status === 'successful')
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                        <i class="fas fa-check-circle me-1"></i> Successful
                                    </span>
                                @elseif($txn->payment_status === 'pending')
                                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                        <i class="fas fa-clock me-1"></i> Pending
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                        <i class="fas fa-times-circle me-1"></i> Failed
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex flex-column">
                                    <span class="text-dark">{{ \Carbon\Carbon::parse($txn->payment_date)->format('d M Y') }}</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($txn->payment_date)->format('h:i A') }}</small>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#txnDetails{{ $txn->payment_id }}">
                                    View Details
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-receipt text-muted opacity-25" style="font-size: 3rem;"></i>
                <h5 class="mt-3 mb-2">No Transactions Found</h5>
                <p class="text-muted mb-4">You haven't made any payments yet.</p>
                <a href="{{ route('patient.tests') }}" class="btn btn-primary px-4 py-2">
                    Book Your First Test
                </a>
            </div>
            @endif
        </div>
        
        @if($transactions->count() > 0 && method_exists($transactions, 'links'))
        <div class="card-footer bg-white py-3">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Transaction Details Modal -->
@foreach($transactions as $txn)
<div class="modal fade" id="txnDetails{{ $txn->payment_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h6 class="text-uppercase mb-1 text-muted small">Payment ID</h6>
                        <p class="mb-0 fw-medium">{{ $txn->payment_id }}</p>
                    </div>
                    <div>
                        @if($txn->payment_status === 'successful')
                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i> Successful
                            </span>
                        @elseif($txn->payment_status === 'pending')
                            <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                <i class="fas fa-clock me-1"></i> Pending
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                <i class="fas fa-times-circle me-1"></i> Failed
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-6">
                        <h6 class="text-uppercase mb-1 text-muted small">Amount</h6>
                        <p class="mb-0 fw-medium">₹{{ number_format($txn->amount, 2) }}</p>
                    </div>
                    <div class="col-6">
                        <h6 class="text-uppercase mb-1 text-muted small">Date & Time</h6>
                        <p class="mb-0">{{ \Carbon\Carbon::parse($txn->payment_date)->format('d M Y, h:i A') }}</p>
                    </div>
                    
                    <div class="col-12">
                        <hr class="my-2">
                    </div>
                    
                    <!-- Assuming additional fields - add or remove as needed -->
                    <div class="col-6">
                        <h6 class="text-uppercase mb-1 text-muted small">Payment Method</h6>
                        <p class="mb-0">{{ $txn->payment_method ?? 'Online' }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const txnSearchInput = document.getElementById('txnSearchInput');
    if (txnSearchInput) {
        txnSearchInput.addEventListener('keyup', filterTransactions);
    }
    
    // Status filter functionality
    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', filterTransactions);
    }
    
    function filterTransactions() {
        const searchValue = txnSearchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        
        const rows = document.querySelectorAll('.transaction-row');
        
        rows.forEach(row => {
            const rowData = row.textContent.toLowerCase();
            const rowStatus = row.getAttribute('data-status');
            
            const matchesSearch = rowData.includes(searchValue);
            const matchesStatus = statusValue === 'all' || rowStatus === statusValue;
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});
</script>
@endsection