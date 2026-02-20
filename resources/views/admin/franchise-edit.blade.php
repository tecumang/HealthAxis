@extends('admin.layout.app')

@section('title', 'Edit Franchise - Centralized Pathlab Admin')

@section('content')
<div class="container-fluid mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-primary fw-bold">Edit Franchise</h4>
                            <p class="text-muted mb-0 small">Update information for "{{ $franchise->lab_name }}"</p>
                        </div>
                        <a href="{{ route('admin.franchise') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('admin.franchise.update', $franchise->id) }}" method="POST" enctype="multipart/form-data" id="editFranchiseForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-7 pe-md-4">
                                <h5 class="border-bottom pb-2 mb-4">Basic Information</h5>
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="lab_name" class="form-label fw-bold">Franchise Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lab_name" name="lab_name" value="{{ $franchise->lab_name }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="owner_name" class="form-label fw-bold">Owner/Admin Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ $franchise->owner_name }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="number_of_employees" class="form-label fw-bold">Number of Staff <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="number_of_employees" name="number_of_employees" value="{{ $franchise->number_of_employees }}" required>
                                    </div>
                                </div>

                                <h5 class="border-bottom pb-2 mb-4 mt-4">Contact Details</h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $franchise->email }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="contact" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="contact" name="contact" value="{{ $franchise->contact }}" required>
                                    </div>
                                </div>

                                <h5 class="border-bottom pb-2 mb-4 mt-4">Location Information</h5>
                                
                                <div class="mb-3">
                                    <label for="lab_location" class="form-label fw-bold">Complete Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="lab_location" name="lab_location" rows="3" required>{{ $franchise->lab_location }}</textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label fw-bold">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" value="{{ old('city', $franchise->City ?? '') }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="pincode" class="form-label fw-bold">Pincode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pincode" id="pincode" value="{{ old('pincode', $franchise->pincode ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="col-md-5">
                                <div class="card bg-light border-0 mb-4">
                                    <div class="card-body">
                                        <h5 class="border-bottom pb-2 mb-4">Operational Details</h5>
                                        
                                        <div class="mb-3">
                                            <label for="operating_hours" class="form-label fw-bold">Operating Hours</label>
                                            <input type="text" class="form-control" name="Ohours" id="operating_hours" value="{{ old('Ohours', $franchise->Ohours ?? '') }}">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="form-label fw-bold d-block mb-2">Available Services</label>
                                            
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="1" name="home_collection" id="home_collection" 
                                                    {{ $franchise->home_collection == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="home_collection">
                                                    <i class="fas fa-home text-primary me-1"></i> Home Collection Available
                                                </label>
                                            </div>
                                            
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="insurance_accepted" id="insurance_accepted" 
                                                    {{ $franchise->insurance_accepted == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="insurance_accepted">
                                                    <i class="fas fa-file-medical text-primary me-1"></i> Insurance Accepted
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card bg-light border-0 mb-4">
                                    <div class="card-body">
                                        <h5 class="border-bottom pb-2 mb-4">Account Settings</h5>
                                        
                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-bold">New Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep existing">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="form-text">Leave blank to keep existing password</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="status" class="form-label fw-bold">Franchise Status</label>
                                            <select class="form-select" id="status" name="Status" required>
                                                <option value="Active" {{ $franchise->Status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $franchise->Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h5 class="border-bottom pb-2 mb-4">Franchise Branding</h5>
                                        
                                        <div class="mb-3">
                                            <label for="franchise_image" class="form-label fw-bold">Franchise Logo/Image</label>
                                            <div class="text-center mb-3 p-3 bg-white rounded border" id="imagePreviewContainer">
                                                @if($franchise->franchise_image)
                                                    <img id="imagePreview" src="{{ asset('storage/' . $franchise->franchise_image) }}" 
                                                         class="img-fluid" style="max-height: 150px; display: block;">
                                                    <div id="uploadPlaceholder" style="display: none;">
                                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                                        <p class="text-muted mb-0 mt-2">Click to upload new image</p>
                                                    </div>
                                                @else
                                                    <img id="imagePreview" src="/images/placeholder-image.png" 
                                                         class="img-fluid" style="max-height: 150px; display: none;">
                                                    <div id="uploadPlaceholder">
                                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                                        <p class="text-muted mb-0 mt-2">No image found. Click to upload.</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file" class="form-control" id="franchise_image" name="franchise_image" accept="image/*">
                                            <div class="form-text">Leave blank to keep existing image</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('admin.franchise') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Update Franchise
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    // Image preview functionality
    const imageInput = document.getElementById('franchise_image');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                uploadPlaceholder.style.display = 'none';
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Form validation enhancement
    const form = document.getElementById('editFranchiseForm');
    
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        form.classList.add('was-validated');
    }, false);
});
</script>
@endsection