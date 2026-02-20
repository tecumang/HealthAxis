@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <!-- Logo and Header -->
                    <div class="text-center mb-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-award text-primary" style="font-size: 28px;"></i>
                        </div>
                        <h3 class="fw-bold">Admin Login</h3>
                        <p class="text-muted">Access your Superadmin dashboard</p>
                    </div>
                    <!-- Login Form -->
                    <form method="POST" action="{{ route('admin-logins') }}" class="mt-4">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection