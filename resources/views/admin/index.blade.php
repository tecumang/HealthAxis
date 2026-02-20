@extends('admin.layout.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .dashboard-title {
        color: var(--dark);
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .dashboard-title:after {
        content: '';
        position: absolute;
        width: 50px;
        height: 4px;
        background: var(--primary);
        bottom: -10px;
        left: 0;
        border-radius: 2px;
    }

    .stat-card {
        border-radius: var(--card-radius);
        border: none;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-card .card-body {
        padding: 1.5rem;
    }

    .stat-card-primary {
        background: linear-gradient(135deg, #4361ee, #3f37c9);
    }

    .stat-card-success {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
    }

    .stat-card-warning {
        background: linear-gradient(135deg, #f39c12, #e67e22);
    }

    .stat-card-danger {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    .stat-card-info {
        background: linear-gradient(135deg, #4cc9f0, #3498db);
    }

    .stat-card-secondary {
        background: linear-gradient(135deg, #b46fce, #502f5c)
    }

    .stat-card-light {
        background: white;
        border-top: 4px solid var(--primary);
    }

    .stat-card-light .stat-card-title {
        color: var(--dark);
    }

    .stat-card-light .stat-card-value {
        color: var(--primary);
    }

    .stat-card-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: inline-block;
    }

    .stat-card-title {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card-value {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0;
        line-height: 1;
    }

    .stat-card-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin-top: 0.75rem;
    }

    .period-selector {
        background-color: white;
        border-radius: var(--card-radius);
        padding: 0.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        display: inline-flex;
        margin-bottom: 1.5rem;
    }

    .period-selector .btn {
        border-radius: var(--card-radius);
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        color: var(--dark);
        border: none;
        background: transparent;
    }

    .period-selector .btn.active {
        background-color: var(--primary);
        color: white;
    }

    .section-heading {
        display: flex;
        align-items: center;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #eee;
    }

    .section-heading h4 {
        margin-bottom: 0;
        font-weight: 600;
        color: var(--dark);
    }

    .section-heading .section-icon {
        margin-right: 0.75rem;
        font-size: 1.2rem;
        color: var(--primary);
    }

    .recent-activity-card {
        border-radius: var(--card-radius);
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .recent-activity-card .card-header {
        background-color: white;
        border-bottom: 1px solid #eee;
        padding: 1.25rem 1.5rem;
    }

    .recent-activity-card .card-header h5 {
        margin-bottom: 0;
        font-weight: 600;
    }

    .recent-activity-card .card-body {
        padding: 0;
    }

    .activity-item {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #eee;
        transition: var(--transition);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        margin-right: 1rem;
    }

    .activity-icon-test {
        background-color: var(--primary);
    }

    .activity-icon-patient {
        background-color: var(--success);
    }

    .activity-icon-transaction {
        background-color: var(--warning);
    }

    .activity-content {
        flex-grow: 1;
    }

    .activity-title {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .activity-subtitle {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .activity-time {
        font-size: 0.8rem;
        color: #adb5bd;
        white-space: nowrap;
    }

    .quick-actions {
        border-radius: var(--card-radius);
        background-color: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .action-button {
        border: none;
        background-color: white;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        border-right: 1px solid #eee;
    }

    .action-button:last-child {
        border-right: none;
    }

    .action-button:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgba(67, 97, 238, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        transition: var(--transition);
    }

    .action-button:hover .action-icon {
        background-color: var(--primary);
        color: white;
    }

    .action-title {
        font-weight: 500;
        font-size: 0.85rem;
        color: var(--dark);
        margin: 0;
    }

    .chart-container {
        border-radius: var(--card-radius);
        background-color: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .chart-title {
        font-weight: 600;
        margin: 0;
    }

    .chart-wrapper {
        height: 300px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .action-button {
            border-right: none;
            border-bottom: 1px solid #eee;
        }

        .activity-item {
            flex-direction: column;
        }

        .activity-icon {
            margin-bottom: 0.75rem;
            margin-right: 0;
        }

        .activity-time {
            margin-top: 0.5rem;
        }
    }
</style>

<div class="container-fluid py-4 px-4">
    <!-- Dashboard Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="dashboard-title">Super Admin Portal</h2>
        </div>
    </div>

    <!-- Key Stats -->
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-card-primary">
                <div class="card-body">
                    <i class="fas fa-users stat-card-icon"></i>
                    <h6 class="stat-card-title">Total Patients</h6>
                    <h3 class="stat-card-value">{{$totalPatients}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-card-success">
                <div class="card-body">
                    <i class="fas fa-flask stat-card-icon"></i>
                    <h6 class="stat-card-title">Total Tests</h6>
                    <h3 class="stat-card-value">{{$totalTests}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-card-warning">
                <div class="card-body">
                    <i class="fas fa-file-invoice-dollar stat-card-icon"></i>
                    <h6 class="stat-card-title">Total Revenue</h6>
                    <h3 class="stat-card-value">₹{{$totalPayments}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-card-danger">
                <div class="card-body">
                    <i class="fas fa-heartbeat stat-card-icon"></i>
                    <h6 class="stat-card-title">Active Franchise</h6>
                    <h3 class="stat-card-value">{{$activeFranchises}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-card-info">
                <div class="card-body">
                    <i class="fas fa-exchange-alt stat-card-icon"></i>
                    <h6 class="stat-card-title">Total Transactions</h6>
                    <h3 class="stat-card-value">{{$totalTransaction}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-card-secondary">
                <div class="card-body">
                    <i class="fa-regular fa-calendar-check stat-card-icon"></i>
                    <h6 class="stat-card-title">Total Appointment</h6>
                    <h3 class="stat-card-value">{{$totalAppointments}}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Period Selector -->
    <div class="period-selector">
        <button class="btn active" data-period="today">Today</button>
        <button class="btn" data-period="week">This Week</button>
        <button class="btn" data-period="month">This Month</button>
        <button class="btn" data-period="year">This Year</button>
    </div>

    <!-- Period Stats (Will toggle based on selection) -->
    <div class="row mt-4 period-stats" id="period-stats">
        <div class="col-12">
            <div class="section-heading">
                <i class="fas fa-calendar-alt section-icon"></i>
                <h4>Today's Summary</h4>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-card-light">
                <div class="card-body">
                    <h6 class="stat-card-title">New Patients</h6>
                    <h3 class="stat-card-value">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-card-light">
                <div class="card-body">
                    <h6 class="stat-card-title">Tests Conducted</h6>
                    <h3 class="stat-card-value">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-card-light">
                <div class="card-body">
                    <h6 class="stat-card-title">Revenue</h6>
                    <h3 class="stat-card-value">₹0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-card-light">
                <div class="card-body">
                    <h6 class="stat-card-title">Reports Generated</h6>
                    <h3 class="stat-card-value">0</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const allStats = {
        today: {
            new_patients: @json($summaryToday['newPatients']),
            tests_conducted: @json($summaryToday['testsConducted']),
            revenue: @json($summaryToday['revenue']),
            reports_generated: @json($summaryToday['reportsGenerated']),
        },
        week: {
            new_patients: @json($summaryWeek['newPatients']),
            tests_conducted: @json($summaryWeek['testsConducted']),
            revenue: @json($summaryWeek['revenue']),
            reports_generated: @json($summaryWeek['reportsGenerated']),
        },
        month: {
            new_patients: @json($summaryMonth['newPatients']),
            tests_conducted: @json($summaryMonth['testsConducted']),
            revenue: @json($summaryMonth['revenue']),
            reports_generated: @json($summaryMonth['reportsGenerated']),
        },
        year: {
            new_patients: @json($summaryYear['newPatients']),
            tests_conducted: @json($summaryYear['testsConducted']),
            revenue: @json($summaryYear['revenue']),
            reports_generated: @json($summaryYear['reportsGenerated']),
        }
    };

    document.querySelectorAll('.period-selector .btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.period-selector .btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const period = this.dataset.period;
            const heading = document.querySelector('.section-heading h4');
            const labels = {
                today: "Today's Summary",
                week: "This Week's Summary",
                month: "This Month's Summary",
                year: "This Year's Summary"
            };
            heading.textContent = labels[period];

            const data = allStats[period];
            updatePeriodStats([
                data.new_patients,
                data.tests_conducted,
                data.revenue,
                data.reports_generated
            ]);
        });
    });

    function updatePeriodStats(data) {
        const statValues = document.querySelectorAll('#period-stats .stat-card-value');
        statValues[0].textContent = data[0];
        statValues[1].textContent = data[1];
        statValues[2].textContent = '₹' + Number(data[2]).toLocaleString();
        statValues[3].textContent = data[3];
    }

    // Trigger default
    document.querySelector('.period-selector .btn[data-period="today"]').click();
</script>


@endsection