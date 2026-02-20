@extends('admin.layout.app')

@section('title', 'Transaction Management | Admin Dashboard')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Transaction Management</h2>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-5 border-success shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 fw-bold">₹{{ number_format($totalRevenue ?? 0, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-5 border-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">Successful Transactions</div>
                            <div class="h5 mb-0 fw-bold">{{ $successfulTransactions ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-5 border-warning shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">Pending Transactions</div>
                            <div class="h5 mb-0 fw-bold">{{ $pendingTransactions ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-start border-5 border-danger shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-danger text-uppercase mb-1">Failed Transactions</div>
                            <div class="h5 mb-0 fw-bold">{{ $failedTransactions
                                ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-filter me-1 text-primary"></i>
                    Filter Transactions
                </h5>
                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="fas fa-sliders-h me-1"></i> Filters
                </button>
            </div>
        </div>
        
        <div class="collapse show" id="filterCollapse">
            <div class="card-body bg-light">
                <form id="transactionFilterForm" class="row g-3">
                    <div class="col-md-3">
                        <label for="statusFilter" class="form-label">Payment Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Statuses</option>
                            <option value="successful">Successful</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="dateRangeFilter" class="form-label">Date Range</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="startDate">
                            <span class="input-group-text">to</span>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="amountFilter" class="form-label">Amount Range</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" id="minAmount" placeholder="Min">
                            <span class="input-group-text">-</span>
                            <input type="number" class="form-control" id="maxAmount" placeholder="Max">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="searchFilter" class="form-label">Search</label>
                        <input type="text" class="form-control" id="searchFilter" placeholder="Transaction ID...">
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

    <!-- Transactions Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-money-bill-wave me-1 text-primary"></i>
                Transactions List
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0" id="transactionsTable">
                    <thead class="table-light">
                        <tr>
                            <th>Payment ID</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr 
                            data-status="{{ $payment->payment_status }}"
                            data-amount="{{ $payment->amount }}"
                            data-date="{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}"
                            data-id="{{ strtolower($payment->Transaction_id) }}">

                                <td>
                                    <span class="fw-medium">{{ $payment->payment_id }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium">{{ $payment->Transaction_id }}</span>
                                </td>
                                <td>
                                    <strong>₹{{ number_format($payment->amount, 2) }}</strong>
                                </td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'successful' => 'bg-success',
                                            'pending' => 'bg-warning text-dark',
                                            'failed' => 'bg-danger',
                                        ];
                                        $badgeClass = $statusClass[$payment->payment_status] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($payment->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($payment->payment_date)->format('h:i A') }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-search-dollar fa-3x text-muted mb-3"></i>
                                        <h5>No Transactions Found</h5>
                                        <p class="text-muted">There are no transactions matching your criteria</p>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusFilter = document.getElementById('statusFilter');
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');
        const minAmount = document.getElementById('minAmount');
        const maxAmount = document.getElementById('maxAmount');
        const searchFilter = document.getElementById('searchFilter');
        const rows = document.querySelectorAll('#transactionsTable tbody tr');

        function applyFilters() {
            const statusVal = statusFilter.value.toLowerCase();
            const startVal = startDate.value;
            const endVal = endDate.value;
            const minVal = parseFloat(minAmount.value) || 0;
            const maxVal = parseFloat(maxAmount.value) || Infinity;
            const searchVal = searchFilter.value.toLowerCase();

            rows.forEach(row => {
                const rowStatus = row.dataset.status.toLowerCase();
                const rowAmount = parseFloat(row.dataset.amount);
                const rowDate = row.dataset.date;
                const rowId = row.dataset.id;

                const statusMatch = !statusVal || rowStatus === statusVal;
                const dateMatch = (!startVal || rowDate >= startVal) && (!endVal || rowDate <= endVal);
                const amountMatch = rowAmount >= minVal && rowAmount <= maxVal;
                const searchMatch = !searchVal || rowId.includes(searchVal);

                const showRow = statusMatch && dateMatch && amountMatch && searchMatch;
                row.style.display = showRow ? '' : 'none';
            });
        }

        document.getElementById('applyFilters').addEventListener('click', applyFilters);

        document.getElementById('resetFilters').addEventListener('click', () => {
            statusFilter.value = '';
            startDate.value = '';
            endDate.value = '';
            minAmount.value = '';
            maxAmount.value = '';
            searchFilter.value = '';
            applyFilters();
        });
    });
</script>
@endsection