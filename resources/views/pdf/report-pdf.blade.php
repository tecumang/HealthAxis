<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Medical Report - #{{ $report->id }}</title>
    <style>
        @page {
            margin: 160px 50px 160px 50px;
            /* top, right, bottom, left */
        }

        header {
            position: fixed;
            top: -130px;
            left: 0;
            right: 0;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -130px;
            left: 0;
            right: 0;
            text-align: center;
        }


        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header,
        .footer {
            width: 100%;
            text-align: center;
        }

        .header img,
        .footer img {
            width: 100%;
            height: auto;
        }

        .report-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            background-color: #f2f2f2;
            padding: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        .table th,
        .table td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .col-md-6 {
            width: 50% !important;
            padding: 0 15px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

<header>
    @if($template && $template->header_image)
        <img src="{{ public_path('storage/' . $template->header_image) }}" style="width: 100%;" alt="Header">
    @endif
</header>

    <div class="report-title">
        <h2>Medical Test Report</h2>
        <p>Comprehensive Health Analysis</p>
    </div>

    <div class="section">
        <div class="section-title">Patient Information</div>
        <div class="row">
            <table style="width: 100%; margin-top: 10px;">
                <tr>
                    <td><strong>Name:</strong> {{ $appointment->patient->name ?? 'N/A' }}</td>
                    <td><strong>Age:</strong> {{ \Carbon\Carbon::parse($appointment->patient->date_of_birth)->age }} Years</td>
                </tr>
                <tr>
                    <td><strong>Report ID:</strong> #{{ $report->id }}</td>
                    <td><strong>Report Date:</strong> {{ $report->created_at->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Gender:</strong> {{ $appointment->patient->gender ?? 'N/A' }}</td>
                    <td><strong>Contact:</strong> {{ $appointment->patient->contact ?? 'N/A' }}</td>

                </tr>
                <tr>
                    <td><strong>Appointment ID:</strong> #{{ $appointment->appointment_id ?? 'N/A' }}</td>
                    <td><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->created_at)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Test Name:</strong> {{ $report->report_name ?? 'N/A' }}</td>
                    <td><strong>Transaction ID:</strong> {{ $appointment->payment->Transaction_id ?? 'No payment found' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Test Results</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Result</th>
                    <th>Unit</th>
                    <th>Reference Range</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testResults as $test)
                <tr>
                    <td>{{ $test->test_name }}</td>
                    <td>{{ $test->result }}</td>
                    <td>{{ $test->unit }}</td>
                    <td>{{ $test->reference_range }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Result Interpretation</div>
        <p>{{ $report->description ?? 'No description provided' }}</p>

        @if(isset($report->recommendation))
        <div class="mt-3">
            <strong>Recommendations:</strong>
            <p>{{ $report->recommendation }}</p>
        </div>
        @endif
    </div>

    <footer>
    @if($template && $template->footer_image)
        <img src="{{ public_path('storage/' . $template->footer_image) }}" style="width: 100%;" alt="Footer">
    @endif
</footer>

</body>

</html>