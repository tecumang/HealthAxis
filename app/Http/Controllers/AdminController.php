<?php

namespace App\Http\Controllers;

use App\Models\Franchise;
use App\Models\Patients;
use App\Models\Query;
use App\Models\Test;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function dashboard()
    {
        // 1. Basic Stats
        $totalFranchises = Franchise::count();
        $activeFranchises = Franchise::where('Status', 'Active')->count();
        $totalPatients = Patients::count();
        $totalTests = Test::count();
        $totalTestimonials = Testimonial::count();
        $totalQueries = Query::count();
        $totalTransaction = Payment::count();

        // 2. Appointments
        $totalAppointments = Appointment::count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())->count();
        $monthAppointments = Appointment::whereBetween('appointment_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        // 3. Payments
        $totalPayments = Payment::sum('amount');
        $todayPayments = Payment::whereDate('payment_date', Carbon::today())->sum('amount');
        $monthlyPayments = Payment::whereBetween('payment_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('amount');
        $yearlyPayments = Payment::whereYear('payment_date', Carbon::now()->year)->sum('amount');


        $getStats = function ($start, $end) {
            $newPatients = Patients::whereBetween('created_at', [$start, $end])->count();
            $appointments = Appointment::whereBetween('appointment_date', [$start, $end])->get();
            $testsConducted = $appointments->count();

            $paymentIds = $appointments->pluck('payment_id')->filter()->unique();
            $revenue = Payment::whereIn('payment_id', $paymentIds)
                ->where('payment_status', 'successful')
                ->sum('amount');

            $reportsGenerated = Appointment::whereIn('appointment_id', function ($q) {
                $q->select('appointment_id')->from('test_reports');
            })->whereBetween('appointment_date', [$start, $end])->count();

            return compact('newPatients', 'testsConducted', 'revenue', 'reportsGenerated');
        };

        $summaryToday = $getStats(Carbon::today(), Carbon::now());
        $summaryWeek = $getStats(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $summaryMonth = $getStats(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $summaryYear = $getStats(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());


        return view('admin.index', compact(
            'totalFranchises',
            'activeFranchises',
            'totalPatients',
            'totalTests',
            'totalAppointments',
            'completedAppointments',
            'pendingAppointments',
            'todayAppointments',
            'monthAppointments',
            'totalPayments',
            'todayPayments',
            'monthlyPayments',
            'yearlyPayments',
            'totalTestimonials',
            'totalQueries',
            'totalTransaction',
            'summaryToday',
            'summaryWeek',
            'summaryMonth',
            'summaryYear'
        ));
    }

    public function franchise()
    {
        $franchise = Franchise::all();
        return view('admin.franchise', compact('franchise'));
    }

    public function query()
    {
        $query = Query::all();
        return view('admin.query', compact('query'));
    }

    public function editfranchise($id)
    {
        $franchise = Franchise::findOrFail($id);
        return view('admin.franchise-edit', compact('franchise'));
    }

    public function addfranchise()
    {
        return view('admin.add-franchise');
    }

    public function franchisestore(Request $request)
    {
        $request->validate([
            'lab_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:franchises,email',
            'contact' => 'required|string|max:15',
            'lab_location' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'Ohours' => 'nullable|string|max:255',
            'Status' => 'required|in:Active,Inactive',
            'password' => 'required|string|min:6',
            'number_of_employees' => 'required|integer|min:1',
            'franchise_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $franchise = new Franchise();
        $franchise->lab_name = $request->lab_name;
        $franchise->owner_name = $request->owner_name;
        $franchise->email = $request->email;
        $franchise->contact = $request->contact;
        $franchise->lab_location = $request->lab_location;
        $franchise->city = $request->city;
        $franchise->pincode = $request->pincode;
        $franchise->Ohours = $request->Ohours;
        $franchise->Status = $request->Status;
        $franchise->home_collection = $request->has('home_collection');
        $franchise->insurance_accepted = $request->has('insurance_accepted');
        $franchise->password = Hash::make($request->password);
        $franchise->number_of_employees = $request->number_of_employees;

        if ($request->hasFile('franchise_image')) {
            $imagePath = $request->file('franchise_image')->store('franchise_images', 'public');
            $franchise->franchise_image = $imagePath;
        }

        if ($request->hasFile('franchise_scanner')) {
            if ($franchise->franchise_scanner) {
                Storage::delete('public/' . $franchise->franchise_scanner);
            }
            $imagePath = $request->file('franchise_scanner')->store('franchise_scanner', 'public');
            $franchise->franchise_scanner = $imagePath;
        }

        $franchise->save();

        return redirect()->route('admin.franchise')->with('success', 'Franchise added successfully!');
    }

    public function updatefranchise(Request $request, $id)
    {
        $franchise = Franchise::findOrFail($id);

        $request->validate([
            'lab_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:franchises,email,' . $id,
            'contact' => 'required|string|max:15',
            'lab_location' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'Ohours' => 'nullable|string|max:255',
            'Status' => 'required|in:Active,Inactive',
            'password' => 'nullable|string|min:6',
            'number_of_employees' => 'required|integer|min:1',
            'franchise_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $franchise->lab_name = $request->lab_name;
        $franchise->owner_name = $request->owner_name;
        $franchise->email = $request->email;
        $franchise->contact = $request->contact;
        $franchise->lab_location = $request->lab_location;
        $franchise->city = $request->city;
        $franchise->pincode = $request->pincode;
        $franchise->Ohours = $request->Ohours;
        $franchise->Status = $request->Status;
        $franchise->home_collection = $request->has('home_collection');
        $franchise->insurance_accepted = $request->has('insurance_accepted');
        $franchise->number_of_employees = $request->number_of_employees;

        if ($request->password) {
            $franchise->password = Hash::make($request->password);
        }

        if ($request->hasFile('franchise_image')) {
            if ($franchise->franchise_image) {
                Storage::delete('public/' . $franchise->franchise_image);
            }
            $imagePath = $request->file('franchise_image')->store('franchise_images', 'public');
            $franchise->franchise_image = $imagePath;
        }

        if ($request->hasFile('franchise_scanner')) {
            if ($franchise->franchise_scanner) {
                Storage::delete('public/' . $franchise->franchise_scanner);
            }
            $imagePath = $request->file('franchise_scanner')->store('franchise_scanner', 'public');
            $franchise->franchise_scanner = $imagePath;
        }

        $franchise->save();

        return redirect()->route('admin.franchise')->with('success', 'Franchise updated successfully!');
    }


    public function deletefranchise($id)
    {
        $franchise = Franchise::findOrFail($id);
        $franchise->delete();

        return redirect()->route('admin.franchise')->with('success', 'Franchise deleted successfully!');
    }

    public function patient()
    {
        $patients = Patients::all();
        return view('admin.patients', compact('patients'));
    }

    public function patientstore(Request $request)
    {

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
        ]);

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

        return redirect()->route('admin.patients')->with('success', 'Registration successful! Please login.');
    }

    public function addpatients()
    {
        return view('admin.add-patient');
    }

    public function editpatient($id)
    {
        $patient = Patients::findOrFail($id);
        return view('admin.patient-edit', compact('patient'));
    }

    public function updatepatient(Request $request, $id)
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

        return redirect()->route('admin.patients')->with('success', 'Patient updated successfully!');
    }

    public function deletePatient($id)
    {
        $patient = Patients::findOrFail($id);

        $patient->delete();

        return redirect()->back()->with('success', 'Patient deleted successfully.');
    }


    public function test()
    {
        $tests = Test::with('franchiseDetails')->get();
        return view('admin.test-list', compact('tests'));
    }

    public function appointment()
    {
        $franchise = Franchise::all();
        $appointments = Appointment::with('patient', 'test', 'franchise', 'payment')->get();
        return view('admin.appointment', compact('appointments', 'franchise'));
    }

    public function payment()
    {

        $payments = Payment::all();

        $totalRevenue = Payment::where('payment_status', 'successful')->sum('amount');
        $successfulTransactions = Payment::where('payment_status', 'successful')->count();
        $failedTransactions = Payment::where('payment_status', 'failed')->count();
        $pendingTransactions = Payment::where('payment_status', 'pending')->count();
        return view('admin.payment', compact(
            'payments',
            'totalRevenue',
            'successfulTransactions',
            'failedTransactions',
            'pendingTransactions'
        ));
    }

    public function addtestimonial()
    {
        return view('admin.add-testimonials');
    }

    public function storetestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'nullable',
            'message' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = $request->all();

        Testimonial::create($data);

        return redirect()->route('admin.testmonial')->with('success', 'Testimonial added successfully.');
    }

    public function testimonial()
    {
        $testinomials = Testimonial::all();
        return view('admin.testimonials', compact('testinomials'));
    }

    public function edittestimonial($id)
    {
        $testinomial = Testimonial::findOrFail($id);
        return view('admin.testimonial-edit', compact('testinomial'));
    }

    public function updatetestimonial(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'nullable',
            'message' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->all());

        return redirect()->route('admin.testmonial')->with('success', 'Testimonial updated successfully.');
    }

    public function deletetestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial deleted successfully.');
    }
}
