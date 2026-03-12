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
                                        <select class="form-select customer_type" id="customer_type" name="customer_type" value="" required>
                                            <option value="">Select</option>
                                            <option value="customer">Customer</option>
                                            <option value="dealer">Dealer</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Select Sales Manager/Executive</label>
                                        <select class="form-select" id="sales_manager_id" name="sales_manager_id" required>
                                            <option value="">Select</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-4 dealer">
                                        <label for="" class="form-label">Select Dealer</label>
                                        <select class="form-select select" id="dealer_id" name="dealer_id">
                                            <option value="">Select</option>
                                              @foreach($dealers as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-4 customer">
                                        <label for=" " class="form-label ">Select Customer</label>
                                        <select name="client_id" id="client_id" class="form-select select">
                                            <option value="">Select</option>
                                              @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}({{ $client->number }})</option>
                                                @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-4">
                                        <label for="" class="form-label">Select Business Category</label>
                                        <select class="form-select" id="business_category" name="business_category" required>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id" name="id">
                            <div class="col-md-4 customer">
                                <label for="" class="form-label">Source</label>
                                <select class="form-select select" id="source" name="source" value="">
                                    <option value="">Select Source</option>
                                    @foreach($sources as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Plumber</label>
                                <select class="form-select select" id="plumber" name="plumber" value="">
                                    <option value="">Select Plumber</option>
                                    @foreach($plumbers as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Architect</label>
                                <select class="form-select select" id="architect" name="architect" value="">
                                    <option value="">Select Architect</option>
                                    @foreach($architects as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">MEP</label>
                                <select class="form-select select" id="mep" name="mep">
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
                                <select class="form-select select" id="property_stage" name="property_stage" value="">
                                    <option value="">Select Property Stage</option>
                                    @foreach($propertyStage as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <hr>
                            <div class="col-md-4 customer">
                                <label for=" " class="form-label">Select State</label>
                                <select class="form-select select" id="lead_state" name="lead_state">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3 col-md-4 customer">
                                <label for=" " class="form-label">Select City</label>
                                 <select class="form-select select" id="lead_city" name="lead_city">
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
                                <select class="form-select select" id="prod_category" name="prod_category">
                                    <option value="">Select category</option>
                                    @foreach($productCategory as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for=" " class="form-label">Select Sub Category</label>
                                <select class="form-select select" id="prod_subcategory" name="prod_subcategory">
                                    <option value="">Select category</option>
                                     @foreach($productSubCategory as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for=" " class="form-label">Select Product</label>
                                <select class="form-select select" id="prod_id" name="prod_id">
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

$(document).ready(function(){

    /* CSRF */
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    /* Initialize Select2 */
    $('.select').select2({ width:'100%' });

    /* ==============================
       PROPERTY TYPE -> CATEGORY
    ============================== */

    $("#category_type").on('change', function(){

        let type = $(this).val();
        if(!type) return;

        $.ajax({
            type:'POST',
            url:'{{route("get-property-category")}}',
            data:{type:type},
            success:function(data){

                $("#category_id").html(data).trigger('change');

            }
        });

    });

    /* ==============================
       CATEGORY -> SUB CATEGORY
    ============================== */

   $(document).on('change','#category_id',function(){
    let id = $(this).val();
    if(!id){
        $("#sub_category_id").html('<option value="">Select</option>');
        return;
    }

    $.ajax({
        type:'POST',
        url:'{{route("get-property-subcategory")}}',
        data:{ category_id:id },
        success:function(data){

            $("#sub_category_id").html(data).trigger('change');

        }
    });

});


    /* ==============================
       STATE -> CITY
    ============================== */

    $("#lead_state").on('change', function(){

        let state = $(this).val();

        if(!state){
            $("#lead_city").html('<option value="">Select</option>');
            return;
        }

        $.getJSON("{{ route('get-cities') }}",{state:state})
        .done(function(cities){

            let opts='<option value="">Select</option>';

            cities.forEach(function(c){
                opts += '<option value="'+c+'">'+c+'</option>';
            });

            $("#lead_city").html(opts);

        });

    });


    /* ==============================
       MODAL STATE -> CITY
    ============================== */

    $("#state").on('change',function(){

        let state=$(this).val();

        if(!state){
            $("#city").html('<option value="">Select City</option>');
            return;
        }

        $.getJSON("{{ route('get-cities') }}",{state:state})
        .done(function(cities){

            let opts='<option value="">Select City</option>';

            cities.forEach(function(c){
                opts+='<option value="'+c+'">'+c+'</option>';
            });

            $("#city").html(opts);

        });

    });


    /* ==============================
       SALES MANAGER -> BUSINESS CATEGORY
    ============================== */

    $("#sales_manager_id").on("change",function(){

        let sales_manager_id=$(this).val();
        if(!sales_manager_id) return;

        $.ajax({

            type:'POST',
            url:'{{ route("get-business-category") }}',
            data:{sales_manager_id:sales_manager_id},

            success:function(response){

                let html='<option value="">Select</option>';
                let dealer='<option value="">Select</option>';

                if(response.data.business_category){

                    response.data.business_category.forEach(function(el){

                        html+='<option value="'+el.id+'">'+el.name+'</option>';

                    });

                }

                if(response.data.dealer){

                    response.data.dealer.forEach(function(el){

                        dealer+='<option value="'+el.id+'">'+el.name+'</option>';

                    });

                }

                $("#business_category").html(html).trigger('change');
                $("#dealer_id").html(dealer);

            }

        });

    });


    /* ==============================
       BUSINESS CATEGORY -> PRODUCT CATEGORY
    ============================== */

    $(document).on('change','#business_category',function(){

        let business_category=$(this).val();
        if(!business_category) return;

        $.ajax({

            type:'POST',
            url:'{{ route("get-product-category") }}',
            data:{business_category:business_category},

            success:function(data){

                $("#prod_category").html(data).trigger('change');

            }

        });

    });


    /* ==============================
       PRODUCT CATEGORY -> SUB CATEGORY
    ============================== */

    $(document).on('change','#prod_category',function(){

        let prod_category_id=$(this).val();

        if(!prod_category_id){

            $("#prod_subcategory").html('<option value="">Select</option>');
            return;

        }

        $.ajax({

            type:'POST',
            url:'{{ route("get-product-subcategory") }}',
            data:{prod_category_id:prod_category_id},

            success:function(data){

                $("#prod_subcategory").html(data).trigger('change');

            }

        });

    });


    /* ==============================
       SUB CATEGORY -> PRODUCT
    ============================== */

    $(document).on('change','#prod_subcategory',function(){

        let prod_category=$("#prod_category").val();
        let prod_subcategory=$(this).val();

        if(!prod_subcategory){

            $("#prod_id").html('<option value="">Select Product</option>');
            return;

        }

        $.ajax({

            type:'POST',
            url:'{{ route("get-product-lead") }}',

            data:{
                prod_category_id:prod_category,
                prod_subcategory_id:prod_subcategory
            },

            success:function(data){

                $("#prod_id").html(data);

            }

        });

    });


    /* ==============================
       CUSTOMER / DEALER SWITCH
    ============================== */

    $(".dealer,.customer").hide();

    $(document).on("change",".customer_type",function(){

        if($(this).val()=="customer"){

            $(".customer").show();
            $(".dealer").hide();
            $("#dealer_id").val("");

        }

        else if($(this).val()=="dealer"){

            $(".dealer").show();
            $(".customer").hide();
            $("#client_id").val("");

        }

        else{

            $(".dealer,.customer").hide();

        }

    });

});

var products=[];

window.addItem=function(){

    let id=$("#prod_id").val();
    let name=$("#prod_id option:selected").text();
    let qty=parseInt($("#qty").val(),10);

    if(!id){
        alert("Select product");
        return;
    }

    if(!qty || qty<=0){
        alert("Enter valid qty");
        return;
    }

    if(products.find(p=>p.id==id)){
        alert("Product already added");
        return;
    }

    products.push({id:id,qty:qty});

    let row='<tr class="prod'+id+'">'+
        '<td>'+name+'</td>'+
        '<td>'+qty+'</td>'+
        '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem('+id+')"><i class="fa fa-trash"></i></button></td>'+
        '</tr>';

    $("#productList").append(row);

    $("#qty").val("");

};

window.removeItem=function(id){

    products=products.filter(p=>p.id!=id);
    $(".prod"+id).remove();

};


/* ==============================
   FORM SUBMIT
============================== */

(function(){

    'use strict';

    var forms=document.getElementsByClassName('needs-validation');

    if(forms.length){

        var form=forms[0];
        var btn=document.getElementById("savelead");

        btn.addEventListener('click',function(event){

            if(form.checkValidity()===false){

                event.preventDefault();
                event.stopPropagation();

            }

            else{

                $('#prod_list').val(JSON.stringify(products));
                $('#frmMain').submit();

            }

            form.classList.add('was-validated');

        });

    }

})();
</script>
@endsection