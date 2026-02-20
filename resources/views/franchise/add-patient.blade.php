@extends('franchise.layout.app')

@section('title', 'Medical Test Report')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Add New Patient</h1>
                    <p class="text-muted">Complete the form below to register a new patient</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('franchise.Patient.store') }}" method="POST" enctype="multipart/form-data" id="addPatientForm">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fas fa-user-plus text-primary me-2"></i>
                        <h6 class="m-0 font-weight-bold">Patient Information</h6>
                    </div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-bold">Patient Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter full name" required value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="patient@example.com" required value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">A verification email will be sent to this address</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="contact" class="form-label fw-bold">Contact Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="(123) 456-7890" required value="{{ old('contact') }}">
                                    </div>
                                    @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="date_of_birth" class="form-label fw-bold">Date of Birth <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" required value="{{ old('date_of_birth') }}">
                                    </div>
                                    @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small id="ageDisplay" class="text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="gender" class="form-label fw-bold">Gender <span class="text-danger">*</span></label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                        <option value="" disabled selected>Please select</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="address" class="form-label fw-bold">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="Enter complete address" required>{{ old('address') }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="city" class="form-label fw-bold">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Enter city" required value="{{ old('city') }}">
                                    @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="postal_code" class="form-label fw-bold">Postal/ZIP Code</label>
                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" placeholder="Enter postal code" value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Password must be at least 8 characters</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fas fa-calendar-check text-primary me-2"></i>
                        <h6 class="m-0 font-weight-bold">Appointment Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="test_id" class="form-label fw-bold">Select Test <span class="text-danger">*</span></label>
                                    <select class="form-select @error('test_id') is-invalid @enderror" id="test_id" name="test_id" required>
                                        <option value="" disabled selected>-- Select a test --</option>
                                        @foreach($tests as $test)
                                        <option value="{{ $test->test_id }}" data-price="{{ $test->price }}">
                                            {{ $test->test_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('test_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="selected_test_price" class="form-label fw-bold">Test Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-coins"></i></span>
                                        <input type="text" class="form-control" id="selected_test_price" name="amount" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="appointment_date" class="form-label fw-bold">Appointment Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        <input type="datetime" class="form-control" id="appointment_date" name="appointment_date">
                                    </div>
                                    <small class="text-muted">Select a date for the appointment</small>
                                    <small class="text-muted">Keep Blank For Today appointment</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="transaction_id" class="form-label fw-bold">Transaction ID <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                                        <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" id="transaction_id" name="Transaction_id" placeholder="Enter transaction ID" required value="{{ old('transaction_id') }}">
                                    </div>
                                    @error('transaction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Write Cash, If Payment Done in Cash</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.patients') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Cancel
                    </a>
                    <div>
                        <button type="reset" class="btn btn-secondary me-2">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Patient
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle eye icon
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });

        // Calculate and display age based on date of birth
        const dobInput = document.getElementById('date_of_birth');
        const ageDisplay = document.getElementById('ageDisplay');

        dobInput.addEventListener('change', function() {
            const dob = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            if (!isNaN(age) && age >= 0) {
                ageDisplay.textContent = `Age: ${age} years`;
            } else {
                ageDisplay.textContent = '';
            }
        });

        // Add medical conditions to notes
        const conditionBtns = document.querySelectorAll('.condition-btn');
        const notesField = document.getElementById('notes');

        conditionBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const condition = this.getAttribute('data-condition');

                if (notesField.value) {
                    if (!notesField.value.includes(condition)) {
                        notesField.value += `\n${condition}: `;
                    }
                } else {
                    notesField.value = `${condition}: `;
                }

                notesField.focus();
                btn.classList.add('active');

                setTimeout(() => {
                    btn.classList.remove('active');
                }, 500);
            });
        });

        // Form validation
        const form = document.getElementById('addPatientForm');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        form.addEventListener('submit', function(event) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                event.preventDefault();
                alert('Passwords do not match!');
                confirmPasswordInput.focus();
            }
        });

        // Handle test selection and price display
        const testSelect = document.getElementById('test_id');
        const priceDisplay = document.getElementById('selected_test_price');

        testSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');

            if (price) {
                priceDisplay.value = '₹' + parseFloat(price).toFixed(2);
            } else {
                priceDisplay.value = '';
            }
        });

    });
</script>
@endsection