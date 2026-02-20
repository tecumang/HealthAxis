@extends('franchise.layout.app')

@section('title', 'Franchise Dashboard')

@section('content')
<div class="report-container" id="printArea">

    <div class="fixed-header">
        @if($template && $template->header_image)
        <img src="{{ asset('storage/' . $template->header_image) }}" alt="Header" class="img-fluid header-image">
        @endif
    </div>

    <div class="report">
        <div class="report-header">
            <div class="row mb-4">
                <div class="text-center">
                    <h2 class="fw-bold mb-0">Medical Test Report</h2>
                    <p class="text-muted mb-0">Comprehensive Health Analysis</p>
                </div>
                <div class="text-end">
                    <p class="mb-0"><strong>Report ID:</strong> #{{ $report->id }}</p>
                </div>
            </div>
            <hr class="mb-4">
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Patient Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Patient Name:</strong> {{ $appointment->patient->name ?? 'N/A' }}</p>
                        <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($appointment->patient->date_of_birth)->age }} Years</p>
                        <p><strong>Gender:</strong> {{ $appointment->patient->gender ?? 'N/A' }}</p>
                        <p><strong>Contact Number:</strong> {{ $appointment->patient->contact ?? 'N/A' }}</p>
                        <p><strong>Test Name:</strong> {{ $report->report_name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Report ID:</strong> #{{ $report->id }}</p>
                        <p><strong>Report Date:</strong> {{ $report->created_at->format('d-m-Y') }}</p>
                        <p><strong>Appointment ID:</strong> #{{ $appointment->appointment_id ?? 'N/A' }}</p>
                        <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->created_at)->format('d-m-Y') }}</p>
                        <p><strong>Transaction ID:</strong> {{ $appointment->payment->Transaction_id ?? 'No payment found' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-flask me-2"></i>Test Results</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Parameter</th>
                                <th scope="col">Result</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Reference Range</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testResults as $test)
                            <tr>
                                <td><strong>{{ $test->test_name }}</strong></td>
                                <td><strong>{{ $test->result }}</strong></td>
                                <td>{{ $test->unit }}</td>
                                <td>{{ $test->reference_range }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-comment-medical me-2"></i>Result Interpretation</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <p>{{ $report->description ?? 'No description provided' }}</p>
                </div>

                @if(isset($report->recommendation))
                <div class="mt-3">
                    <h6 class="fw-bold">Recommendations:</h6>
                    <p>{{ $report->recommendation }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>


    <div class="fixed-footer">
        @if($template && $template->footer_image)
        <img src="{{ asset('storage/' . $template->footer_image) }}" alt="Footer" class="img-fluid footer-image">
        @endif
    </div>

    <div class="text-center mt-4 mb-3 no-print">
        <a href="{{ route('franchise.report.download', $appointment->appointment_id) }}" class="btn btn-primary">
            <i class="fas fa-download me-2"></i>Download Report as PDF
        </a>
        <a href="{{ route('franchise.dashboard') }}" class="btn btn-secondary ms-2">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>
</div>

<style>
    /* Universal Styles */
    body,
    html {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        font-size: 12pt;
        background: #fff;
        color: #000;
    }

    .report-container {
        max-width: 1000px;
        /* Adjust width accordingly */
        margin: auto;
        padding: 20px;
        position: relative;
        box-sizing: border-box;
    }


    /* Hide in regular view */
    .fixed-header,
    .fixed-footer {
        width: 100%;
        height: 350px; /* Fixed height */
        position: fixed;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .fixed-header,
    .fixed-footer{
        display: none;
    }
</style>

@endsection