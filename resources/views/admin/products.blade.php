@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Products</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Products </h4>
                    <h6>Manage products</h6>
                </div>
            </div>

            <div class="page-btn">
                <button class="btn btn-primary addProduct"><i class="ti ti-circle-plus me-1"></i>Add Product</button>
            </div>
            <div class="page-btn import">
                <a href="#" class="btn btn-secondary color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
                        data-feather="download" class="me-1"></i>Import Product</a>
            </div>
        </div>

        <!-- /products list -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="search-set">
                    <div class="search-input">
                        <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                    </div>
                </div>
                <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">

                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Product Image</th>
                                <th>Business Category</th>
                                <th>Product Category</th>
                                <th>Product Sub Category</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Purchase Price</th>
                                <th>GST(%)</th>
                                <th>CESS(%)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($product->img)
                                    <img src="{{ asset('product-images/'.$product->img) }}"
                                        alt="Product Image"
                                        class="img-fluid"
                                        style="max-width:80px; max-height:80px;">
                                    @else
                                    <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $product->businessCategory->name ?? '-'  }}</td>
                                <td>{{ $product->productCategory->name ?? '-'  }}</td>
                                <td>{{ $product->productSubCategory->name ?? '-'  }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->purchase_price }}</td>
                                <td>{{ $product->gst_tax }}</td>
                                <td>{{ $product->cess_tax }}</td>
                                <td><span class="badge bg-{{ $product->active ? 'success' : 'danger' }}">{{ $product->active ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-primary editProduct" data-data='@json($product)'><i class="ti ti-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>

    <!-- Product -->
    <div class="modal fade" id="products">
        <div class="modal-dialog modal-dialog-centered stock-adjust-modal barcode-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4 id="submitBtn">Product</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16 shadow-none" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('product-save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pb-0 mb-4">
                        <div class="row">
                            <input type="hidden" name="id">
                            <div class="col-sm-4">
                                <label class="form-label">Product Image </label>
                                <input type="file" class="form-control" name="img">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Business Category <span class="text-danger ms-1">*</span></label>
                                <select class="select" name="business_category_id" required>
                                    @foreach($businessCategories as $businessCategory)
                                    <option value="{{ $businessCategory->id }}">{{ $businessCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Product Category <span class="text-danger ms-1">*</span></label>
                                <select class="select" name="product_category_id" required>
                                    @foreach($productCategories as $productCategory)
                                    <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Product Sub Category <span class="text-danger ms-1">*</span></label>
                                <select class="select" name="product_subcategory_id" required>
                                    @foreach($productSubCategories as $productSubCategory)
                                    <option value="{{ $productSubCategory->id }}">{{ $productSubCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Product UOM <span class="text-danger ms-1">*</span></label>
                                <select class="select" name="product_uom_id" required>
                                    @foreach($productUOMs as $productUOM)
                                    <option value="{{ $productUOM->id }}">{{ $productUOM->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Product Name <span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Product Price <span class="text-danger ms-1">*</span></label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Purchase Price <span class="text-danger ms-1">*</span></label>
                                <input type="number" class="form-control" name="purchase_price" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Dealer Price <span class="text-danger ms-1">*</span></label>
                                <input type="number" class="form-control" name="dealer_price" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">HSN Code <span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="hsn_code" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">GST <span class="text-danger ms-1">*</span></label>
                                <input type="number" class="form-control" name="gst_tax" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">CESS </label>
                                <input type="number" class="form-control" name="cess_tax">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Min Stock <span class="text-danger ms-1">*</span> </label>
                                <input type="number" class="form-control" name="min_stock" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Warranty Days <span class="text-danger ms-1">*</span> </label>
                                <input type="number" class="form-control" name="warranty_days" required>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                <select class="select" name="active" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <label class="form-label">Description<span class="text-danger ms-1">*</span> </label>
                                <textarea type="text" class="form-control" name="description" required></textarea>
                            </div>
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
    <!-- /Product -->

    <!-- Import Product -->
    <div class="modal fade" id="view-notes">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">

                        <div class="modal-header">
                            <div class="page-title">
                                <h4>Import Products</h4>
                                <p class="text-muted mb-0">Upload products using CSV file</p>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-body">



                                <!-- Download Sample -->
                                <div class="mb-3">
                                    <a href="/sample_products.csv" class="btn btn-outline-primary">
                                        <i class="fa fa-download me-1"></i> Download Sample File
                                    </a>
                                </div>

                                <!-- File Upload -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload CSV File</label>
                                    <input type="file" class="form-control" name="file" accept=".csv" required>
                                    <small class="text-muted">Only CSV files are supported.</small>
                                </div>
                                <!-- Instructions -->
                                <div class="alert alert-info mb-4">
                                    <h6 class="mb-2"><strong>Instructions:</strong></h6>
                                    <ul class="mb-0 ps-3">
                                        <li>1, Download the sample CSV file and follow the same format.</li>
                                        <li>2, Category, Subcategory, Business Category and UOM names must match exactly.</li>
                                        <li>3, Products with invalid category or missing fields will be skipped.</li>
                                        <li>4, Only <strong>.CSV files</strong> are allowed.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn me-2 btn-secondary fs-13 fw-medium p-2 px-3 shadow-none" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary fs-13 fw-medium p-2 px-3"> Import Products</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Import Product -->

    <script>
        $(".addProduct").on("click", function() {
            $("#submitBtn").text("Update Product");
            $("#products form")[0].reset();
            $("input[name=id]").val("");
            $("#submitBtn").text("Add Product");
            $("#products").modal("show");
        });


        $(document).on("click", ".editProduct", function() {
            var data = $(this).data("data");
            $("#submitBtn").text("Update Product");
            $.each(data, function(i, o) {
                if (i != 'img') {
                    $("input[name='" + i + "']").val(o);
                    $("select[name='" + i + "']").val(o);
                    $("textarea[name='" + i + "']").val(o);
                }
            });
            $("#products").modal("show");
        });
    </script>

    @endsection