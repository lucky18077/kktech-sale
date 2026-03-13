@extends('admin.layout.main')

@push('title')
<title>@if(isset($statusDisplay)){{ $statusDisplay }}@else Leads List @endif</title>
@endpush

@section('main-section')

<div class="page-wrapper">
    <div class="content">

        <!-- Page Header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h4 class="fw-bold">@if(isset($statusDisplay)){{ $statusDisplay }}@else Leads List @endif</h4>

            <button id="exportButton" class="btn btn-warning text-white">
                Export to Excel
            </button>
        </div>


        <!-- Leads Table -->
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped serverSide" id="DataTable">

                        <thead class="table-dark">
                            <tr>
                                <th>Lead ID</th>
                                <th>Business Category</th>
                                <th>Category</th>
                                <th>Source</th>
                                <th>Plumber</th>
                                <th>Architect</th>
                                <th>MEP</th>
                                <th>Client</th>
                                <th>Client No.</th>
                                <th>Client Address</th>
                                <th>Lead Address</th>
                                <th>Property Stage</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Lead Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- DataTables loads data here -->
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="showLead">
    <div class="modal-dialog modal-lg">
        <form class="row g-3 needs-validation" novalidate id="leadForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header  ">
                    <h5 class="modal-title" id="staticBackdropLabel">Lead</h5>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
				    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Select Dealer/Customer</label>
                            <select class="form-control select customer_type" id="customer_type" name="customer_type">
                                <option value="">Select</option>
                                <option value="customer">Customer</option>
                                <option value="dealer">Dealer</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Select Sales Manager/Executive</label>
                            <select class="form-control select" id="sales_manager_id" name="sales_manager_id">
                                <option value="">Select</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 dealer">
                            <label>Select Dealer</label>
                            <select class="form-control select" id="dealer_id" name="dealer_id">
                                <option value="">Select</option>
                                @foreach($dealers as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 customer">
                            <label>Select Customer</label>
                            <select class="form-control select" id="lead_client_id" name="client_id">
                                <option value="">Select</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}({{ $client->number }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Select Business Category</label>
                            <select class="form-control select" id="business_category" name="business_category">
                                <option value="">Select</option>
                                @foreach($businessCategory as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label><strong> Client Details</strong></label>
                    <i class="fa fa-pen float-end btn btn-primary btn-sm editClientBtn" style="cursor:pointer;"></i>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" id="client_display" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>Number</label>
                            <input type="number" id="number" class="form-control" disabled>
                        </div> 
                        <div class="col-md-6">
                            <label>State</label>
                            <select id="c_state" class="form-control select" disabled>
                                <option value="">Select</option>
                                @foreach($states as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>City</label>
                            <select class="form-control select" id="c_city" disabled>
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Address</label>
                            <textarea id="c_address" cols="2" rows="2" class="form-control" disabled></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" id="id" name="id">
                            <label>Type</label>
                            <select class="form-control select" id="property_type" name="property_type">
                                <option value="">Select</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>

                            </select>

                        </div>
                        <div class="col-md-4">
                            <label>Category</label>
                            <select class="form-control select" id="property_category" name="property_category">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Sub Category</label>
                            <select class="form-control select" id="property_subcategory" name="property_subcategory">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Plumber</label>
                            <select class="form-control select" id="plumber" name="plumber">
                              
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Architect</label>
                            <select class="form-control select" id="architect" name="architect">
                               
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>MEP</label>
                            <select class="form-control select" id="mep" name="mep">
                               
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Property Stage</label>
                            <select class="form-control select" id="property_stage" name="property_stage">
                            
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Source</label>
                            <select class="form-control select" id="source" name="source">
                              
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>State</label>
                            <select class="form-control select" id="state" name="state">
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>City</label>
                            <select class="form-control select" id="city" name="city">

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Address</label>
                            <textarea name="address" id="address" cols="2" rows="2" class="form-control"></textarea>

                        </div>
                        <div class="col-md-4 mt-3 status">
                            <label>Status</label>
                            <select class="form-control select" id="status" name="status">
                                @foreach($leadStatus as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3 customer_type">
                            <label>Customer type</label>
                            <select class="form-control select" id="customer_type" name="customer_type">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3 conversion_type">
                            <label>Conversion Type</label>
                            <select class="form-control select" id="conversion_type" name="conversion_type">
                                <option value="">Select</option>
                                <option value="Partial">Partial</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3 conversion_type ">
                            <label>Conversion Date</label>
                            <input type="date" class="form-control" id="conversion_date" name="conversion_date">
                        </div>
                        <div class="col-md-12">
                            <label>Comment</label>
                            <textarea name="comment" id="comment" class="form-control" required></textarea>

                        </div>
                        <Div class="row mt-3 call-schedule-div d-none">
                            <div class="col-md-6">
                                <label>Select Date</label>
                                <input type="date" class="form-control" name="call_date" id="call_date">

                            </div>
                            <div class="col-md-6">
                                <label>Select Time</label>
                                <input type="time" class="form-control" id="call_time" name="call_time">
                            </div>

                        </Div>
                    </div>
                </div>
                <table class="table table-bordered partial_product" style="display:none;">
                    <thead>
                        <th>S. No.</th>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>QTY</th>
                        <th>Created Date</th>

                    </thead>
                    <tbody id="showproduct1PartialLead">
                    </tbody>
                </table>


                <table class="table table-bordered dealer_product" style="display:none;">
                    <thead>
                        <th>S. No.</th>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>QTY</th>
                        <th>Created Date</th>

                    </thead>
                    <tbody id="ShowDealerProduct">
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Save Lead</button>

            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="commentList1" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>S. No.</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Remind Date</th>
                            <th>User(Role)</th>
                            <th>Create Date</th>
                        </thead>
                        <tbody id="commentList">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showproduct" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>S. No.</th>
                            <th>Product Name</th>
                            <th>QTY</th>
                            <th>Created Date</th>
                        </thead>
                        <tbody id="showproduct1">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteLead" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Delete Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="DeleteId" name="DeleteId">
                <h4>Are you sure you want to delete this lead?</h4>
                <div>
                    <label>Enter Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
// master data for dropdowns
var status = "{{ isset($statusDisplay) ? $statusDisplay : '' }}";
var conversion = "";
var current_lead_id = 0;

var clientsData = @json($clients ?? []);
var dealersData = @json($dealers ?? []);
var sourcesData = @json($sources ?? []);
var plumbersData = @json($plumbers ?? []);
var architectsData = @json($architects ?? []);
var mepData = @json($mep ?? []);
var propertyStagesData = @json($propertyStage ?? []);
var statesData = @json($states ?? []);
var businessCategoriesData = @json($businessCategory ?? []);
var propertyCategoriesData = @json($propertyCategory ?? []);
var propertySubCategoriesData = @json($propertySubCategory ?? []);

// helper for populating a select element
function fillSelect(selector, items, selectedVal) {
    let html = '<option value="">Select</option>';
    if(Array.isArray(items)){
        items.forEach(function(it){
            let val = it.id || it.value || it;
            let txt = it.name || it.text || it;
            html += '<option value="'+val+'">'+txt+'</option>';
        });
    } else {
        for(const key in items){
            html += '<option value="'+key+'">'+items[key]+'</option>';
        }
    }
    $(selector).html(html).val(selectedVal).trigger('change');
}

$(document).ready(function(){
    $('#showLead').on('shown.bs.modal', function(){
        $('.select').select2({ width:'100%' });
    });

    // Initially disable client section fields
    $('#showLead').on('show.bs.modal', function(){
        $('#client_display, #number, #c_state, #c_city, #c_address').prop('disabled', true);
    });

    // Edit client button - enable fields
    $(document).on('click', '.editClientBtn', function(){
        $('#client_display, #number, #c_state, #c_city, #c_address').prop('disabled', false);
        $('.editClientBtn').hide();
    });

    $('#DataTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        destroy: true,

        ajax:{
            url: "{{ route('leads-data') }}",
            type: "POST",

            data:function(data){
                data._token = "{{ csrf_token() }}";
                data.status = status;
                data.conversion = conversion;
            }
        },
        lengthMenu: [
            [10,25,50,100],
            [10,25,50,100]
        ],
        pageLength: 10,
        columns: [
            {data:'lead_id'},
            {data:'business_category'},
            {data:'property_category'},
            {data:'source'},
            {data:'plumber'},
            {data:'architect'},
            {data:'mep'},
            {data:'client_name'},
            {data:'client_number'},
            {data:'client_address'},
            {data:'lead_address'},
            {data:'property_stage'},
            {data:'user_name'},
            {data:'role'},
            {data:'lead_date'},
            {data:'status'},
            {data:'action', orderable:false, searchable:false}
        ]
    });

    // delegate action buttons since table refreshes
    $(document).on('click', '.btn-comment', function(){
        let id = $(this).data('id');
        console.log('.btn-comment clicked', {attr: $(this).attr('data-id'), parsed: id, html: this.outerHTML});
        showcomment(id);
    });
    $(document).on('click', '.btn-products', function(){
        let id = $(this).data('id');
        console.log('.btn-products clicked', {attr: $(this).attr('data-id'), parsed: id, html: this.outerHTML});
        showproduct(id);
    });
    $(document).on('click', '.btn-edit', function(){
        let id = $(this).data('id');
        console.log('.btn-edit clicked', {attr: $(this).attr('data-id'), parsed: id});
        showLead(id);
    });

});

function fillLeadForm(data){
    current_lead_id = data.id;
    $("#id").val(data.id);

    // populate all dropdowns with master data
    fillSelect('#lead_client_id', clientsData.map(c=>({id:c.id,text:c.name+'('+c.number+')'})), data.client_id);
    $('#client_display').val((data.client_name||'')+'('+ (data.client_number||'') +')');
    $('#number').val(data.client_number);
    // header fields
    $('#sales_manager_id').val(data.user_id);
    $('#business_category').val(data.business_category_id);
    fillSelect('#c_state', statesData, data.client_state);
    if(data.client_state){
        $.post('{{ route('get-city') }}',{state:data.client_state,_token:'{{ csrf_token() }}'},function(res){
            fillSelect('#c_city', res, data.client_city);
        });
    } else {
        fillSelect('#c_city', [], data.client_city);
    }
    $('#c_address').val(data.client_address);

    $('#address').val(data.address || data.lead_address);
    $('#property_type').val(data.type);
    fillSelect('#property_category', propertyCategoriesData, data.catg_id || data.property_category_id);
    var catid = data.catg_id || data.property_category_id;
    if(catid){
        $.post('{{ route('get-property-subcategory') }}',{category_id:catid,_token:'{{ csrf_token() }}'},function(res){
            fillSelect('#property_subcategory', res, data.sub_catg_id || data.property_subcategory_id);
        });
    } else {
        fillSelect('#property_subcategory', [], '');
    }
    fillSelect('#plumber', plumbersData, data.plumber_id);
    fillSelect('#architect', architectsData, data.architect_id);
    fillSelect('#mep', mepData, data.mep_id);
    fillSelect('#property_stage', propertyStagesData, data.property_stage_id);
    fillSelect('#source', sourcesData, data.source_id);
    fillSelect('#state', statesData, data.state);
    if(data.state){
        $.post('{{ route('get-city') }}',{state:data.state,_token:'{{ csrf_token() }}'},function(res){
            fillSelect('#city', res, data.city);
        });
    } else {
        fillSelect('#city', [], data.city);
    }
    $('#gst').val(data.gst);
    $('#conversion_type').val(data.conversion_type || '');
    $('#conversion_date').val(data.conversion_date || '');

    fillSelect('#customer_type', {'customer':'customer','dealer':'dealer'}, data.customer_type);
    toggleCustomerType(data.customer_type);
    if(data.customer_type === 'dealer'){
        $('#dealer_id').val(data.client_id);
    }
    $('#status').val(data.status_id).trigger('change');

    if (data.status == "CALL SCHEDULED" || data.status == "VISIT SCHEDULED") {
        $(".call-schedule-div").removeClass('d-none');
        $("#call_date").val(data.remind_date);
        $("#call_time").val(data.remind_time);
    } else {
        $(".call-schedule-div").addClass('d-none');
    }

    // If status is CONVERTED, load conversion products
    if (data.status == "CONVERTED") {
        $(".conversion_type").show();
        $.post('{{ route("lead-product") }}', {id: current_lead_id, _token: '{{ csrf_token() }}'}, function(products){
            let html = '';
            let count = 1;
            products.forEach(function(prod){
                let checked = prod.is_delivered == 1 ? 'checked disabled' : '';
                html += '<tr><td>'+count+'</td><td><input type="checkbox" class="form-check-input" name="ids[]" value="\''+prod.id+'\'" '+checked+'></td><td>'+prod.name+'</td><td>'+prod.qty+'</td><td>'+prod.created_at+'</td></tr>';
                count++;
            });
            $("#showproduct1PartialLead").html(html);
            $(".partial_product").show();
        });
    } else {
        $(".conversion_type").hide();
        $(".partial_product").hide();
    }

    $('#showLead').find('select, input, textarea').prop('disabled', false);
    $('#client_display, #number, #c_state, #c_city, #c_address').prop('disabled', true);
    $("#showLead").modal("show");
}

function showLead(id){
    console.log('showLead called with id', id);
    current_lead_id = id;
    $.post('{{ route("lead-show") }}',{id:id,_token:'{{ csrf_token() }}'},function(resp){
        console.log('lead-show response', resp);
        if(resp.error){
            alert(resp.msg || 'Unable to fetch lead');
            return;
        }
        fillLeadForm(resp.data);
    }).fail(function(xhr, status, error){
        console.error('lead-show failed', status, error);
        alert('Server error retrieving lead');
    });
}

/**
 * Show comments for a lead
 */
function showcomment(id) {
    console.log('showcomment called with', id);
    // open modal immediately with a loading placeholder so the user isn't stuck
    $('#commentList').html('<tr><td colspan="6" class="text-center">Loading comments...</td></tr>');
    $('#commentList1').modal('show');

    $.ajax({
        method: 'POST',
        url: '{{ route("lead-comment") }}',
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            console.log('showcomment response', data);
            if(!data || data.length === 0) {
                $('#commentList').html('<tr><td colspan="6" class="text-center">No comments found</td></tr>');
                return;
            }
            let html = '';
            let count = 1;
            $.each(data, function(index, value) {
                html += `
                <tr>
                <td>${count++}</td>
                <td>${value.comment}</td>
                <td>${value.status || '-'}</td>
                <td>${value.remind_date || '-'} ${value.remind_time || ''}</td>
                <td>${value.name}(${value.user_type})</td>
                <td>${value.created_at || '-'}</td>
                </tr>
                `;
            });
            $('#commentList').html(html);
        },
        error: function(err) {
            console.error('comment AJAX error', err);
            $('#commentList').html('<tr><td colspan="6" class="text-center text-danger">Failed to load comments</td></tr>');
        }
    });
}

/**
 * Show products for a lead
 */
function showproduct(id) {
    console.log('showproduct called with', id);
    // show modal immediately with loading text
    $('#showproduct1').html('<tr><td colspan="4" class="text-center">Loading products...</td></tr>');
    $('#showproduct').modal('show');

    $.ajax({
        method: 'POST',
        url: '{{ route("lead-product") }}',
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            let html = '';
            let count = 1;
            $.each(data, function(index, value) {
                html += `
                <tr>
                <td>${count++}</td>
                <td>${value.name}</td>
                <td>${value.qty}</td>
                <td>${value.created_at || '-'}</td>
                </tr>
                `;
            });
            $('#showproduct1').html(html);
        },
        error: function(err) {
            console.error('product AJAX error', err);
            $('#showproduct1').html('<tr><td colspan="4" class="text-center text-danger">Failed to load products</td></tr>');
        }
    });
}



/**
 * Form submission handler
 */
$("#leadForm").on("submit", function(e) {
    e.preventDefault();
    
    let formData = {
        id: $("#id").val(),
        status: $("#status").val(),
        source: $("#source").val(),
        state: $("#state").val(),
        city: $("#city").val(),
        property_type: $("#property_type").val(),
        property_category: $("#property_category").val(),
        property_subcategory: $("#property_subcategory").val(),
        plumber: $("#plumber").val(),
        architect: $("#architect").val(),
        property_stage: $("#property_stage").val(),
        address: $("#address").val(),
        gst: $("#gst").val(),
        mep: $("#mep").val(),
        conversion_type: $("#conversion_type").val(),
        conversion_date: $("#conversion_date").val(),
        comment: $("#comment").val(),
        call_date: $("#call_date").val(),
        call_time: $("#call_time").val(),
        // header
        sales_manager_id: $('#sales_manager_id').val(),
        business_category: $('#business_category').val(),
        customer_type: $('#customer_type').val(),
        client_id: $('#lead_client_id').val(),
        dealer_id: $('#dealer_id').val(),
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
        method: 'POST',
        url: '{{ route("lead-update") }}',
        data: formData,
        success: function(response) {
            if (response.error) {
                alert('Error: ' + response.msg);
            } else {
                alert(response.msg);
                $("#showLead").modal("hide");
                $('#DataTable').DataTable().ajax.reload();
            }
        },
        error: function(err) {
            console.log(err);
            alert('Error updating lead');
        }
    });
});

/**
 * Delete button handler
 */
$("#deleteBtn").on("click", function() {
    $("#DeleteId").val($("#id").val());
    $("#DeleteLead").modal("show");
});

/**
 * Confirm delete handler
 */
$("#confirmDelete").on("click", function() {
    let password = $("#password").val();
    
    if (!password) {
        alert('Please enter password');
        return;
    }
    
    $.ajax({
        method: 'POST',
        url: '{{ route("lead-destroy") }}',
        data: {
            id: $("#DeleteId").val(),
            password: password,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.error) {
                alert('Error: ' + response.msg);
            } else {
                alert(response.msg);
                $("#DeleteLead").modal("hide");
                $("#showLead").modal("hide");
                $('#DataTable').DataTable().ajax.reload();
            }
        },
        error: function(err) {
            console.log(err);
            alert('Error deleting lead');
        }
    });
});

