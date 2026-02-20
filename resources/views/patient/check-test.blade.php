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
        background-color: #e9ecef;
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
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .lab-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .lab-icon {
        background-color: var(--light-gray);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
    }

    .tests-container {
        border-radius: var(--border-radius);
        overflow: hidden;
        background-color: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: none;
    }

    .test-card {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: grid;
        grid-template-columns: 50px 1fr auto auto;
        gap: 1.5rem;
        align-items: center;
        transition: background-color 0.2s;
    }

    .test-card:last-child {
        border-bottom: none;
    }

    .test-card:hover {
        background-color: rgba(67, 97, 238, 0.03);
    }

    .test-number {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--light-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #495057;
    }

    .test-info {
        min-width: 0;
    }

    .test-name {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        color: var(--secondary-color);
    }

    .test-description {
        color: #6c757d;
        font-size: 0.95rem;
        white-space: normal;
        margin: 0;
    }

    .test-price {
        font-weight: 700;
        font-size: 1.2rem;
        color: #212529;
        white-space: nowrap;
        text-align: right;
    }

    .price-label {
        font-size: 0.8rem;
        color: #6c757d;
        display: block;
        margin-bottom: 0.25rem;
    }

    .book-button {
        background-color: #27ae60;
        border: none;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: var(--border-radius);
        font-weight: 500;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .book-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(46, 204, 113, 0.2);
    }

    .book-button i {
        margin-right: 0.5rem;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-state i {
        font-size: 3rem;
        color: #adb5bd;
        margin-bottom: 1rem;
    }

    .empty-state-text {
        font-size: 1.1rem;
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 700;
        color: var(--secondary-color);
    }

    .appointment-form label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #495057;
    }

    .appointment-form input {
        border-radius: 0.5rem;
        padding: 0.75rem;
        border: 1px solid #dee2e6;
    }

    .appointment-form input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .submit-button {
        background-color: var(--primary-color);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: var(--border-radius);
        font-weight: 600;
        transition: all 0.2s;
    }

    .submit-button:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }

    .test-detail {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .test-detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .test-detail-row:last-child {
        margin-bottom: 0;
        padding-top: 0.75rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .detail-label {
        font-weight: 500;
        color: #6c757d;
    }

    .detail-value {
        font-weight: 600;
        color: #212529;
    }

    .price-value {
        font-size: 1.25rem;
        color: var(--secondary-color);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .test-card {
            grid-template-columns: 40px 1fr;
            grid-template-rows: auto auto auto;
            gap: 1rem;
        }

        .test-number {
            grid-row: span 2;
        }

        .test-info {
            grid-column: 2;
        }

        .test-price {
            grid-column: 1 / 3;
            text-align: left;
            margin-top: 0.5rem;
        }

        .test-action {
            grid-column: 1 / 3;
            margin-top: 0.5rem;
        }

        .book-button {
            width: 100%;
        }
    }
</style>

<div class="container py-5">
    <div class="page-header">
        <div>
            <div class="lab-info">
                <div class="lab-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <h1 class="page-title">{{ $franchises->lab_name }}</h1>
            </div>
            <p class="text-muted mb-0">Browse and book available diagnostic tests</p>
        </div>
        <a href="{{ route('patient.Pathlab') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Back to Pathologies
        </a>
    </div>

    @if($tests->count())
    <div class="tests-container">
        @foreach($tests as $index => $test)
        <div class="test-card">
            <div class="test-number">{{ $index + 1 }}</div>
            <div class="test-info">
                <h3 class="test-name">{{ $test->test_name }}</h3>
                <p class="test-description">{{ $test->test_description }}</p>
            </div>
            <div class="test-price">
                <span class="price-label">Test Price</span>
                ₹{{ number_format($test->price, 2) }}
            </div>
            <div class="test-action">
                <button class="book-button" data-bs-toggle="modal" data-bs-target="#bookTestModal"
                    data-test-id="{{ $test->test_id }}" data-test-name="{{ $test->test_name }}"
                    data-test-price="{{ $test->price }}">
                    <i class="fas fa-calendar-check"></i> Book Now
                </button>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-vial"></i>
        <p class="empty-state-text">No tests available</p>
        <span class="text-muted">This laboratory hasn't added any tests yet. Please check back later.</span>
    </div>
    @endif
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookTestModal" tabindex="-1" aria-labelledby="bookTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="bookTestForm" method="POST" action="{{ route('book.test') }}" class="appointment-form">
            @csrf
            <input type="hidden" name="test_id" id="modalTestId">
            <input type="hidden" name="franchise_id" value="{{ $franchises->id }}">
            <input type="hidden" name="price" id="modalTestPrice">
            <input type="hidden" name="franchise_scanner" value="{{ $franchises->franchise_scanner }}">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-calendar-alt me-2"></i> Schedule Your Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="test-detail">
                        <div class="test-detail-row">
                            <span class="detail-label">Laboratory</span>
                            <span class="detail-value">{{ $franchises->lab_name }}</span>
                        </div>
                        <div class="test-detail-row">
                            <span class="detail-label">Test</span>
                            <span class="detail-value" id="modalTestName"></span>
                        </div>
                        <div class="test-detail-row">
                            <span class="detail-label">Price</span>
                            <span class="detail-value price-value">₹<span id="modalTestAmount"></span></span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="appointment_date"><i class="far fa-calendar me-2"></i>Select Appointment Date &
                            Time</label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control"
                            required>
                        <small class="text-muted mt-2 d-block">Choose a convenient date and time for your test
                            appointment</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn submit-button">Confirm Booking</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      const bookTestModal = document.getElementById('bookTestModal');
      if (bookTestModal) {
        bookTestModal.addEventListener('show.bs.modal', function(event) {
          const button = event.relatedTarget;
          const testId = button.getAttribute('data-test-id');
          const testName = button.getAttribute('data-test-name');
          const testPrice = button.getAttribute('data-test-price');
          
          document.getElementById('modalTestId').value = testId;
          document.getElementById('modalTestPrice').value = testPrice;
          document.getElementById('modalTestName').textContent = testName;
          document.getElementById('modalTestAmount').textContent = parseFloat(testPrice).toFixed(2);
          
          // Set minimum date to today
          const dateInput = document.getElementById('appointment_date');
          if (dateInput) {
            const today = new Date();
            today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
            const minDateTime = today.toISOString().slice(0,16);
            dateInput.min = minDateTime;
            
            // Set default value to tomorrow at noon
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setHours(12, 0, 0, 0);
            tomorrow.setMinutes(tomorrow.getMinutes() - tomorrow.getTimezoneOffset());
            const defaultDateTime = tomorrow.toISOString().slice(0,16);
            dateInput.value = defaultDateTime;
          }
        });
      }
    });
</script>

@endsection