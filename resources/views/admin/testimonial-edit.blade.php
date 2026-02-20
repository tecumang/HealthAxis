@extends('admin.layout.app')

@section('title', 'Edit Testimonial | Admin Dashboard')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="mb-0">Edit Testimonial</h2>
        <a href="{{ route('admin.testmonial') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Back to Testimonials
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> Please fix the following errors:
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-1 text-primary"></i>
                        Testimonial Information
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.testimonial.update', $testinomial->id) }}" enctype="multipart/form-data" id="testimonialForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Client Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        value="{{ old('name', $testinomial->name) }}" 
                                        required
                                        autofocus
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="designation" class="form-label">Designation</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    <input 
                                        type="text" 
                                        id="designation" 
                                        name="designation" 
                                        class="form-control @error('designation') is-invalid @enderror" 
                                        value="{{ old('designation', $testinomial->designation) }}"
                                    >
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Testimonial Message <span class="text-danger">*</span></label>
                            <textarea 
                                id="message" 
                                name="message" 
                                class="form-control @error('message') is-invalid @enderror" 
                                rows="5" 
                                required
                            >{{ old('message', $testinomial->message) }}</textarea>
                            <div class="form-text">
                                <span id="charCount">0</span>/300 characters recommended
                            </div>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                                <div class="mb-3">
                                    <div class="rating-group d-flex flex-row-reverse justify-content-start">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ $testinomial->rating == $i ? 'checked' : '' }}>
                                            <label for="star{{ $i }}" class="star">&#9733;</label>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">
                                Cancel
                            </button>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-1"></i> Update Testimonial
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Preview Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-1 text-primary"></i>
                        Preview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="testimonial-preview">
                        <div class="text-center mb-3">
                            <div class="preview-stars mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testinomial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <div class="preview-message fst-italic mb-3">
                                "{{ $testinomial->message }}"
                            </div>
                            <div class="preview-name fw-bold">
                                {{ $testinomial->name }}
                            </div>
                            <div class="preview-designation text-muted">
                                {{ $testinomial->designation }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Help Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-question-circle me-1 text-primary"></i>
                        Tips
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Keep testimonials concise and authentic
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Include the client's role/designation for context
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Use real photos whenever possible
                        </li>
                        <li>
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Highlight specific benefits or results
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rating-group input[type="radio"] {
        display: none;
    }

    .rating-group .star {
        font-size: 1.75rem;
        color: #dcdcdc;
        cursor: pointer;
        transition: color 0.2s ease-in-out;
    }

    .rating-group input[type="radio"]:checked ~ label.star,
    .rating-group input[type="radio"]:checked + label.star {
        color: #ffc107;
    }

    .rating-group input[type="radio"]:hover ~ label.star,
    .rating-group input[type="radio"]:hover + label.star {
        color: #ffca2c;
    }
    
    .testimonial-preview {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }
</style>

<script>
    $(document).ready(function () {
        // Character count
        $('#message').on('input', function () {
            $('#charCount').text($(this).val().length);
            updatePreview(); // Also trigger preview on message input
        });

        $('#name, #designation').on('input', function () {
            updatePreview();
        });

        // STAR RATING FUNCTIONALITY
        $('.star').on('mouseenter', function () {
            const rating = $(this).data('rating');
            highlightStars(rating);
        });

        $('.star').on('mouseleave', function () {
            const selectedRating = $('#rating').val();
            highlightStars(selectedRating);
        });

        $('.star').on('click', function () {
            const rating = $(this).data('rating');
            $('#rating').val(rating);
            highlightStars(rating);
            updatePreview();
        });

        // Set initial star state
        highlightStars($('#rating').val());

        // Image preview
        $('#photo').change(function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('.preview-image').html(`<img src="${e.target.result}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">`);
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove photo logic
        $('#remove_photo').change(function () {
            if ($(this).is(':checked')) {
                $('.preview-image').html('<div class="avatar-placeholder"><i class="fas fa-user"></i></div>');
            } else {
                @if($testinomial->photo)
                $('.preview-image').html('<img src="{{ asset('storage/' . $testinomial->photo) }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">');
                @endif
            }
        });

        // Initial preview load
        updatePreview();

        // Update preview content
        function updatePreview() {
            $('.preview-name').text($('#name').val() || 'Client Name');
            $('.preview-designation').text($('#designation').val() || 'Designation');
            $('.preview-message').text('"' + ($('#message').val() || 'Client testimonial message') + '"');

            const rating = $('#rating').val();
            $('.preview-stars').html('');
            for (let i = 1; i <= 5; i++) {
                $('.preview-stars').append(
                    `<i class="fas fa-star ${i <= rating ? 'text-warning' : 'text-muted'}"></i>`
                );
            }
        }

        // Highlight star function
        function highlightStars(rating) {
            $('.star').removeClass('active');
            $('.star').each(function () {
                if ($(this).data('rating') <= rating) {
                    $(this).addClass('active');
                }
            });
        }
    });
</script>



@endsection