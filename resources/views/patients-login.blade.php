@extends('layouts.app')

@section('title', 'Patient Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <!-- Logo and Header -->
                    <div class="text-center mb-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-user-md text-primary" style="font-size: 28px;"></i>
                        </div>
                        <h3 class="fw-bold">Patient Login</h3>
                        <p class="text-muted">Access your pathlab dashboard</p>
                    </div>
                    
                    <!-- Alerts -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <!-- Login Form -->
                    <form method="POST" action="{{ route('patients-login') }}" class="mt-4">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control bg-light" id="email" name="email" 
                                       placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control bg-light" id="password" name="password" 
                                       placeholder="Enter your password" required>
                                <button class="btn btn-outline-secondary bg-light border-start-0" type="button" id="togglePassword">
                                    <i class="fas fa-eye-slash text-muted"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary py-2 fw-medium">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <hr class="flex-grow-1">
                            <span class="text-muted px-3">OR</span>
                            <hr class="flex-grow-1">
                        </div>
                        
                        <div class="text-center">
                            <a href="/" class="btn btn-light me-2">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                            <a href="{{ route('patient-registration') }}" class="btn btn-outline-primary">
                                <i class="fas fa-user-plus me-1"></i>Register New Account
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer bg-white p-4 text-center border-0">
                    <p class="text-muted small mb-0">
                        <i class="fas fa-shield-alt me-1"></i>
                        Your personal information is securely protected
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });
</script>


@endsection