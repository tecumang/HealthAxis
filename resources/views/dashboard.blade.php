@extends('layouts.app')

@section('title', 'Home page')

@section('content')


<header>
    <nav class="navbar navbar-expand-lg fixed-top bg-light-subtle">
        <div class="container-fluid">
            <a class="navbar-brand me-2" href="/">
                <img src="{{ asset('img/pathlab_logo.jpg') }}" class="img-fluid" alt="pathlab" loading="lazy" style="margin-top: -1px; height:50px;" />
            </a>
            <a class="navbar-brand" href="/">LBSATI Path Lab</a>
            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                    <a class="nav-link" href="#services">Services</a>
                    <a class="nav-link" href="#about">About Us</a>
                    <a class="nav-link" href="#franchise">Franchise</a>
                    <a class="nav-link" href="#contact">Contact Us</a>
                    <a class="nav-link" href="#logins">Logins</a>
                    <a class="btn btn-success"
                        href="{{route('patient-login')}}">Book&nbsp;&nbsp;an&nbsp;&nbsp;Appointment</a>
                </div>
            </div>

            <!-- Dark/Light Theme Switch -->
            <div class="d-flex align-items-center gap-3">
                <a class="nav-link" id="fullscreen-btn">
                    <i class="fas fa-expand"></i>
                </a>
            </div>
        </div>
    </nav>
</header>

