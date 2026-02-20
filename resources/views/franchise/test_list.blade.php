@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="fw-bold text-dark mb-0">Test Management</h4>
            <p class="text-muted">Manage your diagnostic tests and pricing</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('franchise.add.test') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Add New Test
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-white p-4 border-bottom">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" id="searchTests" placeholder="Search tests by name, ID or description...">
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <select class="form-select" id="filterTests">
                        <option value="">All Tests</option>
                        <option value="low">Price: Low to High</option>
                        <option value="high">Price: High to Low</option>
                        <option value="az">Name: A to Z</option>
                        <option value="za">Name: Z to A</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr class="bg-light">
                        <th class="px-4 py-3 text-uppercase text-muted fs-7 fw-semibold">Test ID</th>
                        <th class="py-3 text-uppercase text-muted fs-7 fw-semibold">Test Name</th>
                        <th class="py-3 text-uppercase text-muted fs-7 fw-semibold">Test Description</th>
                        <th class="py-3 text-uppercase text-muted fs-7 fw-semibold">Price</th>
                        <th class="py-3 text-uppercase text-muted fs-7 fw-semibold">Home Collection Available</th>
                        <th class="py-3 text-uppercase text-muted fs-7 fw-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tests as $test)
                    <tr>
                        <td class="px-4 py-3 fw-semibold text-primary">{{$test->test_id}}</td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-light rounded p-2 me-3">
                                    <i class="fas fa-flask text-primary"></i>
                                </div>
                                <span class="fw-medium">{{$test->test_name}}</span>
                            </div>
                        </td>
                        <td class="py-3 text-muted" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{$test->test_description}}
                        </td>
                        <td class="py-3 fw-medium">₹{{number_format($test->price, 2)}}</td>
                        <td class="py-3 fw-medium">
                            {{ $test->home_collection == 1 ? 'Available' : 'Not Available' }}
                        </td>

                        <td class="py-3 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('franchise.test.edit', $test->test_id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit Test">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('franchise.test.delete', $test->test_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete Test" 
                                    onclick="return confirm('Are you sure you want to delete this test?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-vial text-muted opacity-25 fa-3x mb-3"></i>
                                <h6 class="text-muted">No tests found</h6>
                                <p class="text-muted small">Add your first diagnostic test to get started</p>
                                <a href="{{ route('franchise.test.create') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus me-2"></i>Add New Test
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="card-footer bg-white py-3 px-4 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Showing <span class="fw-medium">{{ $tests->count() }}</span> of <span class="fw-medium">{{ $tests->count() }}</span> tests 
                </div>
                
                <nav>
                    @if(method_exists($tests, 'links'))
                        {{ $tests->links() }}
                    @else
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        </ul>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
    .fs-7 {
        font-size: 0.85rem;
    }
    
    .fw-semibold {
        font-weight: 600;
    }
    
    .icon-box {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card {
        border-radius: 10px;
    }
    
    .card-header {
        background-color: transparent;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
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
    
    .pagination .page-link {
        color: #4361ee;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #4361ee;
        border-color: #4361ee;
    }
    
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    
    // Search functionality
    const searchInput = document.getElementById('searchTests');
    if(searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                const testId = row.cells[0].textContent.toLowerCase();
                const testName = row.cells[1].textContent.toLowerCase();
                const testDesc = row.cells[2].textContent.toLowerCase();
                
                if(testId.includes(searchText) || testName.includes(searchText) || testDesc.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Filter functionality
    const filterSelect = document.getElementById('filterTests');
    if(filterSelect) {
        filterSelect.addEventListener('change', function() {
            const filterValue = this.value;
            const tableRows = Array.from(document.querySelectorAll('tbody tr'));
            
            if(filterValue === '') return;
            
            tableRows.sort((a, b) => {
                const aName = a.cells[1].textContent.trim();
                const bName = b.cells[1].textContent.trim();
                const aPrice = parseFloat(a.cells[3].textContent.replace(/[^0-9.-]+/g,""));
                const bPrice = parseFloat(b.cells[3].textContent.replace(/[^0-9.-]+/g,""));
                
                if(filterValue === 'low') {
                    return aPrice - bPrice;
                } else if(filterValue === 'high') {
                    return bPrice - aPrice;
                } else if(filterValue === 'az') {
                    return aName.localeCompare(bName);
                } else if(filterValue === 'za') {
                    return bName.localeCompare(aName);
                }
            });
            
            const tbody = document.querySelector('tbody');
            tableRows.forEach(row => tbody.appendChild(row));
        });
    }
});
</script>

@endsection