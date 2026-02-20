<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\Testimonial;
use App\Models\Patients;
use App\Models\Query;

class LandingPageController extends Controller
{
    public function index()
    {
        $franchises = Franchise::where('Status', 'Active')->get();
        $testimonials = Testimonial::all();
        return view('dashboard', compact('franchises', 'testimonials'));
    }

    public function patientlogin()
    {
        return view('patients-login');
    }

    public function franchiselogin()
    {
        return view('franchise-login');
    }

    public function adminlogin()
    {
        return view('admin-login');
    }

    public function patientregister()
    {
        return view('patients-register');
    }

    public function register(Request $request)
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

        return redirect()->route('patient-login')->with('success', 'Registration successful! Please login.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        Query::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'message' => $request->message,
        ]);

        return redirect()->route('index')->with('success', 'Your message has been sent successfully!');
    }


}
