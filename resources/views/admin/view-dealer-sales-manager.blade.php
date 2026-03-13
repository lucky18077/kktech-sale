@extends('admin.layout.main')

@section('main-section')
@push('title')
<title>View Dealer Sales Manager</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Dealer Sales Manager Allocation</h4>
                    <h6>Manage sales managers for {{ $dealer->name }}</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="{{ route('dealers') }}" class="btn btn-secondary me-2"><i class="ti ti-arrow-left me-1"></i>Back to Dealers</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('allocate-dealer-sales-manager', $dealer->id) }}">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                            <h5 class="card-title mb-0">Available Sales Managers</h5>
                            <button type="submit" class="btn btn-primary">Allocate Selected Managers</button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <label class="checkboxs">
                                                    <input type="checkbox" id="select-all-available">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </th>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($availableSalesManagers as $index => $manager)
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox" name="ids[]" value="{{ $manager->id }}">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $manager->name }}</td>
                                            <td>{{ $manager->phone }}</td>
                                            <td>{{ $manager->email }}</td>
                                            <td>{{ $manager->designation }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Allocated Sales Managers</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Designation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allocatedSalesManagers as $index => $manager)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $manager->name }}</td>
                                        <td>{{ $manager->phone }}</td>
                                        <td>{{ $manager->email }}</td>
                                        <td>{{ $manager->designation }}</td>
                                        <td>
                                            <a href="{{ route('unallocate-dealer-sales-manager', [$dealer->id, $manager->id]) }}"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Are you sure you want to unallocate this sales manager?')">
                                                <i class="ti ti-trash me-1"></i>Un-allocate
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No sales managers allocated yet</td>
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
</div>
@endsection

<script>
$(document).ready(function() {
    $('.datatable').DataTable({
        "pageLength": 25,
        "ordering": true,
        "searching": true,
        "paging": true,
        "responsive": true
    });

    // Select all checkbox functionality for available managers
    $('#select-all-available').on('change', function() {
        $('input[name="ids[]"]').prop('checked', $(this).prop('checked'));
    });
});
</script>