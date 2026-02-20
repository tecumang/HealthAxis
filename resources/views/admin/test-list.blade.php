@extends('admin.layout.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">🧪 Test Management</h2>

    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-nowrap">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>Test ID</th>
                        <th>Franchise</th>
                        <th>Test Name</th>
                        <th class="d-none d-md-table-cell">Description</th>
                        <th>Price (₹)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tests as $test)
                    <tr>
                        <td>{{ $test->test_id }}</td>
                        <td>
                            <div><strong>ID:</strong> {{ $test->franchise_id }}</div>
                            <div class="small text-muted">{{ $test->franchise->lab_name ?? 'N/A' }}</div>
                        </td>
                        <td>{{ $test->test_name }}</td>
                        <td class="d-none d-md-table-cell">{{ Str::limit($test->test_description, 40) }}</td>
                        <td>₹{{ $test->price }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#testModal{{ $test->test_id }}">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="testModal{{ $test->test_id }}" tabindex="-1" aria-labelledby="testModalLabel{{ $test->test_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testModalLabel{{ $test->test_id }}">Test Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6><strong>Test ID:</strong> {{ $test->test_id }}</h6>
                                    <p><strong>Franchise ID:</strong> {{ $test->franchise_id }}</p>
                                    <p><strong>Franchise Name:</strong> {{ $test->franchise->lab_name ?? 'N/A' }}</p>
                                    <p><strong>Test Name:</strong> {{ $test->test_name }}</p>
                                    <p><strong>Description:</strong> {{ $test->test_description }}</p>
                                    <p><strong>Price:</strong> ₹{{ $test->price }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
