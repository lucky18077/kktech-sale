@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Add Partner Type</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div class="page-title">
                <h4 class="fw-bold">Clients</h4>
                <h6>Manage your Clients</h6>
            </div>
            <div class="page-btn">
                <button class="btn btn-primary addClient"><i class="ti ti-circle-plus me-1"></i>Add Client</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="search-set">
                    <div class="search-input">
                        <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                        <div class="dataTables_filter">
                            <label><input type="search" class="form-control form-control-sm" placeholder="Search"></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable" id="partnerTable">
                        <thead class="thead-light">
                            <tr>
                                <th>S.no</th>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sno = 1; @endphp
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $client->company }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->number }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>{{ $client->state }}</td>
                                    <td>{{ $client->city }}</td>
                                    <td>
                                        @if($client->active == 1)
                                            <span class="badge bg-success fw-medium fs-10">Active</span>
                                        @else
                                            <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="me-2 p-2 editClient" data-data="{{ @json_encode($client) }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                    </td>   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Dealer Modal -->
<div class="modal fade" id="dealerModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="{{ route('client-save') }}" method="POST" id="dealerForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="dealerTitle">Add Client</h4>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id" id="client_id">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                        <input type="text" class="form-control" name="name" id="client_name" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="client_phone" name="number" minlength="10" maxlength="10" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">GST</label>
                        <input type="text" class="form-control" id="client_gst" name="gst">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">State</label>
                        <select class="form-control" id="client_state" name="state" onchange="getDealerCity()">
                            <option value="">Select</option>
                            @foreach($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">District</label>
                        <select class="form-select pucity" id="client_district" name="district">
                            <option value="">Select District</option>
                        </select>
                    </div>
                     <div class="mb-3 col-md-4">
                        <label class="form-label">City</label>
                         <input type="text" class="form-control" name="city" id="client_city">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" id="client_address" name="address"></textarea>
                    </div>
                      <div class="mb-3 col-md-4">
                        <label class="form-label">Pincode</label>
                         <input type="text" class="form-control" name="pincode" id="client_pincode">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Shipping State</label>
                        <select class="form-control" id="client_ship_state" name="ship_state" onchange="getShippingCity()">
                            <option value="">Select</option>
                            @foreach($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Shipping District</label>
                          <select class="form-select pucity" id="client_ship_district" name="ship_district">
                            <option value="">Select District</option>
                        </select>
                    </div>
                   <div class="mb-3 col-md-4">
                        <label class="form-label">Shipping City</label>
                         <input type="text" class="form-control" name="ship_city" id="client_ship_city">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Shipping Pincode</label>
                         <input type="text" class="form-control" name="ship_pincode" id="client_ship_pincode">
                    </div> 
                   
                    <div class="col-sm-4 mt-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="active" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Shipping Address</label>
                        <textarea class="form-control" id="client_ship_address" name="ship_address"></textarea>
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

<!-- Scripts -->
<script>
  

        // Add Partner Type
    $(".addClient").on("click", function() {
        $("#dealerTitle").text("Add Client");
        $("#dealerSubmit").text("Save");
        $("#dealerForm")[0].reset();
        $("client_district").html('<option value="">Select District</option>');
        $("client_ship_district").html('<option value="">Select District</option>');
        $("#dealerModal").modal("show");
    });

    // Edit Partner Type
    $(document).on("click", ".editClient", function() {
        $("#dealerTitle").text("Edit client");
        $("#dealerSubmit").text("Update");
        var data = $(this).data("data");
        $("#client_id").val(data.id);
        $("#company").val(data.company);
        $("#client_name").val(data.name);
        $("#client_phone").val(data.number);
        $("#client_address").val(data.address);
        $("#client_state").val(data.state);
        $("#client_ship_state").val(data.ship_state);
        $("#client_district").html('<option value="' + data.district + '">' + data.district + '</option>');
        $("#client_ship_district").html('<option value="' + data.ship_district + '">' + data.ship_district + '</option>');
        $("#client_gst").val(data.gst);
        $("#client_city").val(data.city);
        $("#client_pincode").val(data.pincode);
        $("#client_ship_city").val(data.ship_city);
        $("#client_ship_pincode").val(data.ship_pincode);
        $("#client_ship_address").val(data.ship_address);
        $("#active").val(data.active);
        $("#dealerModal").modal("show");
    });
    
    // Load cities via AJAX
    function getDealerCity() {
        var state = $("#client_state").val();
        if (state) {
            $.ajax({
                url: '{{ route("get-cities") }}',
                type: 'GET',
                data: { state: state },
                success: function(cities) {
                    var citySelect = $("#client_district");
                    citySelect.html('<option value="">Select</option>');
                    $.each(cities, function(index, city) {
                        citySelect.append('<option value="' + city + '">' + city + '</option>');
                    });
                },
                error: function() {
                    alert("Unable to load cities for selected state.");
                }
            });
        }
    }
    function getShippingCity() {
        var state = $("#client_ship_state").val();
        if (state) {
            $.ajax({
                url: '{{ route("get-cities") }}',
                type: 'GET',
                data: { state: state },
                success: function(cities) {
                    var citySelect = $("#client_ship_district");
                    citySelect.html('<option value="">Select</option>');
                    $.each(cities, function(index, city) {
                        citySelect.append('<option value="' + city + '">' + city + '</option>');
                    });
                },
                error: function() {
                    alert("Unable to load cities for selected state.");
                }
            });
        }
    }
</script>
@endsection