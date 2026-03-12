@extends('admin.layout.main')

@push('title')
<title>Leads List</title>
@endpush

@section('main-section')

<div class="page-wrapper">
    <div class="content">

        <!-- Page Header -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <h4 class="fw-bold">Leads List</h4>

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
        <form class="row g-3 needs-validation" novalidate method="POST">
            <div class="modal-content">
                <div class="modal-header  ">
                    <h5 class="modal-title" id="staticBackdropLabel">Lead</h5>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
				    </button>
                </div>
                <div class="modal-body">
                    <label><strong> Client Details</strong></label>
                    <i class="fa fa-pen float-end btn btn-primary btn-sm editClient"></i>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                            <select name="" id="client_id" class="form-select" disabled>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Number</label>
                            <input type="number" name="" id="number" class="form-control" disabled>

                        </div>
                        <div class="col-md-6">
                            <label>State</label>
                            <select name="" id="c_state" class="form-select" disabled>
            
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>City</label>
                            <select class="form-select" id="c_city" name=" " disabled>
            
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Address</label>
                            <textarea name=" " id="c_address" cols="2" rows="2" class="form-control" disabled></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" id="id" name="id">
                            <label>Type</label>
                            <select class="form-select" id="property_type" name="property_type">
                                <option value="">Select</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>

                            </select>

                        </div>
                        <div class="col-md-4">
                            <label>Category</label>
                            <select class="form-select" id="property_category" name="property_category">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Sub Category</label>
                            <select class="form-select" id="property_subcategory" name="property_subcategory">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Plumber</label>
                            <select class="form-select" id="plumber" name="plumber">
                              
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Architect</label>
                            <select class="form-select" id="architect" name="architect">
                               
                            </select>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label>MEP</label>
                            <select class="form-select" id="mep" name="mep">
                               
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Property Stage</label>
                            <select class="form-select" id="property_stage" name="property_stage">
                            
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>Source</label>
                            <select class="form-select" id="source" name="source">
                              
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>State</label>
                            <select class="form-select" id="state" name="state">
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label>City</label>
                            <select class="form-select" id="city" name="city">

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Address</label>
                            <textarea name="address" id="address" cols="2" rows="2" class="form-control"></textarea>

                        </div>
                        <div class="col-md-4 mt-3 status">
                            <label>Status</label>
                            <select class="form-select" id="status" name="status">
                                @foreach($leadStatus as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3 customer_type">
                            <label>Customer type</label>
                            <select class="form-select" id="customer_type" name="customer_type">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3 conversion_type ">
                            <label>Conversion Date</label>
                            <input type="date" class="form-control" id="conversion_date" name="conversion_date">

                        </div>
                        <div class="col-md-12">
                            <label>Comment</label>
                            <textarea name="comment" id="" class="form-control" required></textarea>

                        </div>
                        <Div class="row mt-3 call-schedule-div">
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
                <table class="table table-bordered partial_product">
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


                <table class="table table-bordered dealer_product">
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
                   	<button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" id = 'submitBtn' >Add user</button>

                </div>

            </div>
        </form>
    </div>
</div>
<script>

var status = "";
var conversion = "";

$(document).ready(function(){
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
            {data:'address'},
            {data:'lead_address'},
            {data:'property_stage'},
            {data:'user_name'},
            {data:'role'},
            {data:'lead_date'},
            {data:'status'},
            {data:'action', orderable:false, searchable:false}
        ]
    });

});
function showLead(data){
    $("#id").val(data.lead_id);
    $("#client_id").html('<option value="'+data.client_id+'">'+data.client_name+'</option>');
    $("#number").val(data.client_number);
    $("#c_city").html('<option value="'+data.client_city+'">'+data.client_city+'</option>');
    $("#c_state").html('<option value="'+data.client_state+'">'+data.client_state+'</option>');
    $("#c_address").val(data.client_address);
    $("#address").val(data.address);
    $("#property_type").html('<option value="'+data.type+'">'+data.type+'</option>');
    $("#property_category").html('<option value="'+data.property_category_id+'">'+data.property_category+'</option>');
    $("#property_subcategory").html('<option value="'+data.property_subcategory_id+'">'+data.property_subcategory+'</option>');
    $("#plumber").html('<option value="'+data.plumber_id+'">'+data.plumber+'</option>');
    $("#plumber").html('<option value="'+data.plumber_id+'">'+data.plumber+'</option>');
    $("#mep").html('<option value="'+data.mep_id+'">'+data.mep+'</option>');
    $("#architect").html('<option value="'+data.property_stage+'">'+data.property_stage+'</option>');
    $("#property_stage").html('<option value="'+data.property_stage_id+'">'+data.property_stage+'</option>');
    $("#source").html('<option value="'+data.source_id+'">'+data.source+'</option>');
    $("#state").html('<option value="'+data.state+'">'+data.state+'</option>');
    $("#city").html('<option value="'+data.city+'">'+data.city+'</option>');
    $("#customer_type").html('<option value="'+data.customer_type+'">'+ data.customer_type+'</option>');
    $("#status").val(data.status_id)
    $("#showLead").modal("show");
}
  $("#status").on("change", function() {
        if ($(this).val() == "CALL SCHEDULED" || $(this).val() == "VISIT SCHEDULED") {
            $(".call-schedule-div").show(500);
        } else {
            $(".call-schedule-div").hide(500);
        }
        if ($(this).val() == "CONVERTED") {
            $.ajax({
                method: 'POST',
                url: 'ajax/get-dealer.php',
                data: {
                    id: lead_id
                },
                success: function(data) {
                    data = JSON.parse(data);

                    if (data.data.customer_type == "customer") {
                        var html = '';
                        var dealer_product = '';
                        html += '<option value="">Select</option>';
                        data.data.dealer.forEach(element => {
                            html += '<option value="' + element.id + '">' + element.name + '</option>';

                        });
                        data.data.lead_products.forEach(element => {

                            dealer_product += '<tr><td>' + element.id + '</td><td><input type="checkbox" class="form-check-input" name="dealer_ids[]" value="' + element.id + '"></td><td>' + element.name + '</td><td>' + element.qty + '</td><td>' + element.created_at + '</td></tr>';
                        });
                        $("#dealer_id").html(html)
                        $("#ShowDealerProduct").html(dealer_product)
                        $(".dealer_product").show(500)
                    } else {
                        $(".dealer_product").hide(500)
                    }
                },
                error: function(data) {
                    console.log(data)
                }
            })



            // $(".conversion_type").show(500);
        } else {
            //$(".conversion_type").hide(500);
            //  $(".partial_product").hide(500);
            $(".dealer_product").hide(500);

        }


    });
</script>
@endsection