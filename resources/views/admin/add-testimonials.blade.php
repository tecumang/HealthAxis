@extends('admin.layout.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-primary fw-bold mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Add Testimonial
                        </h5>
                        <a href="{{ route('admin.testmonial') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong> Please check the form and try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.testimonials.store') }}" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Client Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-secondary"></i>
                                </span>
                                <input type="text" name="name" id="name" class="form-control border-start-0 @error('name') is-invalid @enderror" placeholder="Enter client name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="designation" class="form-label fw-semibold">Designation</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-briefcase text-secondary"></i>
                                </span>
                                <input type="text" name="designation" id="designation" class="form-control border-start-0 @error('designation') is-invalid @enderror" placeholder="Enter designation" required>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="message" class="form-label fw-semibold">Testimonial Message</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-comment-alt text-secondary"></i>
                                </span>
                                <textarea name="message" id="message" class="form-control border-start-0 @error('message') is-invalid @enderror" rows="4" placeholder="Enter client testimonial" required></textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="rating" class="form-label fw-semibold"><i class="fas fa-star text-secondary"></i> Rating</label>
                                <select name="rating" id="rating" class="form-select border border-3 @error('rating') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select rating</option>
                                    <option value="1">1 - Poor</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="3">3 - Good</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="5">5 - Excellent</option>
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-light px-4">
                                    <i class="fas fa-redo me-1"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-1"></i>Save Testimonial
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection