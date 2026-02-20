@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Patient Details</h3>

    <!-- Profile Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ $patient->name }}'s Profile</h5>
        </div>
        <div class="card-body row g-3">
            <div class="col-md-6">
                <p><strong>Patient ID:</strong> {{ $patient->id }}</p>
                <p><strong>Email:</strong> {{ $patient->email }}</p>
                <p><strong>Contact:</strong> {{ $patient->contact }}</p>
                <p><strong>City:</strong> {{ $patient->city }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Gender:</strong> {{ $patient->gender }}</p>
                <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') }}</p>
                <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} years</p>
                <p><strong>Address:</strong> {{ $patient->address }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <!-- <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Recent Appointments</h5>
        </div>
        <div class="card-body table-responsive">
            @php
                $appointments = \App\Models\Appointment::with('test', 'payment')
                    ->where('patient_id', $patient->id)
                    ->where('franchise_id', Auth::guard('franchise')->id())
                    ->latest()->take(10)->get();
            @endphp

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Appointment ID</th>
                        <th>Test</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appoint)
                    <tr>
                        <td>{{ $appoint->appointment_id }}</td>
                        <td>{{ $appoint->test->test_name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($appoint->appointment_date)->format('d M Y, h:i A') }}</td>
                        <td>
                            <span class="badge 
                                {{ $appoint->status === 'completed' ? 'bg-success' : 
                                   ($appoint->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($appoint->status) }}
                            </span>
                        </td>
                        <td>₹{{ $appoint->payment->amount ?? '0.00' }}</td>
                        <td>
                            <span class="badge 
                                {{ $appoint->payment->payment_status === 'successful' ? 'bg-success' : 
                                   ($appoint->payment->payment_status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($appoint->payment->payment_status ?? 'N/A') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No appointments found for this patient.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> -->

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('franchise.appoint') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back 
        </a>
    </div>
</div>
@endsection