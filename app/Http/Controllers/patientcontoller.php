<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\Franchise;
use App\Models\Test;
use App\Models\Payment;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\ReportTemplate;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class patientcontoller extends Controller
{
    public function index()
    {
        $patient = Auth::guard('patients')->user();

        $dob = $patient->date_of_birth;
        $age = $dob ? Carbon::parse($dob)->age : 'Not Provided';

        // 1. Profile Summary
        $profile = [
            'id' => $patient->id,
            'name' => $patient->name,
            'dob' => $dob ?? 'Not Provided',
            'age' => $age,
            'gender' => $patient->gender ?? 'Not Provided',
            'address' => $patient->address ?? 'Not Provided',
            'city' => $patient->city ?? 'Not Provide',
            'contact' => $patient->contact ?? 'Not Provided',
        ];

        // 2. Test History Summary (Past Appointments)
        $testHistory = Appointment::where('patient_id', $patient->id)
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($appointment) {
                $appointment->franchise = Franchise::find($appointment->franchise_id);
                return $appointment;
            })
            ->map(function ($test) {
                $test->test = Test::find($test->test_id);
                return $test;
            });

        // 3. Upcoming Appointments
        $upcomingAppointments = Appointment::where('patient_id', $patient->id)
            ->where('status', 'pending')
            ->whereDate('appointment_date', '>=', now())
            ->orderBy('appointment_date', 'asc')
            ->take(5)
            ->get()
            ->map(function ($appointment) {
                $appointment->franchise = Franchise::find($appointment->franchise_id);
                return $appointment;
            })
            ->map(function ($test) {
                $test->test = Test::find($test->test_id);
                return $test;
            });

        // 4. Past Reports (Fake)
        $pastReports = [
            ['title' => 'Lipid Profile', 'date' => '2025-03-01', 'summary' => 'Normal'],
            ['title' => 'Thyroid Test', 'date' => '2025-02-21', 'summary' => 'Slightly Elevated TSH'],
        ];
        // 5. Active Prescriptions (Fake)
        $activePrescriptions = [
            ['medicine' => 'Amoxicillin', 'dosage' => '500mg', 'duration' => '7 days'],
            ['medicine' => 'Calcium', 'dosage' => '1 tab daily', 'duration' => '30 days'],
        ];

        // 6. Billing Summary
        $appointments = Appointment::where('patient_id', $patient->id)->get();
        $paymentIds = $appointments->pluck('payment_id')->filter();
        $payments = Payment::whereIn('payment_id', $paymentIds)->get();
        $totalPaid = $payments->where('payment_status', 'successful')->sum('amount');
        $outstanding = $payments->where('payment_status', 'pending')->sum('amount');

        // 7. Franchise Count
        $franchiseCount = Franchise::count();

        return view('patient.index', compact(
            'profile',
            'testHistory',
            'upcomingAppointments',
            'pastReports',
            'activePrescriptions',
            'totalPaid',
            'outstanding',
            'franchiseCount',
        ));
    }

    public function profile()
    {
        $patient = Auth::guard('patients')->user();

        $dob = $patient->date_of_birth;
        $age = $dob ? Carbon::parse($dob)->age : 'Not Provided';

        // 1. Profile Summary
        $profile = [
            'id' => $patient->id,
            'name' => $patient->name,
            'dob' => $dob ?? 'Not Provided',
            'age' => $age,
            'email' => $patient->email ?? 'Not Provide',
            'gender' => $patient->gender ?? 'Not Provided',
            'address' => $patient->address ?? 'Not Provided',
            'city' => $patient->city ?? 'Not Provide',
            'contact' => $patient->contact ?? 'Not Provided',
        ];

        return view('patient.profile', compact('profile'));
    }

    public function updateprofile(Request $request, $id)
    {
        $patient = Patients::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'contact' => 'required|string|max:15',
            'email' => 'required|email|unique:patients,email,' . $id,
        ]);

        $patient->update([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'email' => $request->email,
        ]);

        return redirect()->route('patient.profile')->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $patient = Patients::find(Auth::guard('patients')->id());

        // Check if current password is correct
        if (!Hash::check($request->current_password, $patient->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $patient->password = Hash::make($request->new_password);
        $patient->save();

        return back()->with('success', 'Password changed successfully!');
    }

    public function pathlab()
    {
        $franchises = Franchise::where('Status', 'Active')->get();
        // For each franchise, count how many tests are associated
        foreach ($franchises as $franchise) {
            $franchise->test_count = Test::where('franchise_id', $franchise->id)->count();
        }

        return view('patient.pathlab', compact('franchises'));
    }

    public function pathlabsearh(Request $request)
    {
        $search = $request->input('search');

        $franchisesQuery = Franchise::where('Status', 'Active');

        if ($search) {
            $franchisesQuery->where(function ($query) use ($search) {
                $query->where('lab_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('lab_location', 'LIKE', '%' . $search . '%');
            });
        }

        $franchises = $franchisesQuery->get();

        foreach ($franchises as $franchise) {
            $franchise->test_count = Test::where('franchise_id', $franchise->id)->count();
        }

        return view('patient.pathlab', compact('franchises', 'search'));
    }

    public function showFranchiseTests($id)
    {
        $franchises = Franchise::findorFail($id);
        $tests = Test::where('franchise_id', $id)->get();

        return view('patient.check-test', compact('franchises', 'tests'));
    }

    public function bookTest(Request $request)
    {
        $payment = Payment::create([
            'amount' => $request->price,
            'payment_status' => 'pending',
        ]);

        $userId = Auth::guard('patients')->user()->id;

        // 2. Create Appointment (Pending)
        $appointment = Appointment::create([
            'patient_id' => $userId,
            'franchise_id' => $request->franchise_id,
            'test_id' => $request->test_id,
            'payment_id' => $payment->payment_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        // Store franchise image in session temporarily
        session(['franchise_scanner' => $request->franchise_scanner]);

        return redirect()->route('start.payment', ['payment_id' => $payment->payment_id]);
    }

    public function startPayment($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $franchiseImage = session('franchise_scanner');

        // Here integrate real gateway or show dummy form
        return view('patient.test-payment', compact('payment', 'franchiseImage'));
    }

    public function confirmPayment(Request $request, $payment_id)
    {
        $request->validate([
            'Transaction_id' => 'required|string|max:255',
        ]);

        $payment = Payment::findOrFail($payment_id);

        // Update payment details
        $payment->update([
            'Transaction_id' => $request->Transaction_id,
            'payment_status' => 'successful',
            'payment_date' => now(), // Optional: record confirmation date
        ]);


        return redirect()->route('patient.dashboard')->with('success', 'Payment confirmed and appointment booked successfully!');
    }

    public function upcomingtest()
    {
        $patientid = Auth::guard('patients')->user()->id;
        $pendingappointments = Appointment::with('patient', 'test', 'franchise', 'payment')
            ->where('patient_id', $patientid)
            ->where('status', 'pending')
            ->get();

        return view('patient.upcoming-test', compact('pendingappointments'));
    }

    public function deletetest($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return back()->with('success', 'Appointment Cancelled successfully!');
    }

    public function testhistory()
    {
        $patientid = Auth::guard('patients')->user()->id;
        $testhistory = Appointment::with('patient', 'test', 'franchise', 'payment', 'testReport', 'report')
            ->where('patient_id', $patientid)
            ->where('status', 'completed')
            ->get();

        return view('patient.test-history', compact('testhistory'));
    }

    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date|after:now',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->appointment_date = $request->appointment_date;
        $appointment->save();

        return back()->with('success', 'Appointment rescheduled successfully.');
    }

    public function transactionHistory()
    {
        $patient = Auth::guard('patients')->user();

        // Get all appointment IDs of the patient
        $appointmentIds = Appointment::where('patient_id', $patient->id)->pluck('appointment_id');

        // Get payment details using those appointment IDs
        $transactions = Payment::whereIn('payment_id', function ($query) use ($appointmentIds) {
            $query->select('payment_id')
                ->from('appointments')
                ->whereIn('appointment_id', $appointmentIds)
                ->whereNotNull('payment_id');
        })->orderBy('payment_date', 'desc')->get();

        return view('patient.payment', compact('transactions'));
    }

    public function viewReport($appointmentId)
    {
        // Get the logged-in patient ID
        $patientId = Auth::guard('patients')->user()->id;

        // Fetch the appointment and ensure it belongs to the logged-in patient
        $appointment = Appointment::with('patient')->where('appointment_id', $appointmentId)
            ->where('patient_id', $patientId)
            ->firstOrFail(); // Will 404 if not owned

        // Get the report for the appointment
        $report = Report::where('appointment_id', $appointmentId)->firstOrFail();

        // Get the test results associated with the report
        $testResults = TestResult::where('report_id', $report->id)->get();

        // Fetch the template using the franchise_id from the appointment
        $template = ReportTemplate::where('franchise_id', $appointment->franchise_id)->first();

        return view('patient.reportview', compact('appointment', 'report', 'testResults', 'template'));
    }

    public function downloadReport($appointmentId)
    {
         $patientId = Auth::guard('patients')->user()->id;
         $appointment = Appointment::with('patient')->where('appointment_id', $appointmentId)
             ->where('patient_id', $patientId)
             ->firstOrFail();
         $report = Report::where('appointment_id', $appointmentId)->firstOrFail();
         $testResults = TestResult::where('report_id', $report->id)->get();
         $template = ReportTemplate::where('franchise_id', $appointment->franchise_id)->first();
        $pdf = Pdf::loadView('pdf.report-pdf', compact('report', 'appointment', 'testResults', 'template'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Medical_Report_' . $report->id . '.pdf');
    }
}
