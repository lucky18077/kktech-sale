@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Dealer Category</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">{{$dealerCategory->name}} Category</h4>
                    <h6>Manage {{$dealerCategory->name}} categories</h6>
                </div>
            </div>

            <div class="page-btn">
                <button class="btn btn-primary addDealerCateogry"><i class="ti ti-circle-plus me-1"></i>Add Brand</button>
            </div>

        </div>

        <!-- /product list -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="search-set">
                    <div class="search-input">
                        <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                    </div>
                </div>
                </div>
            </div>
            <form action="{{ route('brand-discount-bulk-save', $dealerCategory->id) }}" method="POST">
                @csrf
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table datatable" id="brandDiscountTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Discount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sno=1;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <input 
                                            type="number"
                                            step="0.01"
                                            name="category[{{ $item->id.'_'.$item->name }}][]"
                                            value="{{ $item->discount }}"
                                            class="form-control"
                                        >
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <div class="text-center">
                            <button type="submit" name="BtnSave" class="btn btn-primary mt-3">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /product list -->
    </div>

    <!-- Add business Category -->
    <div class="modal fade" id="dealer-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4 id="title">Add Brand</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('brand-discount-save', $dealerCategory->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select Brand</label>
                            <select class="form-select" id="brand" name="brand" required>
                                @foreach($dealerBrands as $dealerBrand) 
                                    <option value="{{ $dealerBrand->id . '_' . $dealerBrand->name }}">
                                            {{ $dealerBrand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                       <div class="mb-3">
                            <label class="form-label">Discount</label>
                            <input type="number" step="0.01" name="discount" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add business Category -->
    


    <script>
        $(".addDealerCateogry").on("click", function() {
            $("#title").text("Add Brand");
            $("#submitBtn").text("Add Brand");
            $("input, select, textarea").not("[name='_token']").val("");
            $("#dealer-category").modal("show");
        });

        // Remove pagination from this table
        $(document).ready(function() {
            setTimeout(function() {
                var table = $('#brandDiscountTable');
                if ($.fn.DataTable.isDataTable('#brandDiscountTable')) {
                    table.DataTable().destroy();
                }
                table.DataTable({
                    "bFilter": true,
                    "sDom": 'fBtli',  
                    "paging": false,
                    "ordering": true,
                    "language": {
                        search: ' ',
                        sLengthMenu: '_MENU_',
                        searchPlaceholder: "Search",
                        sLengthMenu: 'Row Per Page _MENU_ Entries',
                        info: "_START_ - _END_ of _TOTAL_ items",
                        paginate: {
                            next: ' <i class=" fa fa-angle-right"></i>',
                            previous: '<i class="fa fa-angle-left"></i> '
                        },
                     },
                    initComplete: (settings, json)=>{
                        $('.dataTables_filter').appendTo('.search-input');
                    },	
                });
            }, 100);
        });
    </script>
    @endsection