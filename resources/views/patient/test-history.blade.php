@extends('patient.layout.app')

@section('title', 'Patient Dashboard')

@section('content')

<style>
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

  .history-container {
    border-radius: var(--border-radius);
    overflow: hidden;
    background-color: white;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: none;
  }

  .filter-bar {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    background-color: var(--light-gray);
    flex-wrap: wrap;
  }

  .search-input {
    flex: 1;
    min-width: 200px;
    position: relative;
  }

  .search-input input {
    padding: 0.6rem 1rem 0.6rem 2.5rem;
    border-radius: var(--border-radius);
    border: 1px solid #dee2e6;
    width: 100%;
  }

  .search-input i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #adb5bd;
  }

  .filter-dropdown {
    min-width: 150px;
  }

  .filter-dropdown select {
    border-radius: var(--border-radius);
    border: 1px solid #dee2e6;
    padding: 0.6rem 1rem;
    width: 100%;
    color: #495057;
    background-color: white;
  }

  .history-card {
    padding: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    transition: background-color 0.2s;
  }

  .history-card:last-child {
    border-bottom: none;
  }

  .history-card:hover {
    background-color: rgba(67, 97, 238, 0.03);
  }

  .history-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .test-meta {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
  }

  .test-date {
    background-color: var(--light-gray);
    padding: 0.5rem 0.75rem;
    border-radius: var(--border-radius);
    font-size: 0.9rem;
    color: #495057;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    border-radius: var(--border-radius);
    font-size: 0.85rem;
    font-weight: 600;
  }

  .status-completed {
    background-color: rgba(46, 204, 113, 0.1);
    color: var(--success-color);
  }

  .status-pending {
    background-color: rgba(243, 156, 18, 0.1);
    color: var(--warning-color);
  }

  .status-cancelled {
    background-color: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
  }

  .test-name {
    font-weight: 700;
    font-size: 1.2rem;
    color: var(--secondary-color);
    margin-bottom: 0.5rem;
  }

  .lab-name {
    color: #6c757d;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .test-details {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
    position: relative;
  }

  .detail-group {
    background-color: var(--light-gray);
    padding: 1rem;
    border-radius: var(--border-radius);
  }

  .detail-label {
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 0.3rem;
  }

  .detail-value {
    font-weight: 600;
    color: #343a40;
  }

  .detail-value.highlight {
    color: var(--secondary-color);
  }

  .action-buttons {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.5rem;
    justify-content: flex-end;
  }

  .action-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
  }

  .view-button {
    background-color: blueviolet;
    color: white;
    border: none;
  }

  .view-button:hover {
    background-color: rgb(88, 73, 103);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
    color: white;
  }

  .download-button {
    background-color: white;
    color: #495057;
    border: 1px solid #dee2e6;
  }

  .download-button:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    color: #343a40;
  }

  .expandable {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
  }

  .expanded .expandable {
    max-height: 1000px;
  }

  .toggle-details {
    border: none;
    background: none;
    color: var(--primary-color);
    font-weight: 500;
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
    cursor: pointer;
  }

  .toggle-details i {
    transition: transform 0.3s;
  }

  .expanded .toggle-details i {
    transform: rotate(180deg);
  }

  .pagination-container {
    display: flex;
    justify-content: center;
    padding: 1.5rem;
    background-color: white;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
  }

  .pagination {
    display: flex;
    gap: 0.5rem;
  }

  .page-item .page-link {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #495057;
    font-weight: 500;
    border: none;
  }

  .page-item.active .page-link {
    background-color: var(--primary-color);
    color: white;
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

  .modal-title {
    font-weight: 700;
    color: var(--secondary-color);
  }

  .result-item {
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  }

  .result-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
  }

  .result-name {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #343a40;
  }

  .result-value {
    font-size: 1.2rem;
    font-weight: 700;
  }

  .result-normal {
    color: var(--success-color);
  }

  .result-warning {
    color: var(--warning-color);
  }

  .result-critical {
    color: var(--danger-color);
  }

  .reference-range {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 0.25rem;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .filter-bar {
      flex-direction: column;
      align-items: stretch;
    }

    .search-input {
      width: 100%;
    }

    .filter-dropdown {
      width: 100%;
    }

    .history-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .action-buttons {
      justify-content: flex-start;
      width: 100%;
    }

    .action-button {
      flex: 1;
      justify-content: center;
    }
  }
</style>

