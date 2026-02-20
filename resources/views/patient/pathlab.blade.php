@extends('patient.layout.app')

@section('title', 'Patient Dashboard')

@section('content')

<style>
    /* Main Variables */
    :root {
        --primary-color: #4056A1;
        --secondary-color: #3CAEA3;
        --light-bg: #f8f9fa;
        --card-border-radius: 12px;
        --box-shadow: 0 5px 15px rgba(0,0,0,0.07);
    }

    /* Page header */
    .page-header {
        background-color: white;
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
        padding: 40px 30px;
        margin-bottom: 40px;
        position: relative;
    }

    .page-header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .page-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 10px;
    }

    .page-subtitle {
        color: #6c757d;
        font-weight: 400;
    }

    /* Search container */
    .search-container {
        margin-bottom: 30px;
    }

    .search-input {
        border-radius: 50px;
        padding-left: 20px;
        height: 50px;
        border: 1px solid #e0e0e0;
    }


    /* Lab cards */
    .lab-card {
        border: none;
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        background-color: white;
        margin-bottom: 30px;
    }

    .lab-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
    }

    /* Image container */
    .lab-image-container {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .lab-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .lab-card:hover .lab-image {
        transform: scale(1.05);
    }

    /* Card content */
    .lab-card-content {
        padding: 20px;
    }

    /* Lab header */
    .lab-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .lab-name {
        font-weight: 600;
        color: var(--primary-color);
        margin: 0;
        font-size: 1.25rem;
    }

    .lab-badges {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .lab-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .lab-badge i {
        margin-right: 5px;
    }

    .lab-description {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    /* Info list */
    .lab-info-list {
        margin-bottom: 20px;
    }

    .lab-info-item {
        display: flex;
        margin-bottom: 10px;
    }

    .lab-info-item i {
        min-width: 20px;
        margin-right: 10px;
        color: var(--primary-color);
        margin-top: 4px;
    }

    .lab-info-text {
        font-size: 0.9rem;
        color: #505050;
    }

    /* View tests button */
    .btn-view-tests {
        background-color: var(--primary-color);
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-view-tests:hover {
        background-color: #344989;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background-color: white;
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
    }

    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 20px;
    }
</style>

<div class="container my-5">
    <!-- Page Header -->
    <div class="page-header text-center">
        <h1 class="page-title">Our Pathology Network</h1>
        <p class="page-subtitle">Find reliable diagnostic centers near you</p>
    </div>

    <!-- Search Bar -->
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control search-input border-start-0"
                        placeholder="Search by lab name, location, or city..." id="searchInput">
                    <button class="btn btn-primary" type="button">Search</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Lab Cards -->
    <div class="row">
        @forelse($franchises as $franchise)
        <div class="col-lg-4 col-md-6 franchise-card" 
            data-name="{{ strtolower($franchise->lab_name) }}" 
            data-location="{{ strtolower($franchise->lab_location) }}"
            data-city="{{ strtolower($franchise->city) }}"
            data-pincode="{{ $franchise->pincode }}">
            <div class="lab-card">
                <!-- Lab Image - NO DETAILS ON IMAGE -->
                <div class="lab-image-container">
                    <img src="{{ asset('storage/' . $franchise->franchise_image) }}" 
                        class="lab-image" 
                        alt="{{ $franchise->lab_name }}">
                </div>
                
                <!-- Card Content - ALL DETAILS BELOW IMAGE -->
                <div class="lab-card-content">
                    <!-- Lab Header -->
                    <div class="lab-header">
                        <h5 class="lab-name">{{ $franchise->lab_name }}</h5>
                        <span class="badge bg-primary rounded-pill">{{ $franchise->test_count }}+ Tests</span>
                    </div>
                    
                    <!-- Lab ID -->
                    <div class="mb-2">
                        <span class="badge bg-dark">ID: {{ $franchise->id }}</span>
                    </div>
                    
                    <!-- Lab Badges -->
                    <div class="lab-badges">
                        @if($franchise->home_collection)
                            <span class="lab-badge bg-success">
                                <i class="fas fa-home"></i> Home Collection
                            </span>
                        @endif
                        @if($franchise->insurance_accepted)
                            <span class="lab-badge bg-info">
                                <i class="fas fa-shield-alt"></i> Insurance
                            </span>
                        @endif
                    </div>
                    
                    <!-- Lab Description -->
                    @if($franchise->description)
                    <p class="lab-description mt-3">{{ Str::limit($franchise->description, 100) }}</p>
                    @endif
                    
                    <!-- Lab Info -->
                    <div class="lab-info-list">
                        <div class="lab-info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="lab-info-text">{{ $franchise->lab_location }}, {{ $franchise->City }} - {{ $franchise->pincode }}</span>
                        </div>
                        <div class="lab-info-item">
                            <i class="fas fa-phone-alt"></i>
                            <span class="lab-info-text">{{ $franchise->contact }}</span>
                        </div>
                        <div class="lab-info-item">
                            <i class="fas fa-clock"></i>
                            <span class="lab-info-text">{{ $franchise->Ohours }}</span>
                        </div>
                    </div>
                    
                    <!-- View Tests Button -->
                    <a href="{{ route('pathlab.tests', $franchise->id) }}" 
                       class="btn btn-view-tests d-flex align-items-center justify-content-center">
                        <i class="fas fa-flask me-2"></i> View Tests
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-vial"></i>
                <h4 class="text-muted">No laboratory franchises found</h4>
                <p class="text-muted">Please try a different search or check back later.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll('.franchise-card');
        
        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const location = card.getAttribute('data-location');
            const city = card.getAttribute('data-city');
            const pincode = card.getAttribute('data-pincode');
            
            if (name.includes(query) || location.includes(query) || city.includes(query) || pincode.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>

@endsection