@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Property Sub-Category</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Property Sub-Category</h4>
                    <h6>Manage property sub-categories</h6>
                </div>
            </div>

            <div class="page-btn">
                <button class="btn btn-primary addPropertySubCategory"><i class="ti ti-circle-plus me-1"></i>Add Property Sub-Category</button>
            </div>

        </div>

        <!-- /property list -->
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
                                <th>Property Category</th>
                                <th>Property Sub-Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sno=1;
                            @endphp
                            @foreach ($propertySubCategories as $item)
                            <tr>
                                <td>{{ $sno++ }}</td>
                                <td>{{ $item->propertyCategory->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if($item->active == 1)
                                    <span class="badge bg-success fw-medium fs-10">Active</span>
                                    @else
                                    <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                    @endif
                                </td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 editPropertySubCategory" data-data='@json($item)'>
                                            <i data-feather="edit" class="feather-edit"></i>
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
        <!-- /property list -->
    </div>

    <!-- Add property sub-category -->
    <div class="modal fade" id="propertySubCategory">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4 id="submitBtn">Add Property Sub-Category</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('property-sub-category-save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label class="form-label">Property Category <span class="text-danger ms-1">*</span></label>
                            <select class="select" name="property_category_id" required>
                                <option value="">Select Property Category</option>
                                @foreach ($propertyCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select class="select" name="active" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
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
    <!-- /Add property sub-category -->

    <script>
        $(".addPropertySubCategory").on("click", function() {
            $("#title").text("Add Property Sub-Category");
            $("#submitBtn").text("Add Property Sub-Category");
            $("input[name='id']").val('');
            $("input[name='name']").val('');
            $("select[name='active']").val('');
            $("#propertySubCategory").modal("show");
        });
        $(document).on("click", ".editPropertySubCategory", function() {
            $("#title").text("Edit Property Sub-Category");
            $("#submitBtn").text("Update Property Sub-Category");
            var data = $(this).data("data");
            $.each(data, function(i, o) {

                $("input[name='" + i + "']").val(o);
                $("select[name='" + i + "']").val(o);

            });
            $("#propertySubCategory").modal("show");
        });
    </script>
    @endsection