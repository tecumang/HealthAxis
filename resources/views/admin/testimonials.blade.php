@extends('admin.layout.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid p-4">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="text-primary fw-bold mb-0">
                <i class="fas fa-comment-medical me-2"></i> Testimonial Management
            </h5>
            <a href="{{ route('admin.testimonials.add') }}" class="btn btn-primary ms-auto">
                <i class="fas fa-plus"></i> Add Testimonial
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Testimonial ID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Message</th>
                            <th>Rating</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testinomials as $testinomial)
                            <tr>
                                <td class="text-muted">{{ $testinomial->id }}</td>
                                <td class="fw-semibold">{{ $testinomial->name }}</td>
                                <td>{{ $testinomial->designation }}</td>
                                <td class="text-truncate">
                                    @php $shortMessage = Str::limit($testinomial->message, 50); @endphp
                                    
                                    {{ $shortMessage }}
                                    
                                    @if(strlen($testinomial->message) > 50)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#readMoreModal{{ $testinomial->id }}">Read more</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="readMoreModal{{ $testinomial->id }}" tabindex="-1" aria-labelledby="readMoreModalLabel{{ $testinomial->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                <div class="modal-content shadow">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="readMoreModalLabel{{ $testinomial->id }}">
                                                            Testimonial by {{ $testinomial->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-0" style="white-space: pre-line;">{{ $testinomial->message }}</p>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-1"></i> Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $testinomial->rating ? 'fas' : 'far' }} fa-star {{ $i <= $testinomial->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                        <span class="ms-2 text-muted">({{ $testinomial->rating }}/5)</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.testimonial.edit', $testinomial->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit Testimonial">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.testimonials.delete', $testinomial->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $testinomial->id }}" data-name="{{ $testinomial->name }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                        <h5>No Testimonials Found</h5>
                                        <p class="text-muted">Click "Add Testimonial" to create one.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const form = this.closest('form');
                const name = this.getAttribute('data-name');

                if (confirm(`Are you sure you want to delete the testimonial from "${name}"? This action cannot be undone.`)) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection



