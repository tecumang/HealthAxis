@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Reports Detailed</h3>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient</th>
                    <th>Test</th>
                    <th>Payment</th>
                    <th>Appointment Date</th>
                    <th>Report Release On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appt)
                <tr>
                    <td>{{ $appt->appointment_id }}</td>
                    <td>
                        <strong>{{ $appt->patient->name ?? 'N/A' }}</strong><br>
                        <small>ID: {{ $appt->patient_id }}</small>
                    </td>
                    <td>
                        {{ $appt->test->test_name ?? 'N/A' }}<br>
                        <small>ID: {{ $appt->test_id }}</small>
                    </td>
                    <td>
                        ₹{{ $appt->payment->amount ?? '0.00' }} <br>
                        <span class="badge bg-{{ $appt->payment->payment_status === 'successful' ? 'success' : ($appt->payment->payment_status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($appt->payment->payment_status ?? 'N/A') }}
                        </span>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M Y, h:i A') }}
                    </td>
                    <td>
                        {{ $appt->report->created_at->format('d M Y, h:i A')}}
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md">
                                <a class="btn btn-sm btn-warning" href="{{ route('franchise.report.edit', $appt->report->id) }}">
                                    Edit Report
                                </a>
                            </div>
                            <div class="col-md">
                                <a class="btn btn-sm btn-primary" href="{{route('franchise.report.view', $appt->appointment_id )}}">
                                    View Report
                                </a>

                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No appointment data found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



@endsection