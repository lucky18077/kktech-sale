@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Lead Statuses</title>
@endpush

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Lead statuses</h4>
                    <h6>Manage departments</h6>
                </div>
            </div>

            <div class="page-btn">
                <button class="btn btn-primary addDepartment"><i class="ti ti-circle-plus me-1"></i>Add Lead Status</button>
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
                <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">

                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Lead Status Name</th>
                                <th>Sequence</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sno=1;
                            @endphp
                            @foreach ($leadStatuses as $leadStatus)
                            <tr>
                                <td>{{ $sno++ }}</td>
                                <td>{{ $leadStatus->name }}</td>
                                <td>
                                     {{ $leadStatus->sequence }}
                                </td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2 editDepartment" data-data='@json($leadStatus)'>
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
        <!-- /product list -->
    </div>

    <!-- Add department -->
    <div class="modal fade" id="department">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4 id="title">Add Department</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('leadstatus-save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">sequence<span class="text-danger ms-1">*</span></label>
                           <input type="number" class="form-control" name="sequence" required>
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
    <!-- /Add department -->



    <script>
        $(".addDepartment").on("click", function() {
            $("#title").text("Add Lead Status");
            $("#submitBtn").text("Add Lead Status");
            $("input[name='id']").val('');
            $("input[name='name']").val('');
            $("input[name='sequence']").val('');
            $("#department").modal("show");
        });
        $(document).on("click", ".editDepartment", function() {
            $("#title").text("Edit Lead Status");
            $("#submitBtn").text("Update Lead Status");
            var data = $(this).data("data");
            $.each(data, function(i, o) {
                $("input[name='" + i + "']").val(o);
            });

            $("#department").modal("show");
        });
    </script>
    @endsection