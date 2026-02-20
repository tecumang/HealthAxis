@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')

<div class="container-fluid py-4">
    <!-- Header with breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Add New Test</h3>
        </div>
        <a href="{{ route('franchise.test') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Tests
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="d-flex">
            <div class="me-3">
                <i class="fas fa-check-circle fa-lg"></i>
            </div>
            <div>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">Test Details</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('franchise.test.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" name="test_name" id="test_name" class="form-control @error('test_name') is-invalid @enderror" 
                                           value="{{ old('test_name') }}" placeholder="Test Name" required>
                                    <label for="test_name">Test Name</label>
                                    @error('test_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price') }}" placeholder="Price" required>
                                    <label for="price">Price (₹)</label>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-floating">
                                <textarea name="test_description" id="test_description" class="form-control @error('test_description') is-invalid @enderror" 
                                          style="height: 120px" placeholder="Test Description">{{ old('test_description') }}</textarea>
                                <label for="test_description">Test Description</label>
                                @error('test_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Provide detailed information about the test including preparation instructions and expected duration.</div>
                        </div>
                        
                        
                        <hr class="my-4">
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium">Additional Options</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="homeCollection" name="home_collection">
                                        <label class="form-check-label" for="homeCollection">Home Collection Available</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-plus-circle me-2"></i>Add Test
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">Reset Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
    .form-floating > .form-control {
        padding: 1rem 0.75rem;
    }
    
    .form-floating > .form-control:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .btn-primary {
        background-color: #4361ee;
        border-color: #4361ee;
    }
    
    .btn-primary:hover {
        background-color: #3a56d9;
        border-color: #3a56d9;
    }
    
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .breadcrumb-item a {
        color: #4361ee;
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    
    .breadcrumb-item.active {
        color: #6c757d;
    }
    
    .form-check-input:checked {
        background-color: #4361ee;
        border-color: #4361ee;
    }
    
    .text-primary {
        color: #4361ee !important;
    }
    
    .alert-success {
        border-left: 4px solid #10b981;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>

@endsection