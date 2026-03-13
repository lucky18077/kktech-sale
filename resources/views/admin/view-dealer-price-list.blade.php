@extends('admin.layout.main')

@section('main-section')
@push('title')
<title>Dealer Price List</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Price List for {{ $dealer->name }}</h4>
                    <h6>Category: {{ $category->name }}</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="{{ route('allocate-brand-dealer', $dealer->id) }}" class="btn btn-secondary me-2"><i class="ti ti-arrow-left me-1"></i>Back to Allocation</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Product</th>
                                <th>Dealer Price</th>
                                <th>Updated Price</th>
                                <th>Updated Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sno = 1;
                            @endphp
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $sno++ }}</td>
                                <td>{{ $product->name }}</td>
                                @php
                                    $base = $product->price;
                                    $discount = $categoryDiscount ? $categoryDiscount->discount : 0;
                                    $calcPrice = $base - ($base * $discount / 100);
                                @endphp
                                <td>{{ number_format($calcPrice,2) }}</td>
                                <td>{{ $product->dealer_price ?? '-' }}</td>
                                <td>{{ $product->dealer_price_updated ? 
                                    \Illuminate\Support\Carbon::parse($product->dealer_price_updated)->format('Y-m-d') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
});
</script>