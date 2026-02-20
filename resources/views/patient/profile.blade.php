@extends('patient.layout.app')

@section('title', 'Patient Dashboard')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        color: var(--secondary-color);
        font-weight: 700;
        margin: 0;
        font-size: 1.75rem;
    }

    .back-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background-color: #f8f9fa;
        border: none;
        color: #495057;
        padding: 0.6rem 1.2rem;
        border-radius: var(--border-radius);
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .back-button:hover {
        background-color: #e9ecef;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-card {
        border-radius: var(--border-radius);
        overflow: hidden;
        background-color: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 2rem;
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        border-bottom: none;
    }

    .profile-card .card-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border-radius: var(--border-radius);
        border: 1px solid #dee2e6;
        padding: 0.75rem 1rem;
        background-color: #f8f9fa;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        background-color: white;
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
    }

    .save-button {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        cursor: pointer;
    }

    .save-button:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
    }

    .cancel-button {
        background-color: transparent;
        color: #6c757d;
        border: 1px solid #dee2e6;
        border-radius: var(--border-radius);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        cursor: pointer;
        text-decoration: none;
    }

    .cancel-button:hover {
        background-color: #e9ecef;
        color: #343a40;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    .success-notification {
        position: fixed;
        top: 2rem;
        right: 2rem;
        padding: 1rem 1.5rem;
        background-color: var(--success-color);
        color: white;
        border-radius: var(--border-radius);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 20px rgba(46, 204, 113, 0.3);
        z-index: 1050;
        transform: translateY(-100px);
        opacity: 0;
        transition: all 0.3s;
    }

    .success-notification.show {
        transform: translateY(0);
        opacity: 1;
    }

    .password-change-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #dee2e6;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .back-button {
            width: 100%;
            justify-content: center;
        }

        .form-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }

        .save-button,
        .cancel-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container py-5">
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Profile</h1>
            <p class="text-muted mb-0">Update your personal information</p>
        </div>
        <a href="{{ route('patient.dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>
    </div>

    <form action="{{route('patient.profile.update', $profile['id'] )}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="profile-card">
            <div class="card-header">
                <h5 class="mb-0">Personal Information</h5>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="patientId" class="form-label">Patient ID</label>
                            <input type="text" class="form-control" id="patientId" value="{{ $profile['id'] }}"
                                readonly>
                            <small class="text-muted">Your patient ID cannot be changed</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name"
                                value="{{ $profile['name'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $profile['email'] ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" name="contact"
                                value="{{ $profile['contact'] }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="date_of_birth"
                                value="{{ $profile['dob'] ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male" {{ $profile['gender']=='Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $profile['gender']=='Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Other" {{ $profile['gender']=='Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3"
                                required>{{ $profile['address'] }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $profile['city'] }}"
                                required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-buttons">
            <a href="{{ route('patient.dashboard') }}" class="cancel-button">
                <i class="fas fa-times"></i>
                Cancel
            </a>
            <button type="submit" class="save-button">
                <i class="fas fa-save"></i>
                Save Changes
            </button>
        </div>

    </form>




    <form method="POST" action="{{ route('patient.change.password') }}">
        @csrf
        <div class="profile-card mt-5">
            <div class="card-header">
                <h5 class="mb-0">Change Password</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Leave these fields blank if you don't want to change your password.</p>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword"
                            name="new_password_confirmation">
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <button type="submit" class="save-button">Update Password</button>
        </div>
    </form>


</div>



@endsection