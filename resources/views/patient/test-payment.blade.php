@extends('patient.layout.app')

@section('title', 'Patient Dashboard - Payment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header bg-white p-4 border-bottom">
                    <h4 class="card-title text-center mb-0">
                        <i class="fas fa-credit-card text-primary me-2"></i>Complete Your Payment
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="bg-light rounded-3 p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Payment Status</span>
                            <span class="badge bg-warning text-dark">Pending</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Payment ID</span>
                            <span class="text-dark fw-medium">{{ $payment->payment_id }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Date</span>
                            <span class="text-dark">{{ date('d M, Y') }}</span>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        @if($franchiseImage)
                            <img src="{{ asset('storage/' . $franchiseImage) }}" alt="Franchise Logo" class="img-fluid shadow-sm p-1 border" style="max-width: 120px; max-height: 120px; object-fit: contain;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                                <i class="fas fa-hospital text-secondary" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>

                    <div class="text-center mb-4">
                        <div class="d-flex justify-content-center align-items-baseline">
                            <span class="fs-6 me-2">Amount to Pay:</span>
                            <h3 class="text-primary fw-bold mb-0">₹{{ number_format($payment->amount, 2) }}</h3>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('confirm.payment', $payment->payment_id) }}" class="mt-4">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="form-label fw-medium mb-2">
                                <i class="fas fa-receipt text-muted me-2"></i>Transaction ID
                            </label>
                            <div class="input-group">
                                <input class="form-control bg-light" type="text" name="Transaction_id" 
                                       placeholder="Enter your payment transaction ID" required>
                                <span class="input-group-text bg-light border-start-0">
                                    <i class="fas fa-check-circle text-muted"></i>
                                </span>
                            </div>
                            <small class="text-muted mt-1">Please enter the Transaction ID for your Payment Proof</small>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="fas fa-check-circle me-2"></i>Confirm Payment
                            </button>
                            <a href="{{ route('patient.dashboard') }}" class="btn btn-light py-2">
                                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer bg-white text-center p-3 border-top">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>
                        Your payment information is secure and encrypted
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection