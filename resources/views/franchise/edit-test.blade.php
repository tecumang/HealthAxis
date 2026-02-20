@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')

<div class="container-fluid py-4">
    <!-- Header with breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Edit Test</h3>
        </div>
        <a href="{{ route('franchise.test') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Tests
        </a>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('franchise.test.update', $test->test_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input type="text" name="test_name" id="test_name" class="form-control @error('test_name') is-invalid @enderror" 
                                           value="{{ old('test_name', $test->test_name) }}" placeholder="Test Name" required>
                                    <label for="test_name">Test Name</label>
                                    @error('test_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price', $test->price) }}" placeholder="Price" required>
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
                                          style="height: 120px" placeholder="Test Description">{{ old('test_description', $test->test_description) }}</textarea>
                                <label for="test_description">Test Description</label>
                                @error('test_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Include details about preparation, duration, and other important information.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium">Additional Options</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="homeCollection" 
                                            name="home_collection"
                                            value="1"
                                            {{ old('home_collection', $test->home_collection) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="homeCollection">Home Collection Available</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Update Test
                            </button>
                            <a href="{{ route('franchise.test') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Test Information</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Test ID</span>
                        <span class="fw-medium">{{ $test->test_id }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Created On</span>
                        <span>{{ $test->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Last Updated</span>
                        <span>{{ $test->updated_at->format('d M Y') }}</span>
                    </div>
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
</style>

@endsection