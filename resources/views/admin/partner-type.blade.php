@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Add Partner Type</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div class="page-title">
                <h4 class="fw-bold">Partner Type</h4>
                <h6>Manage your partner types</h6>
            </div>
            <div class="page-btn">
                <button class="btn btn-primary addPlumber"><i class="ti ti-circle-plus me-1"></i>Add Partner Type</button>
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
                <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                            All
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1" data-type="">All</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1" data-type="Plumber">Plumber/Contractor</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1" data-type="Architect">Architect/Consultant</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item rounded-1" data-type="Mep">MEP</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table" id="partnerTable">
                        <thead class="thead-light">
                            <tr>
                                <th>S.no</th>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>DOB</th>
                                <th>DOA</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Remarks</th>
                                <th>Type</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sno = 1; @endphp
                            @foreach($partnerTypes as $partner)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $partner->company }}</td>
                                    <td>{{ $partner->name }}</td>
                                    <td>{{ $partner->number }}</td>
                                    <td>{{ $partner->dob }}</td>
                                    <td>{{ $partner->doa }}</td>
                                    <td>{{ $partner->address }}</td>
                                    <td>{{ $partner->state }}</td>
                                    <td>{{ $partner->city }}</td>
                                    <td>{{ $partner->remarks }}</td>
                                    <td>{{ $partner->type }}</td>
                                    <td>
                                        @if($partner->active == 1)
                                            <span class="badge bg-success fw-medium fs-10">Active</span>
                                        @else
                                            <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="me-2 p-2 editPlumber" data-data="{{ @json_encode($partner) }}">
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
        <form action="{{ route('partner-type-save') }}" method="POST" id="dealerForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="dealerTitle">Add Partner Type</h4>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id" id="plumber_id">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                        <input type="text" class="form-control" name="name" id="plmbr_name" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="plmbr_phone" name="number" minlength="10" maxlength="10" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Date of birth</label>
                        <input type="date" class="form-control" id="plmbr_dob" name="dob">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Date of anniversary</label>
                        <input type="date" class="form-control" id="plmbr_doa" name="doa">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">State</label>
                        <select class="form-control" id="plumber_state" name="state" onchange="getDealerCity()">
                            <option value="">Select</option>
                            @foreach($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">City</label>
                        <select class="form-select pucity" id="plmbr_city" name="city">
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Active</label>
                        <select class="form-select" id="active" name="active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Partner Type</label>
                        <select class="form-select" id="partner_type" name="type" required>
                            <option value="Plumber">Plumber/Contractor</option>
                            <option value="Architect">Architect/Consultant</option>
                            <option value="Mep">MEP</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" id="plmbr_address" name="address"></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks"></textarea>
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
    var table;
    $(document).ready(function() {
        var $table = $('#partnerTable');

        // Destroy previous DataTable instance if exists
        if ($.fn.DataTable.isDataTable('#partnerTable')) {
            $table.DataTable().clear().destroy();
        }

        // Initialize DataTable
        table = $table.DataTable({
            dom: 'fBtlpi',
            ordering: true,
            responsive: true,
            language: {
                search: ' ',
                searchPlaceholder: 'Search',
                sLengthMenu: 'Row Per Page _MENU_ Entries',
                info: "_START_ - _END_ of _TOTAL_ items",
                paginate: {
                    next: '<i class="fa fa-angle-right"></i>',
                    previous: '<i class="fa fa-angle-left"></i>'
                }
            },
            initComplete: function() {
                $('.dataTables_filter').appendTo('.search-input');
            }
        });

        // Partner Type Filter
        $('.dropdown-item').on('click', function(e){
            e.preventDefault();
            var type = $(this).data('type');
            table.column(10).search(type).draw();
            $('.dropdown-toggle').text($(this).text());
        });

        // Add Partner Type
        $(".addPlumber").on("click", function() {
            $("#dealerTitle").text("Add Partner Type");
            $("#dealerSubmit").text("Save");
            $("#dealerForm")[0].reset();
            $("#plmbr_city").html('<option value="">Select City</option>');
            $("#dealerModal").modal("show");
        });

        // Edit Partner Type
        $(document).on("click", ".editPlumber", function() {
            $("#dealerTitle").text("Edit Partner Type");
            $("#dealerSubmit").text("Update");
            var data = $(this).data("data");

            $("#plumber_id").val(data.id);
            $("#company").val(data.company);
            $("#partner_type").val(data.type);
            $("#plmbr_name").val(data.name);
            $("#plmbr_phone").val(data.number);
            $("#plmbr_address").val(data.address);
            $("#plumber_state").val(data.state);
            $("#plmbr_city").html('<option value="' + data.city + '">' + data.city + '</option>');
            $("#remarks").val(data.remarks);
            $("#active").val(data.active);
            $("#plmbr_dob").val(data.dob);
            $("#plmbr_doa").val(data.doa);

            $("#dealerModal").modal("show");
        });
    });
    // Load cities via AJAX
    function getDealerCity() {
        var state = $("#plumber_state").val();
        if (state) {
            $.ajax({
                url: '{{ route("get-cities") }}',
                type: 'GET',
                data: { state: state },
                success: function(cities) {
                    var citySelect = $("#plmbr_city");
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