/**
 * Status change handler for show/hide fields
 */
$("#status").on("change", function() {
    let statusValue = $(this).val();
    
    // Get status name from selected option
    let statusText = $(this).find("option:selected").text();
    
    if (statusText == "CALL SCHEDULED" || statusText == "VISIT SCHEDULED") {
        $(".call-schedule-div").removeClass('d-none');
    } else {
        $(".call-schedule-div").addClass('d-none');
    }
    
    if (statusText == "CONVERTED") {
        $(".conversion_type").show(300);
        $.ajax({
            method: 'POST',
            url: '{{ route("lead-dealer") }}',
            data: {
                id: current_lead_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (!data.error) {
                    // Show partial/completed selection for products
                    $.post('{{ route("lead-product") }}', {id: current_lead_id, _token: '{{ csrf_token() }}'}, function(products){
                        let html = '';
                        let count = 1;
                        products.forEach(function(prod){
                            let checked = prod.is_delivered == 1 ? 'checked disabled' : '';
                            html += '<tr><td>'+count+'</td><td><input type="checkbox" class="form-check-input" name="ids[]" value="\''+prod.id+'\'" '+checked+'></td><td>'+prod.name+'</td><td>'+prod.qty+'</td><td>'+prod.created_at+'</td></tr>';
                            count++;
                        });
                        $("#showproduct1PartialLead").html(html);
                        $(".partial_product").show(300);
                    });

                    // Show dealer options only for customers
                    if (data.data.customer_type == "customer") {
                        let html = '<option value="">Select Dealer</option>';
                        let dealer_product = '';
                        
                        data.data.dealer.forEach(element => {
                            html += '<option value="' + element.id + '">' + element.name + '</option>';
                        });
                        
                        data.data.lead_products.forEach(element => {
                            dealer_product += '<tr><td>' + element.id + '</td><td><input type="checkbox" class="form-check-input" name="dealer_ids[]" value="' + element.id + '"></td><td>' + element.name + '</td><td>' + element.qty + '</td><td>' + element.created_at + '</td></tr>';
                        });
                        
                        $("#dealer_id").html(html);
                        $("#ShowDealerProduct").html(dealer_product);
                        $(".dealer_product").show(300);
                    } else {
                        $(".dealer_product").hide(300);
                    }
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    } else {
        $(".conversion_type").hide(300);
        $(".dealer_product").hide(300);
        $(".partial_product").hide(300);
    }
});

// customer type toggle within modal
function toggleCustomerType(val){
    if(val === 'customer'){
        $('.customer').show();
        $('.dealer').hide();
        $('#dealer_id').val('').trigger('change');
    } else if(val === 'dealer'){
        $('.dealer').show();
        $('.customer').hide();
        $('#lead_client_id').val('').trigger('change');
    } else {
        $('.dealer,.customer').hide();
    }
}

$(document).on('change','#customer_type',function(){
    let type = $(this).val();
    toggleCustomerType(type);
});

// when header client select is changed, update client detail display fields
$(document).on('change','#lead_client_id',function(){
    if($('#customer_type').val() !== 'customer') return;
    let id = $(this).val();
    let client = clientsData.find(c=>c.id == id);
    if(client){
        $('#client_display').val(client.name+'('+client.number+')');
        $('#number').val(client.number);
        fillSelect('#c_state', statesData, client.state);
        if(client.state){
            $.post('{{ route('get-city') }}',{state:client.state,_token:'{{ csrf_token() }}'},function(res){
                fillSelect('#c_city', res, client.city);
            });
        }
        $('#c_address').val(client.address);
    }
});

// when main property category changes, reload subcategories
$(document).on('change', '#property_category', function(){
    let cat = $(this).val();
    if(!cat) {
        fillSelect('#property_subcategory', [], '');
        return;
    }
    $.post('{{ route('get-property-subcategory') }}', {category_id:cat, _token:'{{ csrf_token() }}'}, function(res){
        fillSelect('#property_subcategory', res, '');
    });
});

// state -> city on both client and lead address sections
$(document).on('change', '#state', function(){
    let st = $(this).val();
    if(!st) return;
    $.post('{{ route('get-city') }}', {state:st, _token:'{{ csrf_token() }}'}, function(res){
        fillSelect('#city', res, '');
    });
});
$(document).on('change', '#c_state', function(){
    let st = $(this).val();
    if(!st) return;
    $.post('{{ route('get-city') }}', {state:st, _token:'{{ csrf_token() }}'}, function(res){
        fillSelect('#c_city', res, '');
    });
});

// clicking pencil allows editing client data
$(document).on('click', '.editClient', function(){
    $('#lead_client_id, #number, #c_state, #c_city, #c_address').prop('disabled', false);
});

/**
 * Delete lead from table button handler
 */
$(document).on("click", ".deleteLead", function() {
    let leadId = $(this).data("id");
    $("#DeleteId").val(leadId);
    $("#DeleteLead").modal("show");
});
</script>
@endsection