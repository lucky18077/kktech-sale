@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Add Dealer</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Dealer</h4>
                    <h6>Manage your dealers</h6>
                </div>
            </div>
            <div class="page-btn">
                <button class="btn btn-primary addDealer" ><i class="ti ti-circle-plus me-1"></i>Add Dealer</button>
            </div>
        </div>

        <!-- /dealer list -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="search-set">
                    <div class="search-input">
                        <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable" id="dealerTable">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Pincode</th>
                                <th>GST</th>
                                <th>PAN Number</th>
                                <th>Aadhar Number</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sno = 1;
                            @endphp
                            @foreach($dealers as $dealer)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $dealer->category ?? '-' }}</td>
                                    <td>{{ $dealer->name }}</td>
                                    <td>{{ $dealer->phone }}</td>
                                    <td>{{ $dealer->email }}</td>
                                    <td>{{ $dealer->address }}</td>
                                    <td>{{ $dealer->state }}</td>
                                    <td>{{ $dealer->city }}</td>
                                    <td>{{ $dealer->pincode }}</td>
                                    <td>{{ $dealer->gst }}</td>
                                    <td>{{ $dealer->pan_number }}</td>
                                    <td>{{ $dealer->adhar_number }}</td>
                                    <td>{{ $dealer->created_at }}</td>
                                    <td class="action-table-data">
                                        <div class="edit-delete-action">
                                            <a class="me-2 p-2 editDealer" data-data="{{ json_encode($dealer) }}">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </a>
                                            <a class="me-2 p-2" href="{{ route('view-dealer-sales-manager', $dealer->id) }}" title="View Dealer Sales Manager">
                                                <i data-feather="eye" class="feather-eye"></i>
                                            </a>
                                            <a class="me-2 p-2" href="{{ route('allocate-brand-dealer', $dealer->id) }}" title="Allocate Brand">
                                                <i data-feather="package" class="feather-package"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /dealer list -->
    </div>

    <!-- Add/Edit Dealer Modal -->
    <div class="modal fade" id="dealerModal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form action="{{ route('dealer-save') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4 id="dealerTitle">Add Dealer</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="id" id="dealer_id">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Dealer Type<span class="text-danger ms-1">*</span></label>
                            <select class="form-control" name="dealer_category_id" id="dealer_category_id" required>
                                <option value="">Select</option>
                                @foreach($dealerCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" id="dealer_name" required>
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="phone" id="dealer_phone" required>
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="dealer_email">
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="dealer_address">
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">State</label>
                            <select class="form-control" id="dealer_state" name="state" onchange="getDealerCity()">
                                <option value="">Select</option>
                                @foreach($states as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">City</label>
                            <select class="form-control" id="dealer_city" name="city">
                                <option value="">Select</option>
                            </select>
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="dealer_pincode">
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">GST No</label>
                            <input type="text" class="form-control" name="gst" id="dealer_gst">
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">PAN Number</label>
                            <input type="text" class="form-control" name="pan_number" id="dealer_pan_number">
                        </div>
                        
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Aadhar Number</label>
                            <input type="text" class="form-control" name="adhar_number" id="dealer_adhar_number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="dealerSubmit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function getDealerCity() {
            var state = $("#dealer_state").val();
            if (state) {
                $.ajax({
                    url: '{{ route("get-cities") }}',
                    type: 'GET',
                    data: { state: state },
                    success: function(cities) {
                        var citySelect = $("#dealer_city");
                        citySelect.html('<option value="">Select</option>');
                        $.each(cities, function(index, city) {
                            citySelect.append('<option value="' + city + '">' + city + '</option>');
                        });
                    }
                });
            }
        }
        
        $(".addDealer").on("click", function() {
            $("#dealerTitle").text("Add Dealer");
            $("#dealerSubmit").text("Save");
            $("input, select, textarea").not("[name='_token']").val("");
            $("#dealerModal").modal("show");
        });
        
        $(document).on("click", ".editDealer", function() {
            $("#dealerTitle").text("Edit Dealer");
            $("#dealerSubmit").text("Update");
            var data = $(this).data("data");           
            $("#dealer_id").val(data.id);
            $("#dealer_category_id").val(data.dealer_category_id);
            $("#dealer_name").val(data.name);
            $("#dealer_phone").val(data.phone);
            $("#dealer_email").val(data.email);
            $("#dealer_address").val(data.address);
            $("#dealer_state").val(data.state);
            $("#dealer_city").html('<option value="' + data.city + '">' + data.city + '</option>');
            $("#dealer_pincode").val(data.pincode);
            $("#dealer_gst").val(data.gst);
            $("#dealer_pan_number").val(data.pan_number);
            $("#dealer_adhar_number").val(data.adhar_number);
            
            $("#dealerModal").modal("show");
        });
    </script>
    



@endsection