<div class="container py-5">
  <div class="page-header">
    <div>
      <h1 class="page-title">Test History</h1>
      <p class="text-muted mb-0">View all your past diagnostic tests and results</p>
    </div>
    <a href="{{ route('patient.dashboard') }}" class="back-button">
      <i class="fas fa-arrow-left"></i>
      Back to Dashboard
    </a>
  </div>

  <div class="history-container">
    <div class="filter-bar">
      <div class="search-input">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search by test name or lab..." id="searchInput">
      </div>
      <div class="filter-dropdown">
        <select id="statusFilter">
          <option value="all">All Status</option>
          <option value="completed">Completed</option>
          <option value="pending">Pending</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>
      <div class="filter-dropdown">
        <select id="dateFilter">
          <option value="all">All Time</option>
          <option value="last-month">Last Month</option>
          <option value="last-3-months">Last 3 Months</option>
          <option value="last-6-months">Last 6 Months</option>
          <option value="last-year">Last Year</option>
        </select>
      </div>
    </div>

    <!-- Test History Item 1 -->
    @foreach ($testhistory as $testhistory)
    <div class="history-card">
      <div class="history-header">
        <div>
          <h3 class="test-name">{{$testhistory->test->test_name ?? 'N/A'}}</h3>
          <div class="lab-name">
            <i class="fas fa-flask"></i>
            {{ $testhistory->franchise->lab_name ?? 'N/A' }}
          </div>
        </div>
        <div class="test-meta">
          <div class="test-date">
            <i class="far fa-calendar-alt"></i>
            {{$testhistory->appointment_date}}
          </div>
          <div class="status-badge status-completed">
            <i class="fas fa-check-circle"></i>
            {{$testhistory->status}}
          </div>
        </div>
      </div>

      <button class="toggle-details" onclick="toggleDetails(this)">
        <span>View Test Details</span>
        <i class="fas fa-chevron-down"></i>
      </button>

      <div class="expandable">
        <div class="test-details">
          <div class="detail-group">
            <div class="detail-label">Appointment ID</div>
            <div class="detail-value">{{$testhistory->appointment_id}}</div>
          </div>
          <div class="detail-group">
            <div class="detail-label">Payment ID</div>
            <div class="detail-value">{{$testhistory->payment->Transaction_id}}</div>
          </div>
          <div class="detail-group">
            <div class="detail-label">Test Price</div>
            <div class="detail-value highlight">₹{{ $testhistory->test->price ?? 'N/A' }}</div>
          </div>
          <div class="detail-group">
            <div class="detail-label">Doctor Referral</div>
            @if($testhistory->report)
            <div class="detail-value">{{$testhistory->report->doctore_referral}}</div>
            @else
            <span class="detail-value">Report Not Uploaded Yet</span>
            @endif
          </div>
        </div>

        <div class="action-buttons">
          @if($testhistory->report)
          <a class="btn btn-sm btn-primary" href="{{ route('patient.report.view', $testhistory->appointment_id) }}">
            View Report
          </a>

          @else
          <span class="alert alert-danger">Report Not Uploaded Yet</span>
          @endif
        </div>
      </div>
    </div>
    @endforeach



  </div>
</div>


<script>
  function toggleDetails(button) {
    const historyCard = button.closest('.history-card');
    historyCard.classList.toggle('expanded');

    const buttonText = button.querySelector('span');
    if (historyCard.classList.contains('expanded')) {
      buttonText.textContent = 'Hide Test Details';
    } else {
      buttonText.textContent = 'View Test Details';
    }
  }

  // Filter functionality (basic implementation for demonstration)
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');

    const filterElements = [searchInput, statusFilter, dateFilter];

    filterElements.forEach(element => {
      element.addEventListener('change', applyFilters);
      if (element === searchInput) {
        element.addEventListener('keyup', applyFilters);
      }
    });

    function applyFilters() {
      const searchTerm = searchInput.value.toLowerCase();
      const statusValue = statusFilter.value;
      const dateValue = dateFilter.value;

      const historyCards = document.querySelectorAll('.history-card');

      historyCards.forEach(card => {
        const testName = card.querySelector('.test-name').textContent.toLowerCase();
        const labName = card.querySelector('.lab-name').textContent.toLowerCase();
        const statusText = card.querySelector('.status-badge').classList.contains('status-completed') ? 'completed' :
          card.querySelector('.status-badge').classList.contains('status-pending') ? 'pending' : 'cancelled';

        // Simple search filter
        const matchesSearch = searchTerm === '' || testName.includes(searchTerm) || labName.includes(searchTerm);

        // Simple status filter
        const matchesStatus = statusValue === 'all' || statusText === statusValue;

        // For date filter, in a real implementation you would compare actual dates
        // This is simplified for the demonstration
        const matchesDate = dateValue === 'all'; // Simplified for demo

        card.style.display = (matchesSearch && matchesStatus && matchesDate) ? 'block' : 'none';
      });
    }
  });
</script>

@endsection