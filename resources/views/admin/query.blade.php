@extends('admin.layout.app')

@section('title', 'Query Management - Pathlab Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold text-primary"> Queries</h5>
                    <div>
                        <input type="text" id="querySearch" class="form-control form-control-sm" placeholder="Search queries...">
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-hover align-middle mb-0" id="queriesTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Person Details</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($query as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3">
                                            <div class="my-auto">
                                                <span class="badge bg-secondary">#{{ $item->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                <p class="text-xs text-muted mb-0">Received: {{ $item->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column px-3">
                                            <p class="text-xs mb-0"><i class="fas fa-envelope me-1"></i> {{ $item->email }}</p>
                                            <p class="text-xs mb-0"><i class="fas fa-phone me-1"></i> {{ $item->phone_number }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-3">
                                            <p class="text-xs mb-0 text-wrap" style="max-width: 250px;">
                                                {{ Str::limit($item->message, 100) }}
                                                @if(strlen($item->message) > 100)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#messageModal{{ $item->id }}" class="text-primary">Read more</a>
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Full Message Modal -->
                                <div class="modal fade" id="messageModal{{ $item->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageModalLabel{{ $item->id }}">Query from {{ $item->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-2"><strong>Date:</strong> {{ $item->created_at->format('F d, Y h:i A') }}</p>
                                                <p class="mb-2"><strong>Email:</strong> {{ $item->email }}</p>
                                                <p class="mb-2"><strong>Phone:</strong> {{ $item->phone_number }}</p>
                                                <div class="card bg-light p-3 mt-3">
                                                    <p class="mb-0">{{ $item->message }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="mb-0">No queries found</p>
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
    </div>
</div>

@push('scripts')
<script>
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('querySearch');
        
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const table = document.getElementById('queriesTable');
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                if (!row.querySelector('td')) continue;
                
                const cells = row.getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.indexOf(searchTerm) > -1) {
                        found = true;
                        break;
                    }
                }
                
                row.style.display = found ? '' : 'none';
            }
        });
    });
</script>
@endpush
@endsection