<div style="margin-top: 58px;">

    <!-- Hero Section  -->
    <section class="mt-5 pt-1 pb-1" id="hero">
        <div class="row">
            <div class="col-md">
                <!-- Carousel wrapper -->
                <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel"
                    data-mdb-carousel-init>
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>

                    <!-- Inner -->
                    <div class="carousel-inner">
                        <!-- Single item -->
                        <div class="carousel-item active position-relative">
                            <img src="{{ asset('img/1.png') }}" class="d-block w-100" alt="Slide 1" />
                            <div class="overlay"></div>
                            <div class="carousel-text">
                                <h1>PATHLAB Management System</h1>
                            </div>
                        </div>

                        <!-- Single item -->
                        <div class="carousel-item position-relative">
                            <img src="{{ asset('img/2.png') }}" class="d-block w-100" alt="Slide 2" />
                            <div class="overlay"></div>
                            <div class="carousel-text">
                                <h1>PATHLAB Management System</h1>
                            </div>
                        </div>

                        <!-- Single item -->
                        <div class="carousel-item position-relative">
                            <img src="{{ asset('img/3.png') }}" class="d-block w-100" alt="Slide 3" />
                            <div class="overlay"></div>
                            <div class="carousel-text">
                                <h1>PATHLAB Management System</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Inner -->

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
                        data-mdb-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
                        data-mdb-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Carousel wrapper -->

            </div>
        </div>


    </section>

    <!-- Login Section  -->
    <section class="mt-5 pt-5 container" id="logins">
        <h2 class="text-center my-4">Logins</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 ">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('img/4.png') }}" class="card-img-top img-fluid rounded-top" alt="Patient">
                    <div class="card-body text-center">
                        <a href="{{route('patient-login')}}"><button class="btn btn-secondary text-dark py-2">Patient
                                Login</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('img/5.png') }}" class="card-img-top img-fluid rounded-top" alt="Franchise">
                    <div class="card-body text-center">
                        <a href="{{route('franchise-login')}}"><button
                                class="btn btn-secondary text-dark py-2">Franchise Login</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('img/6.png') }}" class="card-img-top img-fluid rounded-top" alt="Admin">
                    <div class="card-body text-center">
                        <a href="{{route('admin-login')}}"><button class="btn btn-secondary text-dark py-2">Admin
                                Login</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section  -->
    <section class="mt-5 pt-5 container" id="services">
        <h2 class="text-center my-4">Key Features</h2>
        <p class="text-center">Our Pathlab Management System Services & Features</p>
        <div class="row justify-content-center">

            <div class="col-md-4 mb-2 ">
                <div class="card feature-card text-center ">
                    <div class="card-body .card-body-1">
                        <i class="fas fa-user-injured fs-1"></i>
                        <h3>Patient Management</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-calendar-check fs-1"></i>
                        <h3>Online Test Booking</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-file-medical fs-1"></i>
                        <h3>Digital Reports</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-user-md fs-1"></i>
                        <h3>Franchise Portal</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-credit-card fs-1"></i>
                        <h3>Billing & Payments</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users-cog fs-1"></i>
                        <h3>Multi-User Role System</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-vials fs-1"></i>
                        <h3>Test Management</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-warehouse fs-1"></i>
                        <h3>Inventory & Stock Management</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card text-center">
                    <div class="card-body">
                        <i class="fas fa-shield-alt fs-1"></i>
                        <h3>Data Security & Backup</h3>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- About US Section  -->
    <section class="mt-5 pt-5 container-fluid" id="about">
        <div class="row align-items-center scroll-animation">
            <div class="col-md">
                <img src="{{ asset('img/7.png') }}" class="img-fluid ms-xl-3" alt="About Us Image">
            </div>
            <div class="col-md">
                <h2 class="text-center mt-2">About Us</h2>
                <h5 class="text-center mt-2 fw-lighter mx-4">At LBSATI Pathlab Management System, we are committed to transforming the healthcare
                    industry by providing a smart, efficient, and fully automated PathLab Management System. Our
                    platform is designed to bridge the gap between patients and diagnostic centers, ensuring seamless
                    coordination, accurate results, and a hassle-free experience.</h5>
                <h5 class="text-center mt-2 fw-lighter mx-4">Our mission is to simplify diagnostics, enhance accuracy, and ensure faster
                    turnaround times, making quality healthcare accessible to all. Backed by a team of experts and
                    innovative solutions, we are setting new standards in the diagnostic industry.</h5>
                <h5 class="text-center text-info mx-4">Join us in redefining healthcare – where technology meets accuracy, and convenience meets care</h5>
            </div>
        </div>
    </section>

    <!--  how its works  -->
    <section class="mt-5 py-5 bg-light" id="how-it-works">
        <div class="container">
            <h2 class="text-center mb-4">How It Works</h2>
            <div class="row text-center">
                <!-- Step 1 -->
                <div class="col-md-4">
                    <div class="card bg-transparent border-0 shadow-0 p-4">
                        <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                        <h4>Book Your Test Online</h4>
                        <p>Choose a test & schedule an appointment at your convenience.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="col-md-4">
                    <div class="card bg-transparent border-0 shadow-0 p-4">
                        <i class="fas fa-vial fa-3x text-success mb-3"></i>
                        <h4>Visit Lab or Home Sample Pickup</h4>
                        <p>Get tested at a nearby lab or opt for hassle-free home sample collection.</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="col-md-4">
                    <div class="card bg-transparent border-0 shadow-0 p-4">
                        <i class="fas fa-file-medical fa-3x text-success mb-3"></i>
                        <h4>Download Your Report</h4>
                        <p>Access your test results securely from anywhere.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Franchise Section  -->
    <section class="mt-5 pt-5 container" id="franchise">
        <h2 class="text-center mt-5">Search Your Nearest PathLab</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-4">
                    <input type="text" id="franchiseSearch" class="form-control"
                        placeholder="Search by name or location">
                    <button class="btn btn-success mx-2">Search</button>
                </div>
            </div>
        </div>
        <div class="row container" id="franchiseList">
            <!-- Dynamic franchise cards will be loaded here -->
            @foreach($franchises as $franchise)
            <div class="col-md-4 my-2">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' .$franchise->franchise_image) }}"
                        class="lab-image card-image-top"
                        alt="{{ $franchise->lab_name }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$franchise->lab_name}}</h5>
                        <p class="card-text">Location: {{$franchise->lab_location}}</p>
                        <a href="{{route('patient-login')}}" class="btn btn-outline-success">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!--  Testonmial Section -->
    <section class="mt-5 py-5 bg-light" id="testimonials">
        <div class="container">
            <h2 class="text-center mb-4">What People Say</h2>
            <div id="testimonialCarousel" class="carousel slide carousel-dark" data-mdb-ride="carousel">
                <!-- Inner -->
                <div class="carousel-inner mb-5 text-center">
                    @foreach($testimonials as $index => $testimonial)
                    <!-- Testimonial 1 -->
                    <div class="carousel-item active ">
                        <i class="fas fa-quote-left fa-2x text-primary"></i>
                        <p class="mt-3">"{{$testimonial->message}}"</p>
                        <h5 class="fw-bold mt-2">
                            @for($i = 1; $i <= $testimonial->rating; $i++)
                                ⭐
                                @endfor
                        </h5>
                        <p class="text-muted">- {{$testimonial->name}}, {{$testimonial->designation}}</p>
                    </div>
                    @endforeach
                </div>

                <!-- Indicators -->
                <div class="carousel-indicators position-relative mt-3">
                    <button type="button" data-mdb-target="#testimonialCarousel" data-mdb-slide-to="0" class="active"
                        aria-label="Slide 1"></button>
                    <button type="button" data-mdb-target="#testimonialCarousel" data-mdb-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-mdb-target="#testimonialCarousel" data-mdb-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-mdb-target="#testimonialCarousel"
                    data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#testimonialCarousel"
                    data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!--  Contact Us Section  -->
    <section class="mt-5 py-5 bg-light" id="contact">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="row">
                <!-- Patient Support -->
                <div class="col-md-6">
                    <div class="card bg-transparent border-0 shadow-0 p-4">
                        <h4 class="text-primary"><i class="fas fa-user-md"></i> Support for Patients</h4>
                        <p class="mt-3"><i class="fas fa-envelope text-primary"></i> Email: <a
                                href="mailto:support@example.com">support@example.com</a></p>
                        <p><i class="fas fa-phone-alt text-primary"></i> Phone: <a
                                href="tel:+919876543210">+91-9876543210</a></p>
                    </div>
                </div>

                <!-- Franchise Inquiry Form -->
                <div class="col-md-6">
                    <div class="card bg-transparent border-0 shadow-0 p-4">
                        <h4 class="text-success"><i class="fas fa-handshake"></i> Franchise Inquiry</h4>
                        <form action="{{route('query.store')}}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input type="text" class="form-control" placeholder="Enter your name" name="name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter your email" name="email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Enter your phone number"
                                    name="phone_number" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" rows="3" placeholder="Tell us your interest"
                                    name="message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100"><i class="fas fa-paper-plane"></i>
                                Submit Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="text-center mt-5 text-muted bg-warning-subtle">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{asset('img/pathlab_logo.jpg')}}" class="img-fluid">
                            </div>
                            <div class="col-md mt-2">
                                <h6 class="text-uppercase fw-bold mb-4">
                                    LBSTI PATHLAB Management System
                                </h6>
                            </div>
                        </div>
                        <p>
                            At LBSTI Pathlab Management System, we are committed to transforming the healthcare
                            industry by providing a smart, efficient, and fully automated PathLab Management System. Our
                            platform is designed to bridge the gap between patients and diagnostic centers, ensuring seamless
                            coordination, accurate results, and a hassle-free experience.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="/" class="text-reset">Home</a>
                        </p>
                        <p>
                            <a href="#services" class="text-reset">Services</a>
                        </p>
                        <p>
                            <a href="#about" class="text-reset">About US</a>
                        </p>
                        <p>
                            <a href="#franchise" class="text-reset">Franchise</a>
                        </p>
                        <p>
                            <a href="#contact" class="text-reset">Contact</a>
                        </p>
                        <p>
                            <a href="#logins" class="text-reset">Logins</a>
                        </p>
                        <p>
                            <a href="{{route('patient-login')}}" class="text-reset">Book Test</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> 72- New Vikas Nagar, Near City-Hospital, Loni, Ghaziabad-201102, (Uttar Pradesh)
                        </p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            gd_bindass@yahoo.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> +91 9457570001
                        </p>
                        <p><i class="fas fa-print me-3"></i> +91 9350880944</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="">Octopyder Services</a>
        </div>
        <!-- Copyright -->
    </footer>

</div>

@endsection