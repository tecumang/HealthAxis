@extends('layouts.app')

@section('title', 'Patient Registration | Health Axix')

@push('styles')
<style>
    /* Modern Auth Page Specific CSS */
    body {
        background-color: #f8fafc;
    }

    .auth-wrapper {
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
        padding: 3rem 0;
    }

    .auth-card {
        border-radius: 24px;
        overflow: hidden;
        border: none;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        background: #ffffff;
    }

    /* Left Side Gradient Panel */
    .auth-sidebar {
        background: linear-gradient(135deg, var(--primary-color, #0d6efd), var(--secondary-color, #00c6ff));
        position: relative;
        overflow: hidden;
    }

    /* Decorative shapes in sidebar */
    .auth-sidebar::before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    .auth-sidebar::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: -50px;
        width: 350px;
        height: 350px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    /* Custom Form Elements */
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.85rem;
        margin-bottom: 0.3rem;
    }

    .custom-input, .custom-select {
        border-radius: 0 12px 12px 0 !important;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-left: none;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .input-group-text.custom-icon {
        border-radius: 12px 0 0 12px !important;
        border: 1px solid #e2e8f0;
        border-right: none;
        background-color: #f8fafc;
        color: #94a3b8;
        padding-left: 1rem;
        padding-right: 0.5rem;
        transition: all 0.3s ease;
    }

    /* Focus States */
    .input-group:focus-within .custom-input,
    .input-group:focus-within .custom-select,
    .input-group:focus-within .custom-icon {
        background-color: #ffffff;
        border-color: #00c6ff;
        border-top-color: #00c6ff;
        border-bottom-color: #00c6ff;
    }
    
    .input-group:focus-within .custom-icon {
        border-left-color: #00c6ff;
        color: #00c6ff;
    }
    
    .input-group:focus-within .custom-input,
    .input-group:focus-within .custom-select {
        border-right-color: #00c6ff;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 0 0.25rem rgba(0, 198, 255, 0.1);
    }

    /* Toggle Password Button */
    .toggle-password-btn {
        border-radius: 0 12px 12px 0 !important;
        border: 1px solid #e2e8f0;
        border-left: none;
        background-color: #f8fafc;
        color: #94a3b8;
    }
    .input-group:focus-within .toggle-password-btn {
        background-color: #ffffff;
        border-color: #00c6ff;
        border-right-color: #00c6ff;
    }

    .btn-gradient {
        background: linear-gradient(45deg, #00c6ff, #0072ff);
        border: none;
        color: white;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 114, 255, 0.3);
        color: white;
    }

    .floating-badge {
        animation: float 4s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Validation Error Styling */
    .is-invalid-group .custom-input,
    .is-invalid-group .custom-select,
    .is-invalid-group .custom-icon,
    .is-invalid-group .toggle-password-btn {
        border-color: #dc3545 !important;
    }
    .is-invalid-group .custom-icon {
        color: #dc3545 !important;
    }
</style>
@endpush

@section('content')
<div class="container auth-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-xl-11 col-lg-12">
            <div class="auth-card" data-aos="zoom-in" data-aos-duration="800">
                <div class="row g-0 h-100">
                    
                    <div class="col-lg-4 auth-sidebar text-white p-5 d-none d-lg-flex flex-column justify-content-between align-items-center text-center">
                        <div class="w-100 text-start">
                            <a href="/" class="text-white text-decoration-none fw-bold fs-4">
                                <i class="fas fa-microscope me-2"></i> Health Axis
                            </a>
                        </div>
                        
                        <div class="my-4 z-1">
                            <div class="floating-badge bg-white bg-opacity-25 rounded-circle p-4 d-inline-block mb-4">
                                <i class="fas fa-user-plus fa-4x text-white px-2"></i>
                            </div>
                            <h2 class="fw-bold mb-3">Join Our Network</h2>
                            <p class="fs-6 opacity-75 px-2">Create your free patient account today. Gain instant access to digital health tracking, fast home collections, and highly accurate medical reports.</p>
                        </div>
                        
                        <div class="w-100 text-start z-1">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle text-warning fs-5 me-3"></i>
                                    <span class="fw-medium text-light">Fast & Secure Access</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle text-warning fs-5 me-3"></i>
                                    <span class="fw-medium text-light">Lifetime Digital Records</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-warning fs-5 me-3"></i>
                                    <span class="fw-medium text-light">24/7 Priority Support</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-8 p-4 p-md-5">
                        <div class="px-md-2 py-2">
                            
                            <div class="text-center mb-4 d-lg-none">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                    <i class="fas fa-user-plus fs-2"></i>
                                </div>
                                <h3 class="fw-bold">Create Account</h3>
                                <p class="text-muted small">Register to access your health dashboard</p>
                            </div>

                            <div class="mb-4 d-none d-lg-block border-bottom pb-3">
                                <h3 class="fw-bold text-dark mb-1">Patient Registration</h3>
                                <p class="text-muted small mb-0">Fill in the details below to create your secure health profile.</p>
                            </div>
                            
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                                <i class="fas fa-exclamation-circle me-2 fw-bold"></i><strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            
                            <form method="POST" action="{{ route('patients.store') }}" class="mt-4">
                                @csrf
                                
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Full Name</label>
                                        <div class="input-group {{ $errors->has('name') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control custom-input" name="name" 
                                                   placeholder="e.g. John Doe" value="{{ old('name') }}" required autofocus>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Date of Birth</label>
                                        <div class="input-group {{ $errors->has('date_of_birth') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control custom-input text-muted" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Gender</label>
                                        <div class="input-group {{ $errors->has('gender') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-venus-mars"></i></span>
                                            <select class="form-select custom-select" name="gender" required>
                                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Contact Number</label>
                                        <div class="input-group {{ $errors->has('contact') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-phone-alt"></i></span>
                                            <input type="tel" class="form-control custom-input" name="contact" 
                                                   placeholder="e.g. 9876543210" value="{{ old('contact') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <div class="input-group {{ $errors->has('city') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-city"></i></span>
                                            <input type="text" class="form-control custom-input" name="city" 
                                                   placeholder="Enter your city" value="{{ old('city') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Complete Address</label>
                                        <div class="input-group {{ $errors->has('address') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-map-marker-alt"></i></span>
                                            <input type="text" class="form-control custom-input" name="address" 
                                                   placeholder="House/Flat No., Street, Landmark" value="{{ old('address') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4 mb-2">
                                        <h6 class="fw-bold text-dark border-bottom pb-2">Account Security</h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <div class="input-group {{ $errors->has('email') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control custom-input" name="email" 
                                                   placeholder="name@example.com" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Create Password</label>
                                        <div class="input-group {{ $errors->has('password') ? 'is-invalid-group' : '' }}">
                                            <span class="input-group-text custom-icon"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control custom-input border-end-0" id="password" name="password" 
                                                   placeholder="Minimum 8 characters" required>
                                            <button class="btn toggle-password-btn border-start-0" type="button" id="togglePasswordBtn">
                                                <i class="fas fa-eye-slash" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms" required>
                                            <label class="form-check-label small text-muted" for="terms">
                                                I agree to the <a href="#" class="text-primary text-decoration-none">Terms of Service</a> and <a href="#" class="text-primary text-decoration-none">Privacy Policy</a>.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="d-flex flex-column flex-sm-row gap-3">
                                            <button type="submit" class="btn btn-gradient btn-lg py-3 fw-bold shadow-sm w-100">
                                                Create Account <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 text-center mt-4">
                                        <p class="text-muted small mb-0">
                                            Already have an account? 
                                            <a href="{{ route('patient-login') }}" class="text-primary fw-bold text-decoration-none ms-1">Sign In Here</a>
                                        </p>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="text-center mt-4 pb-3">
                <p class="text-muted small mb-0">
                    <i class="fas fa-shield-alt text-success me-1"></i> SSL Secured Registration Process
                </p>
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye', 'text-primary');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye', 'text-primary');
                    toggleIcon.classList.add('fa-eye-slash');
                }
            });
        }
    });
</script>
@endpush