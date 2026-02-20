@extends('admin.layout.app')

@section('title', 'Patients Management')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Patients Management</h1>
        <a href="{{ route('admin.addpatients') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>Add New Patient
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header py-3 bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchPatient" placeholder="Search patients...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Patient Name</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Age/Gender</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                        <tr>
                            <td class="ps-3">{{ $patient->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="fw-bold mb-0">{{ $patient->name }}</p>
                                        <p class="text-muted small mb-0">Last visit: {{ \Carbon\Carbon::parse($patient->last_visit ?? now())->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0">{{ $patient->contact }}</p>
                            </td>
                            <td>
                                <p class="mb-0">{{ $patient->city }}</p>
                                <p class="text-muted small mb-0">{{ $patient->address }}</p>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">{{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} yrs</span>
                                <span class="badge {{ $patient->gender == 'Male' ? 'bg-info' : 'bg-danger' }} text-white">{{ $patient->gender }}</span>
                            </td>
                            <td>{{ $patient->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit Patient">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.patients.delete', $patient->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Patient">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                    <h5>No patients found</h5>
                                    <p class="text-muted">There are no patients in the database yet.</p>
                                    <a href="{{ route('admin.addpatients') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus-circle me-2"></i>Add First Patient
                                    </a>
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


@push('scripts')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this patient?');
    }
</script>

@endpush
@endsection