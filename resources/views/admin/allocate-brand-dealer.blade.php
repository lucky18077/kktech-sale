@extends('admin.layout.main')

@section('main-section')
@push('title')
<title>Allocate Brand Dealer</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Allocate Brand to Dealer</h4>
                    <h6>Manage brand allocation for {{ $dealer->name }}</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="{{ route('dealers') }}" class="btn btn-secondary me-2"><i class="ti ti-arrow-left me-1"></i>Back to Dealers</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('allocate-brand-dealer-save', $dealer->id) }}">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                            <h5 class="card-title mb-0">Available Brands</h5>
                            <button type="submit" class="btn btn-primary">Allocate Selected Brands</button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <label class="checkboxs">
                                                    <input type="checkbox" id="select-all">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </th>
                                            <th>S.No</th>
                                            <th>Brand Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($availableCategories as $index => $category)
                                        <tr>
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox" name="category[]" value="{{ $category->id }}">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $category->category }}</td>
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
                        <h5 class="card-title mb-0">Allocated Brands</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Brand Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allocatedCategories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->category }}</td>
                                        <td>
                                            <a href="{{ route('view-dealer-price-list', ['id' => $dealer->id, 'categoryId' => $category->id]) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No brands allocated yet</td>
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

    // Select all checkbox functionality
    $('#select-all').on('change', function() {
        $('input[name="category[]"]').prop('checked', $(this).prop('checked'));
    });
});
</script>