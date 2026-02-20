@extends('layouts.app')

@section('title', 'Patient Login | Health Axis')

@push('styles')
<style>
    /* Modern Login Page Specific CSS */
    body {
        background-color: #f8fafc;
    }

    .login-wrapper {
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
        padding: 2rem 0;
    }

    .login-card {
        border-radius: 24px;
        overflow: hidden;
        border: none;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        background: #ffffff;
    }

    /* Left Side Gradient Panel */
    .login-sidebar {
        background: linear-gradient(135deg, var(--primary-color, #0d6efd), var(--secondary-color, #00c6ff));
        position: relative;
        overflow: hidden;
    }

    /* Decorative shapes in sidebar */
    .login-sidebar::before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    .login-sidebar::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: -50px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    /* Custom Form Elements */
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.9rem;
    }

    .custom-input {
        border-radius: 0 12px 12px 0 !important;
        padding: 0.8rem 1.2rem;
        border: 1px solid #e2e8f0;
        border-left: none;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .input-group-text.custom-icon {
        border-radius: 12px 0 0 12px !important;
        border: 1px solid #e2e8f0;
        border-right: none;
        background-color: #f8fafc;
        color: #94a3b8;
        padding-left: 1.2rem;
        transition: all 0.3s ease;
    }

    /* Focus States */
    .input-group:focus-within .custom-input,
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
    
    .input-group:focus-within .custom-input {
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
</style>
@endpush

@section('content')
<div class="container login-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-xl-10 col-lg-11">
            <div class="login-card" data-aos="zoom-in" data-aos-duration="800">
                <div class="row g-0 h-100">
                    
                    <div class="col-lg-5 login-sidebar text-white p-5 d-none d-lg-flex flex-column justify-content-between align-items-center text-center">
                        <div class="w-100 text-start">
                            <a href="/" class="text-white text-decoration-none fw-bold fs-4">
                                <i class="fas fa-microscope me-2"></i> Health Axis
                            </a>
                        </div>
                        
                        <div class="my-5 z-1">
                            <div class="floating-badge bg-white bg-opacity-25 rounded-circle p-4 d-inline-block mb-4">
                                <i class="fas fa-heartbeat fa-4x text-white"></i>
                            </div>
                            <h2 class="fw-bold mb-3">Welcome Back!</h2>
                            <p class="fs-6 opacity-75 px-3">Log in to your patient dashboard to download your verified digital reports, book home tests, and manage your family's health history.</p>
                        </div>
                        
                        <div class="w-100 text-start z-1">
                            <div class="d-flex align-items-center bg-white bg-opacity-10 rounded-pill p-2 px-3">
                                <i class="fas fa-shield-alt text-warning fs-5 me-2"></i>
                                <span class="small fw-medium">Your data is 256-bit encrypted.</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 p-4 p-md-5">
                        <div class="px-md-4 py-3">
                            
                            <div class="text-center mb-5 d-lg-none">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                    <i class="fas fa-user-md fs-2"></i>
                                </div>
                                <h3 class="fw-bold">Patient Login</h3>
                                <p class="text-muted">Access your pathlab dashboard</p>
                            </div>

                            <div class="mb-4 d-none d-lg-block">
                                <h3 class="fw-bold text-dark mb-1">Sign In to Account</h3>
                                <p class="text-muted small">Enter your email and password to continue.</p>
                            </div>
                            
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            
                            <form method="POST" action="{{ route('patients-login') }}" class="mt-4">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text custom-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control custom-input fs-6" id="email" name="email" 
                                               placeholder="e.g. name@example.com" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @error('email')
                                    <div class="text-danger small mt-2 fw-medium"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label for="password" class="form-label mb-0">Password</label>
                                        <a href="#" class="small text-primary text-decoration-none fw-medium">Forgot Password?</a>
                                    </div>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text custom-icon">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control custom-input border-end-0 fs-6" id="password" name="password" 
                                               placeholder="Enter your password" required>
                                        <button class="btn toggle-password-btn border-start-0" type="button" id="togglePasswordBtn">
                                            <i class="fas fa-eye-slash" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <div class="text-danger small mt-2 fw-medium"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-grid gap-2 mb-4 mt-5">
                                    <button type="submit" class="btn btn-gradient btn-lg py-3 fw-bold shadow-sm">
                                        Sign In <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <hr class="flex-grow-1 opacity-25">
                                    <span class="text-muted px-3 small fw-medium text-uppercase">New to Health Axis?</span>
                                    <hr class="flex-grow-1 opacity-25">
                                </div>
                                
                                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                                    <a href="{{ route('patient-registration') }}" class="btn btn-outline-primary fw-medium rounded-pill px-4">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </a>
                                    <a href="/" class="btn btn-light fw-medium rounded-pill px-4 text-muted border">
                                        <i class="fas fa-home me-2"></i>Return Home
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-muted small mb-0">
                    <i class="fas fa-lock me-1"></i> Secured by advanced SSL encryption technology.
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