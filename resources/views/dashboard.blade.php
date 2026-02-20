@extends('layouts.app')

@section('title', 'Pathlab | Advanced Diagnostics')

@section('content')

<style>
    /* Modern Advanced CSS & Color Palette */
    :root {
        --primary-color: #0d6efd;
        --secondary-color: #00c6ff;
        --accent-color: #0072ff;
        --success-color: #00b09b;
        --warning-color: #f9d423;
        --danger-color: #ff4b2b;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --bg-light: #f8fafc;
        --bg-white: #ffffff;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    /* Gradient Texts & Backgrounds */
    .text-gradient {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .text-gradient-animated {
        background: linear-gradient(270deg, #0d6efd, #00c6ff, #00b09b, #0d6efd);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientFlow 6s ease infinite;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    }

    .bg-gradient-mesh {
        background-color: #ffffff;
        background-image: radial-gradient(at 40% 20%, hsla(213,100%,73%,0.15) 0px, transparent 50%),
                          radial-gradient(at 80% 0%, hsla(189,100%,56%,0.15) 0px, transparent 50%),
                          radial-gradient(at 0% 50%, hsla(340,100%,76%,0.15) 0px, transparent 50%);
    }

    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Glassmorphism Navbar */
    .glass-navbar {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    .nav-link {
        font-weight: 500;
        position: relative;
        transition: color 0.3s ease;
        padding: 0.5rem 1rem;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: var(--primary-color);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after { width: 80%; }
    .nav-link:hover { color: var(--primary-color) !important; }

    /* Buttons */
    .btn-gradient {
        background: linear-gradient(45deg, var(--secondary-color), var(--accent-color));
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 12px 28px;
        box-shadow: 0 4px 15px rgba(0, 114, 255, 0.3);
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 25px rgba(0, 114, 255, 0.5);
        color: white;
    }

    .pulse-btn {
        animation: pulseShadow 2s infinite;
    }
    @keyframes pulseShadow {
        0% { box-shadow: 0 0 0 0 rgba(0, 114, 255, 0.4); }
        70% { box-shadow: 0 0 0 15px rgba(0, 114, 255, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 114, 255, 0); }
    }

    /* Floating Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    .floating-element { animation: float 4s ease-in-out infinite; }
    .floating-element-delayed { animation: float 5s ease-in-out infinite 1s; }

    /* Hero Carousel Overlays */
    .hero-carousel .carousel-item { height: 90vh; min-height: 600px; }
    .hero-carousel .carousel-item img { height: 100%; width: 100%; object-fit: cover; }
    
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to right, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.2) 100%);
        z-index: 1;
    }

    .hero-content {
        position: absolute; top: 50%; left: 8%; transform: translateY(-50%);
        z-index: 2; color: white; max-width: 700px;
    }

    .hero-content h1 { font-size: 4.5rem; font-weight: 800; line-height: 1.1; }

    /* Modern Hover Cards */
    .modern-card {
        background: var(--bg-white);
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden; height: 100%; position: relative; z-index: 1;
    }

    .modern-card::before {
        content: ""; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(0, 198, 255, 0.05), rgba(0, 114, 255, 0.05));
        z-index: -1; opacity: 0; transition: opacity 0.4s ease;
    }

    .modern-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 114, 255, 0.1);
    }
    .modern-card:hover::before { opacity: 1; }

    /* Health Condition Chips */
    .condition-card {
        border-radius: 20px; text-align: center; padding: 20px;
        background: white; border: 1px solid #edf2f7; transition: 0.3s;
        cursor: pointer;
    }
    .condition-card:hover {
        background: var(--primary-color); color: white !important;
        transform: translateY(-5px);
    }
    .condition-card:hover i, .condition-card:hover h6 { color: white !important; }

    /* Package Cards */
    .package-card { border-radius: 24px; transition: all 0.3s ease; border: 2px solid transparent; }
    .package-card:hover { border-color: var(--secondary-color); transform: scale(1.03); z-index: 10; }

    /* Scrolling Ticker */
    .ticker-wrap { overflow: hidden; background: white; padding: 20px 0; border-bottom: 1px solid #eee; }
    .ticker { display: flex; width: 200%; animation: ticker 20s linear infinite; }
    .ticker-item { flex: 1 0 auto; text-align: center; padding: 0 2rem; filter: grayscale(100%) opacity(0.6); transition: 0.3s; }
    .ticker-item:hover { filter: grayscale(0%) opacity(1); }
    @keyframes ticker { 0% { transform: translate3d(0, 0, 0); } 100% { transform: translate3d(-50%, 0, 0); } }

    /* Section Headings */
    .section-title {
        position: relative; font-weight: 800; color: var(--text-dark); margin-bottom: 3rem; text-transform: capitalize;
    }
    .section-title::after {
        content: ''; position: absolute; bottom: -12px; left: 50%; transform: translateX(-50%);
        width: 80px; height: 5px; background: linear-gradient(45deg, var(--secondary-color), var(--accent-color)); border-radius: 5px;
    }

    /* Separated Accordion Customization */
    .accordion-item { border: none !important; margin-bottom: 15px; border-radius: 15px !important; box-shadow: 0 5px 15px rgba(0,0,0,0.03); overflow: hidden; }
    .accordion-button { font-weight: 600; padding: 1.25rem; }
    .accordion-button:not(.collapsed) { background: linear-gradient(45deg, rgba(0,198,255,0.1), rgba(0,114,255,0.1)); color: var(--primary-color); }
    .accordion-button:focus { box-shadow: none; }

    /* Floating Action Button (WhatsApp) */
    .fab-container { position: fixed; bottom: 30px; right: 30px; z-index: 999; }
    .fab-btn {
        width: 60px; height: 60px; background-color: #25D366; color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 30px; box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4); transition: 0.3s;
    }
    .fab-btn:hover { background-color: #1ebe5d; color: white; transform: scale(1.1); }

    /* Footer Gradient */
    .footer-modern { background: linear-gradient(135deg, #0f172a, #1e293b); color: #f8fafc; position: relative; overflow: hidden; }
    .footer-modern a { color: #94a3b8; text-decoration: none; transition: all 0.3s ease; }
    .footer-modern a:hover { color: var(--secondary-color); padding-left: 5px; }
</style>

<header>
    <nav class="navbar navbar-expand-lg fixed-top glass-navbar py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('img/Health.png') }}" class="img-fluid rounded me-2 shadow-sm" alt="Health Axis" loading="lazy" style="height:45px; width:45px; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Health+Axis&background=0d6efd&color=fff'" />
                <span class="fw-bold fs-4">Health <span class="text-gradient">Axis</span></span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars fs-3 text-dark"></i>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav align-items-center gap-1 fw-semibold">
                    <a class="nav-link px-2" href="/">Home</a>
                    <a class="nav-link px-2" href="#conditions">Conditions</a>
                    <a class="nav-link px-2" href="#packages">Packages</a>
                    <a class="nav-link px-2" href="#about">About</a>
                    <a class="nav-link px-2" href="#franchise">Locate Lab</a>
                    <a class="nav-link px-2" href="#contact">Contact</a>
                    
                    <div class="nav-item dropdown px-2">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown">
                            Logins
                        </a>
                        <ul class="dropdown-menu border-0 shadow-lg rounded-4 mt-2">
                            <li><a class="dropdown-item py-2 fw-semibold" href="{{route('patient-login')}}"><i class="fas fa-user-injured me-2 text-primary"></i> Patient Portal</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold" href="{{route('franchise-login')}}"><i class="fas fa-clinic-medical me-2 text-success"></i> Franchise Portal</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2 fw-semibold" href="{{route('admin-login')}}"><i class="fas fa-user-shield me-2 text-dark"></i> Admin Portal</a></li>
                        </ul>
                    </div>
                    
                    <a class="btn btn-gradient ms-lg-3 mt-3 mt-lg-0 pulse-btn" href="{{route('patient-login')}}">
                        <i class="fas fa-calendar-alt me-2"></i> Book Test
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main style="margin-top: 80px;" class="bg-gradient-mesh">

    <section id="hero" class="hero-carousel position-relative">
        <div id="mainHeroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainHeroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#mainHeroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#mainHeroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="{{ asset('img/2.png') }}" onerror="this.src='https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&q=80&w=2000'" alt="Slide 2" />
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <span class="badge bg-success mb-3 px-4 py-2 rounded-pill fs-6 border border-light"><i class="fas fa-shield-alt me-2"></i> 100% Secure & Private</span>
                        <h1 class="display-3">Digital Health<br>At Your Fingertips</h1>
                        <p class="lead mt-4 mb-5 text-light opacity-75 fs-5">Access digital reports, manage inventory, and book home-collection tests instantly from the comfort of your home.</p>
                        <a href="#how-it-works" class="btn btn-gradient btn-lg px-5">See How It Works</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('img/3.png') }}" onerror="this.src='https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&q=80&w=2000'" alt="Slide 3" />
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <span class="badge bg-info mb-3 px-4 py-2 rounded-pill fs-6 border border-light"><i class="fas fa-globe me-2"></i> Global Network</span>
                        <h1 class="display-3">Join Our Growing<br>Franchise Network</h1>
                        <p class="lead mt-4 mb-5 text-light opacity-75 fs-5">Expand your diagnostic center with our state-of-the-art lab management software and unified billing system.</p>
                        <a href="#franchise" class="btn btn-gradient btn-lg px-5">Find a Lab</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container position-relative" style="margin-top: -60px; z-index: 10;">
            <div class="row bg-white rounded-4 shadow-lg p-4 text-center mx-2 mx-md-0 border border-light" data-aos="fade-up" data-aos-delay="200">
                <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                    <h2 class="fw-bold text-gradient mb-0"><span class="counter" data-target="500">0</span>+</h2>
                    <p class="text-muted small fw-semibold mb-0">Partner Labs</p>
                </div>
                <div class="col-6 col-md-3 mb-3 mb-md-0 border-end-md">
                    <h2 class="fw-bold text-gradient mb-0"><span class="counter" data-target="25000">0</span>+</h2>
                    <p class="text-muted small fw-semibold mb-0">Happy Patients</p>
                </div>
                <div class="col-6 col-md-3 border-end">
                    <h2 class="fw-bold text-gradient mb-0"><span class="counter" data-target="150">0</span>+</h2>
                    <p class="text-muted small fw-semibold mb-0">Test Varieties</p>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-bold text-gradient mb-0"><span class="counter" data-target="10">0</span> Yrs</h2>
                    <p class="text-muted small fw-semibold mb-0">Of Excellence</p>
                </div>
            </div>
        </div>
    </section>

    <div class="ticker-wrap shadow-sm">
        <div class="ticker">
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-award me-2"></i>NABL Accredited</h4></div>
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-globe me-2"></i>ISO 9001:2015</h4></div>
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-shield-alt me-2"></i>ICMR Approved</h4></div>
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-check-circle me-2"></i>CAP Certified</h4></div>
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-heartbeat me-2"></i>WHO Compliant</h4></div>
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-award me-2"></i>NABL Accredited</h4></div>
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-globe me-2"></i>ISO 9001:2015</h4></div>
            <div class="ticker-item"><h4 class="fw-bold text-muted m-0"><i class="fas fa-shield-alt me-2"></i>ICMR Approved</h4></div>
        </div>
    </div>

    <section class="py-5 mt-4" id="conditions">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Targeted Diagnostics</span>
                <h2 class="section-title mt-2">Shop Tests by Condition</h2>
            </div>
            
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="condition-card shadow-sm">
                        <i class="fas fa-heartbeat fa-2x text-danger mb-3"></i>
                        <h6 class="fw-bold text-dark m-0">Heart</h6>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="condition-card shadow-sm">
                        <i class="fas fa-lungs fa-2x text-info mb-3"></i>
                        <h6 class="fw-bold text-dark m-0">Lungs</h6>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="condition-card shadow-sm">
                        <i class="fas fa-crutch fa-2x text-warning mb-3"></i>
                        <h6 class="fw-bold text-dark m-0">Bones & Joints</h6>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="400">
                    <div class="condition-card shadow-sm">
                        <i class="fas fa-tint fa-2x text-primary mb-3"></i>
                        <h6 class="fw-bold text-dark m-0">Diabetes</h6>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="500">
                    <div class="condition-card shadow-sm">
                        <i class="fas fa-brain fa-2x text-purple mb-3" style="color: #6f42c1;"></i>
                        <h6 class="fw-bold text-dark m-0">Thyroid</h6>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="600">
                    <div class="condition-card shadow-sm">
                        <i class="fas fa-female fa-2x text-pink mb-3" style="color: #e83e8c;"></i>
                        <h6 class="fw-bold text-dark m-0">Women Health</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white" id="logins">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Access Modules</span>
                <h2 class="section-title mt-2">Select Your Portal</h2>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="modern-card p-4 text-center d-flex flex-column h-100 bg-light">
                        <div class="bg-primary bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-4 floating-element" style="width: 100px; height: 100px;">
                            <i class="fas fa-procedures fa-2x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Patient Portal</h4>
                        <p class="text-muted fs-6 mb-4 flex-grow-1">View verified reports, track health history, and book home tests or center visits easily.</p>
                        <a href="{{route('patient-login')}}" class="btn btn-outline-primary rounded-pill py-2 fw-semibold w-100 mt-auto">Login as Patient <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="modern-card p-4 text-center d-flex flex-column h-100 bg-light">
                        <div class="bg-success bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-4 floating-element-delayed" style="width: 100px; height: 100px;">
                            <i class="fas fa-clinic-medical fa-2x text-success"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Franchise Portal</h4>
                        <p class="text-muted fs-6 mb-4 flex-grow-1">Manage local lab operations, staff, daily patient flows, and track revenue seamlessly.</p>
                        <a href="{{route('franchise-login')}}" class="btn btn-outline-success rounded-pill py-2 fw-semibold w-100 mt-auto">Login as Franchise <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="modern-card p-4 text-center d-flex flex-column h-100 bg-light">
                        <div class="bg-dark bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-4 floating-element" style="width: 100px; height: 100px;">
                            <i class="fas fa-user-cog fa-2x text-dark"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Admin Portal</h4>
                        <p class="text-muted fs-6 mb-4 flex-grow-1">Master control panel. Approve franchises, manage test parameters, and view global analytics.</p>
                        <a href="{{route('admin-login')}}" class="btn btn-outline-dark rounded-pill py-2 fw-semibold w-100 mt-auto">Login as Admin <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="packages">
        <div class="container py-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5" data-aos="fade-up">
                <div>
                    <span class="text-primary fw-bold text-uppercase tracking-wider">Preventive Care</span>
                    <h2 class="fw-bold mt-2 mb-0">Popular Health Packages</h2>
                </div>
                <a href="{{route('patient-login')}}" class="btn btn-outline-primary rounded-pill mt-3 mt-md-0 px-4">View All Packages</a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card package-card h-100 bg-white shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-dark mb-0">Basic Body Checkup</h5>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">Best Seller</span>
                        </div>
                        <p class="text-muted small">Includes 60+ parameters covering vital organs.</p>
                        <hr class="opacity-25">
                        <ul class="list-unstyled text-muted small mb-4 flex-grow-1">
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> CBC (Complete Blood Count)</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> Liver Function Test</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> Kidney Function Test</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> Lipid Profile</li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-center mt-auto bg-light p-3 rounded-4">
                            <div>
                                <h4 class="fw-bold text-primary mb-0">₹999</h4>
                                <del class="text-muted small">₹1,500</del>
                            </div>
                            <button class="btn btn-gradient px-4 py-2 rounded-pill">Book Now</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card package-card h-100 bg-gradient-primary text-white border-0 shadow-lg p-4 position-relative overflow-hidden transform-scale">
                        <div class="position-absolute top-0 end-0 opacity-10 p-3">
                            <i class="fas fa-heartbeat fa-6x"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 position-relative z-1">
                            <h5 class="fw-bold mb-0">Comprehensive Care</h5>
                            <span class="badge bg-light text-primary px-3 py-2 rounded-pill shadow-sm">Recommended</span>
                        </div>
                        <p class="text-light opacity-75 small position-relative z-1">Advanced screening with 90+ parameters.</p>
                        <hr class="border-light opacity-25">
                        <ul class="list-unstyled text-light small mb-4 flex-grow-1 position-relative z-1">
                            <li class="mb-3"><i class="fas fa-check-circle text-info me-2 fs-6"></i> All Basic Checkup Tests</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-info me-2 fs-6"></i> Thyroid Profile (T3, T4, TSH)</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-info me-2 fs-6"></i> HbA1c (Diabetes)</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-info me-2 fs-6"></i> Vitamin D & B12</li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-center mt-auto position-relative z-1 bg-white bg-opacity-10 p-3 rounded-4">
                            <div>
                                <h4 class="fw-bold mb-0">₹1,999</h4>
                                <del class="text-light opacity-75 small">₹3,000</del>
                            </div>
                            <button class="btn btn-light text-primary fw-bold px-4 py-2 rounded-pill shadow-sm pulse-btn">Book Now</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card package-card h-100 bg-white shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-dark mb-0">Senior Citizen Profile</h5>
                            <span class="badge bg-info text-white px-3 py-2 rounded-pill shadow-sm">Age 60+</span>
                        </div>
                        <p class="text-muted small">Specialized tests focused on age-related health.</p>
                        <hr class="opacity-25">
                        <ul class="list-unstyled text-muted small mb-4 flex-grow-1">
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> Cardiac Risk Markers</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> Arthritis Screening</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> Bone Health Profile</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2 fs-6"></i> Complete Urine Analysis</li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-center mt-auto bg-light p-3 rounded-4">
                            <div>
                                <h4 class="fw-bold text-primary mb-0">₹2,499</h4>
                                <del class="text-muted small">₹4,000</del>
                            </div>
                            <button class="btn btn-gradient px-4 py-2 rounded-pill">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white" id="services">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">System Capabilities</span>
                <h2 class="section-title mt-2">Powerful Features</h2>
                <p class="text-muted">Tools designed to automate, secure, and scale your diagnostic operations.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="modern-card p-4 text-center">
                        <div class="icon-box"><i class="fas fa-user-injured fs-2"></i></div>
                        <h5 class="fw-bold">Smart Patient DB</h5>
                        <p class="text-muted small mt-2">End-to-end tracking of patient data and historical test charts.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="modern-card p-4 text-center">
                        <div class="icon-box"><i class="fas fa-motorcycle fs-2"></i></div>
                        <h5 class="fw-bold">Home Collection</h5>
                        <p class="text-muted small mt-2">Schedule phlebotomists with geo-tracking and ETA alerts.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="modern-card p-4 text-center">
                        <div class="icon-box"><i class="fas fa-file-pdf fs-2"></i></div>
                        <h5 class="fw-bold">QR Smart Reports</h5>
                        <p class="text-muted small mt-2">Automated report generation with anti-counterfeit QR codes.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="modern-card p-4 text-center">
                        <div class="icon-box"><i class="fas fa-chart-pie fs-2"></i></div>
                        <h5 class="fw-bold">Financial Analytics</h5>
                        <p class="text-muted small mt-2">Dashboards for real-time revenue tracking and commissions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="about">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="position-relative">
                        <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-gradient-primary opacity-25 rounded-circle" style="filter: blur(60px); z-index:0;"></div>
                        
                        <div class="row g-3 position-relative z-1">
                            <div class="col-6 mt-5 position-relative">
                                <img src="{{ asset('img/7.png') }}" onerror="this.src='https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?auto=format&fit=crop&w=600&q=80'" class="img-fluid rounded-4 shadow-lg mb-3" alt="Lab Tech">
                                <div class="position-absolute top-50 start-50 translate-middle text-white floating-element" style="cursor: pointer;">
                                    <i class="fas fa-play-circle fa-4x opacity-75 hover-opacity-100"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('img/8.png') }}" onerror="this.src='https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=600&q=80'" class="img-fluid rounded-4 shadow-lg mb-3" alt="Doctor Report">
                                <div class="bg-white p-3 rounded-4 shadow-sm text-center">
                                    <i class="fas fa-award fa-2x text-warning mb-2"></i>
                                    <h6 class="fw-bold m-0">NABL Accredited</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="text-primary fw-bold text-uppercase tracking-wider">Know The Axis</span>
                    <h2 class="display-5 fw-bold mb-4 mt-2">Transforming the Healthcare Data Industry</h2>
                    <p class="text-muted fs-6 mb-4 lh-lg">
                        At Health Axis Pathlab Management System, we provide a smart, efficient, and fully automated diagnostic ecosystem. We bridge the gap between patients, phlebotomists, and diagnostic centers, ensuring seamless coordination from sample collection to final report delivery.
                    </p>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-2 bg-white rounded-3 shadow-sm border-start border-3 border-success">
                                <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                                <span class="fw-semibold">100% Accurate Results</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-2 bg-white rounded-3 shadow-sm border-start border-3 border-success">
                                <i class="fas fa-bolt text-success fs-4 me-3 px-1"></i>
                                <span class="fw-semibold">Fast Turnaround Time</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 border-start border-4 border-primary bg-white shadow-sm rounded-end mt-4">
                        <h5 class="fw-bold text-dark m-0 fst-italic">"Join us in redefining healthcare – where advanced technology meets precision accuracy."</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white" id="team">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Our Specialists</span>
                <h2 class="section-title mt-2">Meet Our Expert Pathologists</h2>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="modern-card text-center border-0 bg-light p-0">
                        <img src="https://images.unsplash.com/photo-1537368910025-700350fe46c7?auto=format&fit=crop&w=500&q=80" class="w-100" style="height: 250px; object-fit: cover;" alt="Dr. Sharma">
                        <div class="p-4">
                            <h5 class="fw-bold text-dark">Dr. Arvind Sharma</h5>
                            <p class="text-primary small fw-semibold mb-2">Chief Pathologist (MD)</p>
                            <p class="text-muted small">15+ years experience in Hematology and Clinical Pathology.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="modern-card text-center border-0 bg-light p-0">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=500&q=80" class="w-100" style="height: 250px; object-fit: cover;" alt="Dr. Gupta">
                        <div class="p-4">
                            <h5 class="fw-bold text-dark">Dr. Sneha Gupta</h5>
                            <p class="text-primary small fw-semibold mb-2">Head of Microbiology</p>
                            <p class="text-muted small">Specializes in infectious diseases and molecular diagnostics.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="modern-card text-center border-0 bg-light p-0">
                        <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=500&q=80" class="w-100" style="height: 250px; object-fit: cover;" alt="Dr. Patel">
                        <div class="p-4">
                            <h5 class="fw-bold text-dark">Dr. Vikram Patel</h5>
                            <p class="text-primary small fw-semibold mb-2">Biochemistry Specialist</p>
                            <p class="text-muted small">Expert in advanced hormonal assays and metabolic screening.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="how-it-works">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Simple Process</span>
                <h2 class="section-title mt-2">How It Works</h2>
            </div>
            
            <div class="row text-center mt-5 position-relative">
                <div class="d-none d-md-block position-absolute top-25 start-10 w-75 border-top border-2 border-dashed border-primary opacity-25" style="z-index: 0; margin-top: 45px;"></div>
                
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="position-relative z-1">
                        <div class="icon-box bg-white shadow-lg mx-auto mb-4 floating-element" style="width: 90px; height: 90px; border: 3px solid var(--primary-color);">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-primary fs-5" style="width:30px;height:30px;">1</span>
                            <i class="fas fa-laptop-medical fs-1 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Book Online</h4>
                        <p class="text-muted mt-2 px-md-4">Choose a specific test or package and schedule an appointment.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="position-relative z-1">
                        <div class="icon-box bg-white shadow-lg mx-auto mb-4 floating-element-delayed" style="width: 90px; height: 90px; border: 3px solid var(--primary-color);">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-primary fs-5" style="width:30px;height:30px;">2</span>
                            <i class="fas fa-vial fs-1 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Sample Collection</h4>
                        <p class="text-muted mt-2 px-md-4">Visit a lab or opt for our trained phlebotomists for a home pickup.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="position-relative z-1">
                        <div class="icon-box bg-white shadow-lg mx-auto mb-4 floating-element" style="width: 90px; height: 90px; border: 3px solid var(--primary-color);">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-primary fs-5" style="width:30px;height:30px;">3</span>
                            <i class="fas fa-file-download fs-1 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Get Reports</h4>
                        <p class="text-muted mt-2 px-md-4">Download digitally verified reports securely via WhatsApp or Portal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-gradient-primary text-white overflow-hidden">
        <div class="container position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-3">Health Tracking In Your Pocket</h2>
                    <p class="lead opacity-75 mb-4">Download the Health Axis mobile app to book tests in seconds, track family members, and keep a lifelong history of your medical reports.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                        <a href="#" class="btn btn-dark btn-lg d-flex align-items-center rounded-pill px-4 shadow pulse-btn">
                            <i class="fab fa-apple fs-2 me-2"></i>
                            <div class="text-start lh-1">
                                <small class="d-block text-white-50" style="font-size: 0.7rem;">Download on the</small>
                                <span class="fw-bold text-white">App Store</span>
                            </div>
                        </a>
                        <a href="#" class="btn btn-light text-dark btn-lg d-flex align-items-center rounded-pill px-4 shadow">
                            <i class="fab fa-google-play fs-2 me-2 text-success"></i>
                            <div class="text-start lh-1">
                                <small class="d-block text-muted" style="font-size: 0.7rem;">GET IT ON</small>
                                <span class="fw-bold text-dark">Google Play</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center" data-aos="fade-up">
                    <div class="position-relative d-inline-block">
                        <div class="bg-white bg-opacity-10 rounded-circle position-absolute top-50 start-50 translate-middle" style="width: 400px; height: 400px; z-index: -1;"></div>
                        <i class="fas fa-heartbeat fa-3x text-danger position-absolute floating-element" style="top: 10%; left: -10%;"></i>
                        <i class="fas fa-pills fa-2x text-warning position-absolute floating-element-delayed" style="bottom: 20%; right: -15%;"></i>
                        
                        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=300&h=600&q=80" class="img-fluid rounded-5 shadow-lg border border-4 border-dark" style="max-height: 500px; object-fit: cover;" alt="Mobile App Mockup">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="blog">
        <div class="container py-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5" data-aos="fade-up">
                <div>
                    <span class="text-primary fw-bold text-uppercase tracking-wider">Health Tips</span>
                    <h2 class="fw-bold mt-2 mb-0">Latest Articles</h2>
                </div>
                <a href="#" class="btn btn-outline-primary rounded-pill mt-3 mt-md-0 px-4">Read All Blog Posts</a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="modern-card border-0 bg-white">
                        <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=500&q=80" class="card-img-top" style="height:200px; object-fit:cover;" alt="Healthy Food">
                        <div class="card-body p-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-2">Nutrition</span>
                            <h5 class="fw-bold text-dark">Top 10 Foods for a Healthy Heart</h5>
                            <p class="text-muted small">Discover the best dietary choices to keep your cardiovascular system running smoothly...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="modern-card border-0 bg-white">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5e4a4220c?auto=format&fit=crop&w=500&q=80" class="card-img-top" style="height:200px; object-fit:cover;" alt="Blood Test">
                        <div class="card-body p-4">
                            <span class="badge bg-success bg-opacity-10 text-success mb-2">Diagnostics</span>
                            <h5 class="fw-bold text-dark">Why Annual Blood Tests Matter</h5>
                            <p class="text-muted small">Preventive healthcare starts with understanding your baseline metrics. Learn why checking...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="modern-card border-0 bg-white">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=500&q=80" class="card-img-top" style="height:200px; object-fit:cover;" alt="Yoga">
                        <div class="card-body p-4">
                            <span class="badge bg-warning bg-opacity-10 text-warning mb-2">Wellness</span>
                            <h5 class="fw-bold text-dark">Managing Stress for Better Immunity</h5>
                            <p class="text-muted small">Chronic stress can lower your immune response. Explore effective ways to manage anxiety...</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white" id="franchise">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Network</span>
                <h2 class="section-title mt-2">Search Your Nearest Lab</h2>
                <p class="text-muted">Find trusted franchise centers in your city to drop off samples or book in-person tests.</p>
            </div>
            
            <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-8 col-lg-6">
                    <div class="input-group input-group-lg shadow rounded-pill overflow-hidden border border-primary border-opacity-25 bg-white p-1">
                        <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-search text-primary"></i></span>
                        <input type="text" id="franchiseSearch" class="form-control border-0 bg-transparent shadow-none" placeholder="Search by name, city, or zip code...">
                        <button class="btn btn-primary rounded-pill px-4 fw-bold" type="button">Find Lab</button>
                    </div>
                </div>
            </div>

            <div class="row g-4 container mx-auto" id="franchiseList">
                @if(isset($franchises) && count($franchises) > 0)
                    @foreach($franchises as $franchise)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up">
                        <div class="modern-card border border-light">
                            <img src="{{ asset('storage/' .$franchise->franchise_image) }}" onerror="this.src='https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=500&q=80'" class="card-img-top w-100" style="height: 220px; object-fit: cover;" alt="{{ $franchise->lab_name }}">
                            <div class="card-body p-4 text-center">
                                <h5 class="card-title fw-bold text-dark">{{$franchise->lab_name}}</h5>
                                <p class="text-muted mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i> {{$franchise->lab_location}}</p>
                                <div class="d-flex justify-content-center gap-2 mb-3">
                                    <span class="badge bg-success bg-opacity-10 text-success"><i class="fas fa-star text-warning"></i> 4.8</span>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Verified</span>
                                </div>
                                <a href="{{route('patient-login')}}" class="btn btn-outline-primary rounded-pill w-100 fw-semibold">Book at this Lab</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" style="width:100px; opacity:0.3;" alt="No labs">
                        <h5 class="mt-4 text-muted">Labs populating soon...</h5>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="testimonials">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Reviews</span>
                <h2 class="section-title mt-2">What People Say</h2>
            </div>
            
            <div class="row justify-content-center mt-4">
                <div class="col-md-9" data-aos="zoom-in" data-aos-delay="100">
                    <div class="modern-card p-4 p-md-5 bg-white border-0 shadow-lg">
                        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner text-center">
                                @if(isset($testimonials) && count($testimonials) > 0)
                                    @foreach($testimonials as $index => $testimonial)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <i class="fas fa-quote-left fa-3x text-primary opacity-25 mb-4"></i>
                                        <p class="lead font-italic text-dark mb-4 px-md-5 fs-4">"{{$testimonial->message}}"</p>
                                        <div class="text-warning mb-3 fs-5">
                                            @for($i = 1; $i <= $testimonial->rating; $i++) <i class="fas fa-star"></i> @endfor
                                            @for($i = $testimonial->rating + 1; $i <= 5; $i++) <i class="far fa-star"></i> @endfor
                                        </div>
                                        <h5 class="fw-bold mb-0">{{$testimonial->name}}</h5>
                                        <p class="text-muted small">{{$testimonial->designation}}</p>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <i class="fas fa-quote-left fa-3x text-primary opacity-25 mb-3"></i>
                                        <p class="lead font-italic text-dark mb-4 px-md-5 fs-4">"The home collection service was incredibly prompt, and I received my detailed digital reports on WhatsApp within 12 hours. Highly recommended!"</p>
                                        <img src="https://ui-avatars.com/api/?name=Ramesh+Kumar&background=0d6efd&color=fff" class="rounded-circle mb-3 shadow-sm" width="60" alt="User">
                                        <div class="text-warning mb-1 fs-6">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0">Ramesh Kumar</h6>
                                        <p class="text-muted small">Verified Patient</p>
                                    </div>
                                    <div class="carousel-item">
                                        <i class="fas fa-quote-left fa-3x text-primary opacity-25 mb-3"></i>
                                        <p class="lead font-italic text-dark mb-4 px-md-5 fs-4">"Taking the franchise of Health Axis was the best decision. The admin software manages all my billing and inventory automatically."</p>
                                        <img src="https://ui-avatars.com/api/?name=Sunita+Sharma&background=00c6ff&color=fff" class="rounded-circle mb-3 shadow-sm" width="60" alt="User">
                                        <div class="text-warning mb-1 fs-6">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0">Dr. Sunita Sharma</h6>
                                        <p class="text-muted small">Franchise Owner</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="carousel-indicators position-relative mt-4 mb-0">
                                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active bg-primary"></button>
                                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" class="bg-primary"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white" id="faq">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Clarifications</span>
                <h2 class="section-title mt-2">Frequently Asked Questions</h2>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button py-3 rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How long does it take to get my test reports?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted px-4 py-3">
                                    Most standard routine blood tests are processed and digital reports are sent to your WhatsApp and Portal within 12-24 hours of sample collection.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed py-3 rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Is the home sample collection safe?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted px-4 py-3">
                                    Absolutely. Our phlebotomists follow strict WHO hygiene protocols, use fresh single-use sealed kits, and maintain temperature-controlled transport for your samples.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed py-3 rounded-4" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    How can I apply for a Franchise?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted px-4 py-3">
                                    You can scroll down to our contact section and fill out the inquiry form. Our business development team will contact you within 48 hours to discuss requirements and investment.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="contact">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="text-primary fw-bold text-uppercase tracking-wider">Support</span>
                    <h2 class="fw-bold mt-2 mb-4">Get In Touch</h2>
                    <p class="text-muted mb-5">Have questions about your tests or looking to partner with us? Our support team is available 24/7.</p>
                    
                    <div class="card mb-4 p-4 border-start border-4 border-primary">
                        <div class="d-flex align-items-center">
                            <div class="icon-box mb-0 me-3 bg-primary bg-opacity-10 text-primary" style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Support</h6>
                                <a href="mailto:support@healthAxis.com" class="text-decoration-none text-muted">support@healthAxis.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 p-4 border-start border-4 border-success">
                        <div class="d-flex align-items-center">
                            <div class="icon-box mb-0 me-3 bg-success bg-opacity-10 text-success" style="width: 50px; height: 50px;">
                                <i class="fas fa-phone-alt fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Toll-Free Helpline</h6>
                                <a href="tel:+919876543210" class="text-decoration-none text-muted">1800-123-4567</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card p-4 border-start border-4 border-warning">
                        <div class="d-flex align-items-center">
                            <div class="icon-box mb-0 me-3 bg-warning bg-opacity-10 text-warning" style="width: 50px; height: 50px;">
                                <i class="fas fa-map-marker-alt fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Headquarters</h6>
                                <span class="text-muted small">72- New Vikas Nagar, Loni, Ghaziabad, UP</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="modern-card p-4 p-md-5 shadow-lg border-0 bg-white">
                        <h3 class="fw-bold mb-2">Partner With Us</h3>
                        <p class="text-muted mb-4">Fill out the form below for franchise inquiries or general questions.</p>
                        
                        <form action="{{route('query.store')}}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded-3" id="name" placeholder="John Doe" name="name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control rounded-3" id="phone" placeholder="+91 xxxxx xxxxx" name="phone_number" required>
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control rounded-3" id="email" placeholder="name@company.com" name="email" required>
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select rounded-3" id="inquiryType" name="type">
                                            <option value="franchise">Franchise Application</option>
                                            <option value="support">Patient Support</option>
                                            <option value="other">Other Query</option>
                                        </select>
                                        <label for="inquiryType">Inquiry Type</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control rounded-3" placeholder="Tell us about your location..." id="message" style="height: 120px" name="message" required></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-gradient w-100 py-3 fs-5 fw-bold rounded-pill">
                                        <i class="fas fa-paper-plane me-2"></i> Send Inquiry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<div class="fab-container">
    <a href="https://wa.me/919876543210" target="_blank" class="fab-btn text-decoration-none">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<footer class="footer-modern pt-5 pb-3">
    <div class="container pt-4">
        <div class="row g-5 mb-5">
            <div class="col-lg-4 col-md-6">
                <a class="navbar-brand d-flex align-items-center mb-4 text-white" href="/">
                    <img src="{{ asset('img/pathlab_logo.jpg') }}" class="img-fluid rounded me-2 bg-white p-1" alt="Health Axis" style="height:40px; width:40px; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=H+A&background=fff&color=0d6efd'"/>
                    <span class="fw-bold fs-4">Health <span class="text-secondary">Axis</span></span>
                </a>
                <p class="text-secondary opacity-75 pe-md-4 mb-4">India's leading intelligent PathLab management system delivering precise diagnostics and robust software solutions for labs everywhere.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold text-white mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#about"><i class="fas fa-angle-right me-2 text-secondary"></i> About Us</a></li>
                    <li class="mb-2"><a href="#services"><i class="fas fa-angle-right me-2 text-secondary"></i> Features</a></li>
                    <li class="mb-2"><a href="#packages"><i class="fas fa-angle-right me-2 text-secondary"></i> Health Packs</a></li>
                    <li class="mb-2"><a href="#franchise"><i class="fas fa-angle-right me-2 text-secondary"></i> Locate Lab</a></li>
                    <li class="mb-2"><a href="#blog"><i class="fas fa-angle-right me-2 text-secondary"></i> Health Tips</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold text-white mb-4">Our Portals</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{route('patient-login')}}"><i class="fas fa-angle-right me-2 text-secondary"></i> Patient Login</a></li>
                    <li class="mb-2"><a href="{{route('franchise-login')}}"><i class="fas fa-angle-right me-2 text-secondary"></i> Franchise Login</a></li>
                    <li class="mb-2"><a href="{{route('admin-login')}}"><i class="fas fa-angle-right me-2 text-secondary"></i> Admin Panel</a></li>
                    <li class="mb-2"><a href="#"><i class="fas fa-angle-right me-2 text-secondary"></i> Phlebotomist App</a></li>
                    <li class="mb-2"><a href="#"><i class="fas fa-angle-right me-2 text-secondary"></i> Doctor Portal</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold text-white mb-4">Newsletter</h5>
                <p class="text-secondary opacity-75 mb-3">Subscribe to get the latest health tips and updates on new lab locations.</p>
                <div class="input-group mb-3">
                    <input type="email" class="form-control bg-dark border-secondary text-white shadow-none" placeholder="Email Address">
                    <button class="btn btn-primary" type="button"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
        
        <hr class="border-secondary opacity-25">
        
        <div class="row align-items-center pt-3">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-secondary opacity-75 mb-0">&copy; {{ date('Y') }} Health Axis. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <a href="#" class="small me-3">Privacy Policy</a>
                <a href="#" class="small me-3">Terms of Service</a>
                <a href="#" class="small">Refund Policy</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize AOS animations
        AOS.init({ duration: 800, once: true, offset: 100 });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.glass-navbar').style.background = 'rgba(255, 255, 255, 0.98)';
                document.querySelector('.glass-navbar').style.boxShadow = '0 10px 30px rgba(0,0,0,0.1)';
            } else {
                document.querySelector('.glass-navbar').style.background = 'rgba(255, 255, 255, 0.85)';
                document.querySelector('.glass-navbar').style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.05)';
            }
        });

        // Number Counter Animation for Stats
        const counters = document.querySelectorAll('.counter');
        const speed = 200; 
        const animateCounters = () => {
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText.replace(/,/g, '');
                    const inc = target / speed;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc).toLocaleString();
                        setTimeout(updateCount, 15);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };
                updateCount();
            });
        };

        // Trigger counter animation on scroll
        let counted = false;
        window.addEventListener('scroll', () => {
            const statsSection = document.querySelector('#hero');
            if (statsSection) {
                const oTop = statsSection.offsetTop - window.innerHeight;
                if (counted === false && window.scrollY > oTop) {
                    animateCounters();
                    counted = true;
                }
            }
        });
    });
</script>

@endsection