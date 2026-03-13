@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Add Lead</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div class="page-title">
                <h4 class="fw-bold">Add Leads</h4>
                <h6>Manage your Leads</h6>
            </div>
        </div>
        <div class="card">
                <div class="card-body p-0">
                     <form class="row g-3 needs-validation" novalidate id="frmMain" method="POST" action = '{{route("lead-save")}}' >
                        @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Select Dealer/Customer</label>
                                        <select class="form-control customer_type" id="customer_type" name="customer_type" value="" required>
                                            <option value="">Select</option>
                                            <option value="customer">Customer</option>
                                            <option value="dealer">Dealer</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Select Sales Manager/Executive</label>
                                        <select class="form-control" id="sales_manager_id" name="sales_manager_id" required>
                                            <option value="">Select</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-4 dealer">
                                        <label for="" class="form-label">Select Dealer</label>
                                        <select class="form-control select" id="dealer_id" name="dealer_id">
                                            <option value="">Select</option>
                                              @foreach($dealers as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-4 customer">
                                        <label for=" " class="form-label ">Select Customer</label>
                                        <select name="client_id" id="client_id" class="form-control select">
                                            <option value="">Select</option>
                                              @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}({{ $client->number }})</option>
                                                @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-4">
                                        <label for="" class="form-label">Select Business Category</label>
                                        <select class="form-control" id="business_category" name="business_category" required>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id">
                            <div class="col-md-4 customer">
                                <label for="" class="form-label">Source</label>
                                <select class="form-control select" id="source" name="source" value="">
                                    <option value="">Select Source</option>
                                    @foreach($sources as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Plumber</label>
                                <select class="form-control select" id="plumber" name="plumber" value="">
                                    <option value="">Select Plumber</option>
                                    @foreach($plumbers as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Architect</label>
                                <select class="form-control select" id="architect" name="architect" value="">
                                    <option value="">Select Architect</option>
                                    @foreach($architects as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">MEP</label>
                                <select class="form-control select" id="mep" name="mep">
                                    <option value="">Select MEP</option>
                                    @foreach($mep as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Type</label>
                                <select class="form-select select" id="category_type" name="category_type" value="">
                                    <option value="">Select Type</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Category</label>
                                <select class="form-select select" id="category_id" name="category_id">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-3 customer">
                                <label for=" " class="form-label">Sub Category</label>
                                <select class="form-select select" id="sub_category_id" name="sub_category_id">
                                    <option value="">Select</option>

                                </select>

                            </div>
                            <div class="col-md-3 customer">
                                <label for=" " class="form-label">Property Stage</label>
                                <select class="form-control select" id="property_stage" name="property_stage" value="">
                                    <option value="">Select Property Stage</option>
                                    @foreach($propertyStage as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <hr>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Select State</label>
                                <select class="form-control select" id="plmbr_state" name="lead_state">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3 col-md-4 customer">
                                <label for=" " class="form-label">Select City</label>
                                 <select class="form-select select" id="plmbr_city" name="lead_city">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-6 customer">
                                <label>Address</label>
                                <textarea class="form-control" id="address" name="address"></textarea>

                            </div>
                            <div class="col-md-6 customer">
                                <label>Remarks</label>
                                <textarea class="form-control" id="remarks" name="remarks"></textarea>

                            </div>
                            <hr>
                            <label>Products</label>
                            <div class="mb-3 col-md-3">
                                <label for=" " class="form-label">Select Category</label>
                                <select class="form-control select" id="prod_category" name="prod_category">
                                    <option value="">Select category</option>
                                    @foreach($productCategory as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for=" " class="form-label">Select Sub Category</label>
                                <select class="form-control select" id="prod_subcategory" name="prod_subcategory">
                                    <option value="">Select category</option>
                                     @foreach($productSubCategory as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for=" " class="form-label">Select Product</label>
                                <select class="form-control select" id="prod_id" name="prod_id">
                                    <option value="">Select Product</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for=" " class="form-label">Enter Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty">



                            </div>
                            <div class="col-md-1">
                                <label for=" " class="form-label">Add</label>
                                <button class="btn btn-success" type="button" id="add_product" onclick="addItem()">Add</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productList">

                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="prod_list" id="prod_list" value="">
                            <hr>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" type="button" id="savelead">Save Lead</button>
                            </div>
                        </form>

                </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="needs-validation" novalidate method="POST" id="adduserform">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="modal_name"> Add Client</span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <label>Client Name</label>
                        <input type="text" name="client_name" id="client_name" class="form-control">

                    </div>
                    <div class="col-md-6">
                        <label>Client Number</label>
                        <input type="number" name="client_number" id="client_number" class="form-control" onkeypress="if(this.value.length==10) return false;">
                    </div>
                    <div class="col-md-6">
                        <label for=" " class="form-label">Select State</label>
                        <select class="form-control" id="state" name="state">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for=" " class="form-label">Select City</label>
                        <select class="form-control" id="city" name="city">
                            <option value="">Select City</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label for=" " class="form-label">Address</label>
                        <textarea name="address" id="address" cols="5" rows="3" class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" name=" " id="addclient">Save</button>

                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

$(function(){

/* --------------------------
   GLOBAL AJAX CONFIG
-------------------------- */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});


/* --------------------------
   INITIAL SETUP
-------------------------- */

$(".select").select2({ width:'100%' });

$(".dealer,.customer").hide();


/* --------------------------
   CUSTOMER TYPE TOGGLE
-------------------------- */

$(document).on("change","#customer_type",function(){

    const type = $(this).val();

    if(type === "customer"){
        $(".customer").slideDown(200);
        $(".dealer").slideUp(200);
        $("#dealer_id").val('').trigger("change");
    }

    else if(type === "dealer"){
        $(".dealer").slideDown(200);
        $(".customer").slideUp(200);
        $("#client_id").val('').trigger("change");
    }

    else{
        $(".dealer,.customer").hide();
    }

});


/* --------------------------
   CATEGORY TYPE
-------------------------- */

$("#category_type").change(function(){

    const type = $(this).val();
    if(!type) return;

    ajaxLoad(
        "{{ route('get-property-category') }}",
        {type:type},
        "#category_id"
    );

});


/* --------------------------
   SUB CATEGORY
-------------------------- */

$("#category_id").change(function(){

    const cat = $(this).val();
    if(!cat) return;

    ajaxLoad(
        "{{ route('get-property-subcategory') }}",
        {category_id:cat},
        "#sub_category_id"
    );

});


/* --------------------------
   STATE → CITY
-------------------------- */

$("#plmbr_state").change(function(){

    const state = $(this).val();
    if(!state) return;

    ajaxLoad(
        "{{ route('get-city') }}",
        {state:state},
        "#plmbr_city"
    );

});


/* --------------------------
   SALES MANAGER
-------------------------- */

$("#sales_manager_id").change(function(){

    const sales_manager_id = $(this).val();
    if(!sales_manager_id) return;

    $("#wait").show();

    $.post("{{ route('get-business-category') }}",{sales_manager_id})
      .done(function(res){
        console.log('business-category response', res);
        let data = res;
        if(data.error){
            toastr.error(data.msg || 'Unable to load categories');
            return;
        }

        let category = '<option value="">Select</option>';
        let dealer = '<option value="">Select</option>';

        data.data.business_category.forEach(el=>{
            category += `<option value="${el.id}">${el.name}</option>`;
        });

        data.data.dealer.forEach(el=>{
            dealer += `<option value="${el.id}">${el.name}</option>`;
        });

        $("#business_category").html(category);
        $("#dealer_id").html(dealer);
      })
      .fail(function(xhr){
          toastr.error('Server error');
      })
      .always(()=> $("#wait").hide());

});


/* --------------------------
   BUSINESS CATEGORY
-------------------------- */

$("#business_category").change(function(){

    const business_category = $(this).val();
    if(!business_category) return;

    ajaxLoad(
        "{{ route('get-product-category') }}",
        {business_category},
        "#prod_category"
    );

});


/* --------------------------
   PRODUCT CATEGORY
-------------------------- */

$("#prod_category").change(function(){

    const prod_category_id = $(this).val();
    if(!prod_category_id) return;

    ajaxLoad(
        "{{ route('get-product-subcategory') }}",
        {prod_category_id},
        "#prod_subcategory"
    );

});


/* --------------------------
   PRODUCT SUBCATEGORY
-------------------------- */

$("#prod_subcategory").change(function(){

    const prod_category = $("#prod_category").val();
    const prod_subcategory = $(this).val();

    // only show error if user actually chose a subcategory without selecting category
    if(prod_subcategory && !prod_category){
        toastr.error("Select category first");
        // clear invalid selection
        $(this).val('').trigger('change');
        return;
    }

    if(!prod_subcategory) return; // nothing to load

    ajaxLoad(
        "{{ route('get-product-lead') }}",
        {
            prod_category_id:prod_category,
            prod_subcategory_id:prod_subcategory
        },
        "#prod_id"
    );

});


});

/* --------------------------
   AJAX HELPER FUNCTION
-------------------------- */
function ajaxLoad(url,data,target){

    $("#wait").show();

    $.post(url,data,function(res){
        $(target).html(res);
        $(target).trigger('change');  // Refresh Select2
    })
    .always(()=>$("#wait").hide());

}

/* --------------------------
   PRODUCT HANDLING
-------------------------- */

let products = {};
function addItem(){
    const id  = $("#prod_id").val();
    const qty = $("#qty").val();
    const name = $("#prod_id option:selected").text();

    if(!id){
        alert("Select product");
        return;
    }

    if(!qty || qty <= 0){
        alert("Qty must be greater than 0");
        return;
    }

    if(products[id]){
        alert("Product already added");
        return;
    }

    products[id] = {id,qty};

    $("#productList").append(`
        <tr id="prod_${id}">
            <td>${name}</td>
            <td>${qty}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="removeItem(${id})">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    `);

    $("#qty").val('');

}


function removeItem(id){

    delete products[id];
    $("#prod_"+id).remove();

}



/* --------------------------
   FORM SUBMIT
-------------------------- */

$("#savelead").click(function(){

    const form = $("#frmMain")[0];

    if(!form.checkValidity()){
        form.classList.add('was-validated');
        return;
    }

    $("#prod_list").val(JSON.stringify(products));
    $("#frmMain").submit();

});


</script>
@endsection