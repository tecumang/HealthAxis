<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Payment;
use App\Models\ReportTemplate;
use Illuminate\Http\Request;
use App\Models\TestReport;
use App\Models\Report;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Element\TextRun;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Franchise;


class FranchiseController extends Controller
{

    public function dashboard()
    {
        $franchise = Auth::guard('franchise')->user();

        $franchiseId = $franchise->id;

        $profile = [
            'id' => $franchise->id,
            'name' => $franchise->lab_name,
            'gender' => $patient->gender ?? 'Not Provided',
            'address' => $patient->address ?? 'Not Provided',
            'city' => $patient->city ?? 'Not Provide',
            'contact' => $patient->contact ?? 'Not Provided',
            'franchise_scanner' => $franchise->franchise_scanner,
        ];

        $reporttemplate = ReportTemplate::where('franchise_id', $franchiseId)->first();

        // Get total tests uploaded by this franchise
        $totalTests = Test::where('franchise_id', $franchiseId)->count();

        // All appointments related to this franchise
        $totalAppointments = Appointment::where('franchise_id', $franchiseId)->count();

        $totalpatient = Appointment::where('franchise_id', $franchiseId)
            ->distinct('patient_id')
            ->count('patient_id');

        $activepatient = Appointment::where('franchise_id', $franchiseId)
            ->where('status', 'pending')
            ->distinct('patient_id')
            ->count('patient_id');


        // Today’s appointments
        $todayAppointments = Appointment::where('franchise_id', $franchiseId)
            ->whereDate('appointment_date', Carbon::today())
            ->count();

        // Completed appointments
        $completedAppointments = Appointment::where('franchise_id', $franchiseId)
            ->where('status', 'completed')->count();

        // Pending appointments
        $pendingAppointments = Appointment::where('franchise_id', $franchiseId)
            ->where('status', 'pending')->count();

        // Payments (get payments through appointments)
        $paymentIds = Appointment::where('franchise_id', $franchiseId)->pluck('payment_id');
        $totalRevenue = Payment::whereIn('payment_id', $paymentIds)
            ->where('payment_status', 'successful')
            ->sum('amount');

        $totalPayments = Appointment::where('franchise_id', $franchiseId)
            ->whereNotNull('payment_id')
            ->count('payment_id');


        // Recent Appointments (last 5)
        $recentAppointments = Appointment::where('franchise_id', $franchiseId)
            ->with('patient')
            ->latest()
            ->take(5)
            ->get();

        //Utility Function 
        $getStats = function ($start, $end) use ($franchiseId) {
            $appointments = Appointment::where('franchise_id', $franchiseId)
                ->whereBetween('appointment_date', [$start, $end])
                ->get();

            $newPatients = $appointments->pluck('patient_id')->unique()->count();
            $testsConducted = $appointments->count();

            $paymentIds = $appointments->pluck('payment_id')->filter()->unique();
            $revenue = Payment::whereIn('payment_id', $paymentIds)
                ->where('payment_status', 'successful')
                ->sum('amount');

            $reportsGenerated = $appointments->where('status', 'completed')->count();
            return compact('newPatients', 'testsConducted', 'revenue', 'reportsGenerated');
        };

        $summaryToday = $getStats(Carbon::today(), Carbon::now());
        $summaryWeek = $getStats(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $summaryMonth = $getStats(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $summaryYear = $getStats(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());

        return view('franchise.index', compact(
            'activepatient',
            'profile',
            'totalTests',
            'totalpatient',
            'totalPayments',
            'totalAppointments',
            'todayAppointments',
            'completedAppointments',
            'pendingAppointments',
            'totalRevenue',
            'recentAppointments',
            'summaryToday',
            'summaryWeek',
            'summaryMonth',
            'summaryYear',
            'reporttemplate'
        ));
    }

    public function profile()
    {
        $franchise = Auth::guard('franchise')->user();
        return view('franchise.profile', compact('franchise'));
    }

    public function test()
    {
        $franchiseId = Auth::guard('franchise')->user()->id;

        $tests = Test::where('franchise_id', $franchiseId)->get();
        return view('franchise.test_list', compact('tests'));
    }

    public function addtest()
    {
        return view('franchise.add-test');
    }

    public function storeFranchiseTest(Request $request)
    {
        $request->validate([
            'test_name' => 'required|string|max:255',
            'test_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $franchiseId = Auth::guard('franchise')->user()->id;
        // or Auth::guard('franchise')->user()->id if using guard

        Test::create([
            'franchise_id' => $franchiseId,
            'test_name' => $request->test_name,
            'test_description' => $request->test_description,
            'price' => $request->price,
            'home_collection' => $request->has('home_collection') ? 1 : 0,
        ]);

        return redirect()->route('franchise.test')->with('success', 'Test added successfully!');
    }

    public function edittest($id)
    {
        $test = Test::findOrFail($id);
        return view('franchise.edit-test', compact('test'));
    }

    public function updatetest(Request $request, $id)
    {
        $request->validate([
            'test_name' => 'required|string|max:255',
            'test_description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $test = Test::findOrFail($id);
        $test->update([
            'test_name' => $request->test_name,
            'test_description' => $request->test_description,
            'price' => $request->price,
            'home_collection' => $request->input('home_collection') ? 1 : 0, // ✅ Explicit boolean
        ]);

        return redirect()->route('franchise.test')->with('success', 'Test updated successfully!');
    }


    public function deletetest($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();

        return back()->with('success', 'Test deleted successfully!');
    }

    public function appoint()
    {
        $franchiseId = Auth::guard('franchise')->user()->id;
        $appointments = Appointment::with('patient', 'test', 'franchise', 'payment')
            ->where('franchise_id', $franchiseId)
            ->get();

        return view('franchise.appointment', compact('appointments'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return back()->with('success', 'Appointment status updated successfully.');
    }

    public function pendingappoint()
    {
        $franchiseId = Auth::guard('franchise')->user()->id;
        $pendingappointments = Appointment::with('patient', 'test', 'franchise', 'payment')
            ->where('franchise_id', $franchiseId)
            ->where('status', 'pending')
            ->get();

        return view('franchise.pending-appointment', compact('pendingappointments'));
    }

    public function completeappoint()
    {
        $franchiseId = Auth::guard('franchise')->user()->id;
        $completeappointments = Appointment::with('patient', 'test', 'franchise', 'payment', 'report')
            ->where('franchise_id', $franchiseId)
            ->where('status', 'completed')
            ->get();


        return view('franchise.complete-appoint', compact('completeappointments'));
    }

    public function cancelledappoint()
    {
        $franchiseId = Auth::guard('franchise')->user()->id;
        $cancelledappointments = Appointment::with('patient', 'test', 'franchise', 'payment')
            ->where('franchise_id', $franchiseId)
            ->where('status', 'cancelled')
            ->get();

        return view('franchise.cancelledappoint', compact('cancelledappointments'));
    }

    public function transaction()
    {
        $franchiseId = Auth::guard('franchise')->id();

        $appointments = Appointment::where('franchise_id', $franchiseId)
            ->with(['patient', 'test', 'payment'])
            ->latest()
            ->get();

        return view('franchise.transaction', compact('appointments'));
    }

    public function uploadTemplate(Request $request)
    {
        // Validate that the file is a .docx file and that the images are uploaded
        $request->validate([
            'header_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'footer_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Check header image dimensions
        $headerImage = $request->file('header_image');
        list($headerWidth, $headerHeight) = getimagesize($headerImage);
        if ($headerWidth !== 2481 || $headerHeight !== 350) {
            return back()->with('error', 'Header image must be 2481x350 pixels.');
        }

        // Check footer image dimensions
        $footerImage = $request->file('footer_image');
        list($footerWidth, $footerHeight) = getimagesize($footerImage);
        if ($footerWidth !== 2481 || $footerHeight !== 350) {
            return back()->with('error', 'Footer image must be 2481x350 pixels.');
        }


        // Handle the uploaded header image
        $headerImageName = time() . '_header_' . $headerImage->getClientOriginalName();
        $headerImagePath = $headerImage->storeAs('header_footer_images', $headerImageName, 'public');

        // Handle the uploaded footer image
        $footerImageName = time() . '_footer_' . $footerImage->getClientOriginalName();
        $footerImagePath = $footerImage->storeAs('header_footer_images', $footerImageName, 'public');

        $franchiseId = Auth::guard('franchise')->id();

        // Check if there is already a template uploaded
        $existingTemplate = ReportTemplate::where('franchise_id', $franchiseId)->first();

        if ($existingTemplate) {
            // Check if the header image exists before deleting
            if ($existingTemplate->header_image) {
                Storage::disk('public')->delete($existingTemplate->header_image);
            }

            // Check if the footer image exists before deleting
            if ($existingTemplate->footer_image) {
                Storage::disk('public')->delete($existingTemplate->footer_image);
            }

            // Delete old database record
            $existingTemplate->delete();
        }

        // Save the new file paths in the database
        ReportTemplate::create([
            'franchise_id' => $franchiseId,
            'header_image' => $headerImagePath,
            'footer_image' => $footerImagePath,
        ]);

        return back()->with('success', 'Report Template uploaded successfully!');
    }

    public function updateProfile(Request $request, $id)
    {
        $franchise = Auth::guard('franchise')->user();

        $request->validate([
            'lab_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:franchises,email,' . $franchise->id,
            'contact' => 'required|string|max:20',
            'City' => 'required|string|max:500',
            'pincode' => 'required|string|max:500',
            'lab_location' => 'required|string|max:500',
            'number_of_employees' => 'nullable|integer|min:1',
            'Ohours' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'franchise_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        // Upload image if provided
        if ($request->hasFile('franchise_image')) {
            if ($franchise->franchise_image) {
                Storage::disk('public')->delete($franchise->franchise_image);
            }
            $path = $request->file('franchise_image')->store('franchise_images', 'public');
            $franchise->franchise_image = $path;
        }

        if ($request->hasFile('franchise_scanner')) {
            if ($franchise->franchise_scanner) {
                Storage::disk('public')->delete($franchise->franchise_scanner);
            }
            $path = $request->file('franchise_scanner')->store('franchise_scanner', 'public');
            $franchise->franchise_scanner = $path;
        }

        // Update basic details
        $franchise->lab_name = $request->lab_name;
        $franchise->owner_name = $request->owner_name;
        $franchise->email = $request->email;
        $franchise->contact = $request->contact;
        $franchise->City = $request->City;
        $franchise->pincode = $request->pincode;
        $franchise->lab_location = $request->lab_location;
        $franchise->number_of_employees = $request->number_of_employees;
        $franchise->Ohours = $request->Ohours;
        $franchise->description = $request->description;

        // Service switches
        $franchise->home_collection = $request->has('home_collection');
        $franchise->insurance_accepted = $request->has('insurance_accepted');

        // Handle password update if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $franchise->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $franchise->password = Hash::make($request->new_password);
        }

        $franchise->save();

        return redirect()->route('franchise.profile')->with('success', 'Profile updated successfully!');
    }

    public function addpatients()
    {
        $franchise = Auth::guard('franchise')->user();
        $franchiseId = Auth::guard('franchise')->user()->id;
        $tests = Test::where('franchise_id', $franchiseId)->get();
        return view('franchise.add-patient', compact('tests', 'franchise'));
    }

    public function patientstore(Request $request)
    {

        $franchise = Auth::guard('franchise')->user();
        $franchiseId = $franchise->id;

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'contact' => 'required|string|max:15',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|min:6',
            'test_id' => 'required|exists:tests,test_id',
            'Transaction_id' => 'required|string|max:255',
            'appointment_date' => 'nullable|date|after_or_equal:today',
        ]);

        // Get the test details to extract price
        $test = Test::findOrFail($request->test_id);

        // Create patient
        $patient = Patients::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $payment = Payment::create([
            'amount' =>  $test->price,
            'payment_status' => 'successful',
            'Transaction_id' => $request->Transaction_id,
        ]);

        // Set appointment date - use provided date or current date if not provided
        $appointmentDate = $request->filled('appointment_date')
            ? $request->appointment_date
            : now()->format('Y-m-d');

        // 2. Create Appointment (Pending)
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'franchise_id' => $franchiseId,
            'test_id' => $request->test_id,
            'payment_id' => $payment->payment_id,
            'appointment_date' => $appointmentDate,
            'status' => 'pending',
        ]);

        return redirect()->route('franchise.dashboard')->with('success', 'Registration successful!');
    }

    public function report()
    {
        $franchiseId = Auth::guard('franchise')->id();

        $appointments = Appointment::with([
            'patient',
            'test',
            'payment',
            'report', // Make sure you have a 'report' relationship in Appointment model
        ])
            ->where('franchise_id', $franchiseId)
            ->whereHas('report') // Only fetch appointments that have a report
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('franchise.report', compact('appointments'));
    }


    public function franchisePatients($id)
    {
        $patient = \App\Models\Patients::findOrFail($id);

        return view('franchise.patients', compact('patient'));
    }

    public function reportsstore(Request $request)
    {
        $report = Report::create([
            'appointment_id' => $request->appointment_id,
            'report_name' => $request->report_name,
        ]);

    

        foreach ($request->tests as $test) {
            TestResult::create([
                'report_id' => $report->id,
                'test_name' => $test['test_name'],
                'result' => $test['result'],
                'unit' => $test['unit'] ?? null,
                'reference_range' => $test['reference_range'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Report uploaded successfully!');
    }

    public function editreport($id)
    {
        $report = Report::with('testResults', 'appointment.patient')->findOrFail($id);
        return view('franchise.report-edit', compact('report'));
    }

    public function updatereport(Request $request, Report $report)
    {
        $request->validate([
            'tests.*.test_name' => 'required|string',
            'tests.*.result' => 'required|numeric',
            'tests.*.unit' => 'required|string',
            'tests.*.reference_range' => 'required|string',
        ]);

        // Delete old test results (or handle update logic as needed)
        $report->testResults()->delete();

        foreach ($request->tests as $test) {
            TestResult::create([
                'report_id' => $report->id,
                'test_name' => $test['test_name'],
                'result' => $test['result'],
                'unit' => $test['unit'],
                'reference_range' => $test['reference_range'],
            ]);
        }

        return redirect()->route('franchise.report')->with('success', 'Report updated!');
    }


    public function deleteTestresult($id)
    {
        $testResult = TestResult::find($id);

        if (!$testResult) {
            return redirect()->back()->with('error', 'Parameter not found');
        }

        $testResult->delete();
        return redirect()->back()->with('success', 'Parameter Delete successfully');
    }

    public function viewReport($appointmentId)
    {

        $franchiseId = Auth::guard('franchise')->user()->id;
        $appointment = Appointment::with('patient')->findOrFail($appointmentId);
        $report = Report::where('appointment_id', $appointmentId)->firstOrFail();
        $testResults = TestResult::where('report_id', $report->id)->get();
        $template = ReportTemplate::where('franchise_id', $franchiseId)->first();

        return view('franchise.reportview', compact('appointment', 'report', 'testResults', 'template'));
    }

    public function downloadReport($appointmentId)
    {
        $franchiseId = Auth::guard('franchise')->user()->id;
        $appointment = Appointment::with('patient')->findOrFail($appointmentId);
        $report = Report::where('appointment_id', $appointmentId)->firstOrFail();
        $testResults = TestResult::where('report_id', $report->id)->get();
        $template = ReportTemplate::where('franchise_id', $franchiseId)->first();
        $pdf = Pdf::loadView('pdf.report-pdf', compact('report', 'appointment', 'testResults', 'template'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Medical_Report_' . $appointment->id . '.pdf');
    }
}
