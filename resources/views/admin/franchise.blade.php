@extends('admin.layout.app')

@section('title', 'Centralized Pathlab Admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-primary">Franchise Network Management</h2>
            <p class="text-muted">Manage all pathlab franchises from a centralized dashboard</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.addfranchise') }}" class="btn btn-success">
                <i class="fas fa-plus-circle me-2"></i>Add New Franchise
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">Franchise Directory</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" id="franchiseSearch" placeholder="Search franchises...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-auto">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Lab</th>
                            <th>Location</th>
                            <th>Administrator</th>
                            <th>Operations</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($franchise as $franchises)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $franchises->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($franchises->franchise_image)
                                    <div class="me-3">
                                        <img src="{{ asset('storage/' . $franchises->franchise_image) }}" 
                                             class="rounded-circle" alt="{{ $franchises->lab_name }}" width="40" height="40">
                                    </div>
                                    @else
                                    <div class="me-3">
                                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-building text-secondary"></i>
                                        </div>
                                    </div>
                                    @endif
                                    <div>
                                        <p class="fw-bold mb-0">{{ $franchises->lab_name }}</p>
                                        <p class="text-muted mb-0 small">ID: #{{ $franchises->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="mb-0">{{ $franchises->lab_location }}</p>
                                    <p class="text-muted mb-0 small">{{ $franchises->City }}, {{ $franchises->pincode }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="mb-0">{{ $franchises->owner_name }}</p>
                                    <p class="text-muted mb-0 small">
                                        <i class="fas fa-envelope me-1"></i>{{ $franchises->email }}
                                    </p>
                                    <p class="text-muted mb-0 small">
                                        <i class="fas fa-phone-alt me-1"></i>{{ $franchises->contact }}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="mb-1">
                                        <span class="badge bg-info text-dark me-1">
                                            <i class="fas fa-users me-1"></i>{{ $franchises->number_of_employees }} Staff
                                        </span>
                                    </div>
                                    <div class="mb-1">
                                        <span class="badge bg-light text-dark">
                                            <i class="far fa-clock me-1"></i>{{ $franchises->Ohours }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="badge {{ $franchises->home_collection == 1 ? 'bg-success' : 'bg-secondary' }} me-1">
                                            <i class="fas fa-home me-1"></i>
                                            {{ $franchises->home_collection == 1 ? 'Home Collection' : 'No Home Collection' }}
                                        </span>
                                    </div>
                                    <div class="mt-1">
                                        <span class="badge {{ $franchises->insurance_accepted == 1 ? 'bg-primary' : 'bg-secondary' }}">
                                            <i class="fas fa-file-medical-alt me-1"></i>
                                            {{ $franchises->insurance_accepted == 1 ? 'Insurance Accepted' : 'No Insurance' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill {{ $franchises->Status === 'Active' ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                    <i class="fas fa-{{ $franchises->Status === 'Active' ? 'check-circle' : 'times-circle' }} me-1"></i>
                                    {{ $franchises->Status }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $franchises->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $franchises->id }}">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.franchise.edit', $franchises->id) }}">
                                                <i class="fas fa-edit me-2 text-warning"></i>Edit Info
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.franchise.delete', $franchises->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this franchise?');">
                                                    <i class="fas fa-trash-alt me-2"></i>Delete Franchise
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('franchiseSearch');
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
    
    // Status filter
    const statusFilter = document.getElementById('statusFilter');
    statusFilter.addEventListener('change', function() {
        const filterValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        if (filterValue === '') {
            tableRows.forEach(row => row.style.display = '');
            return;
        }
        
        tableRows.forEach(row => {
            const statusCell = row.querySelector('td:nth-child(7)');
            const status = statusCell.textContent.trim().toLowerCase();
            row.style.display = status.includes(filterValue) ? '' : 'none';
        });
    });
});
</script>
@endsection