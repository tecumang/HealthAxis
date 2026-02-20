@extends('franchise.layout.app')
@section('title', 'Edit Franchise Profile')
@section('content')
<div class="container py-4">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Edit Profile Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Franchise Profile</h4>
                <a href="{{ route('franchise.dashboard') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('franchise.update.profile', $franchise->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Side - Profile Image and Basic Info -->
                    <div class="col-lg-4 mb-4">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Profile Image & Basic Details</h5>

                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        <img id="profile-image-preview" src="{{ asset('storage/' . $franchise->franchise_image) }}"
                                            alt="{{ $franchise->lab_name }}" class="img-fluid rounded-circle shadow"
                                            style="width: 180px; height: 180px; object-fit: cover;">

                                        <div class="position-absolute bottom-0 end-0">
                                            <label for="franchise_image" class="btn btn-sm btn-primary rounded-circle p-2"
                                                data-bs-toggle="tooltip" title="Change profile image">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                        </div>

                                        <input type="file" name="franchise_image" id="franchise_image" class="d-none"
                                            accept="image/*" onchange="previewImage(this)">
                                    </div>

                                    <div class="mt-2 text-muted">
                                        <small>Click the camera icon to change your profile image</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="scanner" class="form-label">Payment Scanner*</label>
                                    <div class="text-center mb-4">
                                        <div class="position-relative d-inline-block">
                                            <img id="profile-scanner-preview" src="{{ asset('storage/' . $franchise->franchise_scanner) }}"
                                                alt="{{ $franchise->lab_name }}" class="img-fluid shadow"
                                                style="width: 180px; height: 180px; object-fit: cover;">

                                            <div class="position-absolute bottom-0 end-0">
                                                <label for="franchise_scanner" class="btn btn-sm btn-primary rounded-circle p-2"
                                                    data-bs-toggle="tooltip" title="Change profile image">
                                                    <i class="fas fa-camera"></i>
                                                </label>
                                            </div>

                                            <input type="file" name="franchise_scanner" id="franchise_scanner" class="d-none"
                                                accept="image/*" onchange="previewScanner(this)">
                                        </div>

                                        <div class="mt-2 text-muted">
                                            <small>Click the camera icon to change your Payment Scanner</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="lab_name" class="form-label">Lab Name*</label>
                                    <input type="text" class="form-control @error('lab_name') is-invalid @enderror"
                                        id="lab_name" name="lab_name" value="{{ old('lab_name', $franchise->lab_name) }}" required>
                                    @error('lab_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="franchise_id" class="form-label">Franchise ID</label>
                                    <input type="text" class="form-control bg-light" value="{{ $franchise->id }}" readonly>
                                    <div class="form-text">Franchise ID cannot be changed</div>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Account Status</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-circle text-{{ $franchise->Status === 'Active' ? 'success' : 'danger' }}"></i>
                                        </span>
                                        <input type="text" class="form-control bg-light" value="{{ $franchise->Status }}" readonly>
                                    </div>
                                    <div class="form-text">Status is managed by administrators</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Detailed Information -->
                    <div class="col-lg-8">
                        <div class="card border shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Owner Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="owner_name" class="form-label">Owner Name*</label>
                                        <input type="text" class="form-control @error('owner_name') is-invalid @enderror"
                                            id="owner_name" name="owner_name"
                                            value="{{ old('owner_name', $franchise->owner_name) }}" required>
                                        @error('owner_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $franchise->email) }}" required>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="contact" class="form-label">Phone Number*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel" class="form-control @error('contact') is-invalid @enderror"
                                                id="contact" name="contact" value="{{ old('contact', $franchise->contact) }}" required>
                                            @error('contact')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-building me-2"></i>Lab Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="lab_location" class="form-label">Lab Address*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            <textarea class="form-control @error('lab_location') is-invalid @enderror"
                                                id="lab_location" name="lab_location"
                                                rows="2" required>{{ old('lab_location', $franchise->lab_location) }}</textarea>
                                            @error('lab_location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="city" class="form-label">City*</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            id="city" name="City" value="{{ old('city', $franchise->City ?? '') }}" required>
                                        @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="pincode" class="form-label">Pincode*</label>
                                        <input type="text" class="form-control @error('pincode') is-invalid @enderror"
                                            id="pincode" name="pincode" value="{{ old('pincode', $franchise->pincode ?? '') }}" required>
                                        @error('pincode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="number_of_employees" class="form-label">Number of Employees</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                            <input type="number" class="form-control @error('number_of_employees') is-invalid @enderror"
                                                id="number_of_employees" name="number_of_employees"
                                                value="{{ old('number_of_employees', $franchise->number_of_employees) }}" min="1">
                                            @error('number_of_employees')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="operating_hours" class="form-label">Operating Hours</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            <input type="text" class="form-control @error('operating_hours') is-invalid @enderror"
                                                id="operating_hours" name="Ohours"
                                                value="{{ old('operating_hours', $franchise->operating_hours ?? '9:00 AM - 7:00 PM') }}"
                                                placeholder="e.g. 9:00 AM - 7:00 PM">
                                            @error('operating_hours')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="about" class="form-label">About Lab</label>
                                        <textarea class="form-control @error('about') is-invalid @enderror"
                                            id="about" name="description" rows="3"
                                            placeholder="Brief description about your lab...">{{ old('about', $franchise->description ?? '') }}</textarea>
                                        @error('about')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border shadow-sm mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Security</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                id="current_password" name="current_password">
                                            <div class="form-text">Required only if changing password</div>
                                            @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                                id="new_password" name="new_password">
                                            @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control"
                                                id="new_password_confirmation" name="new_password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border shadow-sm mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Service Options</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column gap-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="home_collection"
                                                    name="home_collection" value="1"
                                                    {{ old('home_collection', $franchise->home_collection ?? 0) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="home_collection">
                                                    <strong>Home Collection</strong>
                                                    <p class="form-text mb-0">Enable sample collection at patient's home</p>
                                                </label>
                                            </div>


                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="insurance_accepted"
                                                    name="insurance_accepted" value="1"
                                                    {{ old('insurance_accepted', $franchise->insurance_accepted ?? 0) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="insurance_accepted">
                                                    <strong>Accept Insurance</strong>
                                                    <p class="form-text mb-0">Allow patients to use insurance for payment</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-0">
                                        <small><i class="fas fa-info-circle me-1"></i> All fields marked with * are required</small>
                                    </p>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('franchise.dashboard') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <form action="{{ route('franchise.upload.template', $franchise->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="header_image" class="form-label">Upload Header Image (2481x350 pixels)</label>
                    <input type="file" name="header_image" id="header_image" class="form-control" accept="image/*" required>
                </div>
        
                <div class="mb-3">
                    <label for="footer_image" class="form-label">Upload Footer Image (2481x350 pixels)</label>
                    <input type="file" name="footer_image" id="footer_image" class="form-control" accept="image/*" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Upload Template</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to preview image before upload
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profile-image-preview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewScanner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profile-scanner-preview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>

<script>
    // Function to check image dimensions before uploading
    function checkImageDimensions(inputId, maxWidth, maxHeight) {
        const fileInput = document.getElementById(inputId);
        const file = fileInput.files[0];
        
        if (file) {
            const img = new Image();
            img.onload = function () {
                if (img.width !== maxWidth || img.height !== maxHeight) {
                    alert(`The image must be ${maxWidth}x${maxHeight} pixels.`);
                    fileInput.value = ''; // Clear the input
                }
            };
            img.src = URL.createObjectURL(file);
        }
    }

    // Attach the validation to header and footer image inputs
    document.getElementById('header_image').addEventListener('change', function() {
        checkImageDimensions('header_image', 2481, 350);
    });

    document.getElementById('footer_image').addEventListener('change', function() {
        checkImageDimensions('footer_image', 2481, 350);
    });
</script>

@endsection