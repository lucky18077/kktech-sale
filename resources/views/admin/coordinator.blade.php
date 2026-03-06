@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Dashboard</title>
@endpush
		<!-- /Horizontal Sidebar -->

		<!-- /Two Col Sidebar -->
			
			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4 class="fw-bold">Coordinators</h4>
								<h6>Manage your Coordinators</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<div class="page-btn">
							<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category"><i class="ti ti-circle-plus me-1"></i>Add Coordinator</a>
						</div>
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
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table datatable">
									<thead class="thead-light">
										<tr>
											<th>S.No.</th>
											<th>Name</th>
											<th>Mobile</th>
											<th>Role</th>
											<th>Email</th>
											<th>Active</th>
											<th>Password</th>
											<th>Created Date</th>
                                            <th>Updated Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                         @php
                                        $sno=1;
                                        @endphp
                                        @foreach ($coordinates as $coordinator)
                                            <tr>
                                                <td>{{ $sno++ }}</td>
                                                <td>{{ $coordinator->name }}</td>
                                                <td>{{ $coordinator->phone }}</td>
                                                <td>{{ $coordinator->user_type }}</td>
                                                <td>{{ $coordinator->email }}</td>
                                                <td>
                                                    @if($coordinator->is_active == 1)
                                                    <span class="badge bg-success fw-medium fs-10">Active</span>
                                                    @else
                                                    <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $coordinator->password }}</td>
                                                 <td>{{ $coordinator->created_at }}</td>
                                                 <td>{{ $coordinator->updated_at }}</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a href="javascript:void(0)" class="me-2 p-2 editCoordinator" data-coordinator='@json($coordinator)'>
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
			</div>
        </div>
        <!-- Add Category -->
                <div class="modal fade" id="add-category">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <div class="page-title">
                            <h4 id="modalTitle">Add Coordinator</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form action="/coordinator-save" method="POST">
                        @csrf

                        <!-- Hidden ID for update -->
                        <input type="hidden" name="id" id="edit_id">

                        <div class="modal-body">
							<input type="hidden" name="id" id="edit_id">
                            <div class="mb-3">
                                <label class="form-label">Name <span class="text-danger ms-1" required>*</span></label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger ms-1" required>*</span></label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mobile <span class="text-danger ms-1" required>*</span></label>
                                <input type="text" name="mobile" id="mobile" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role <span class="text-danger ms-1" required>*</span></label>
                                <select class="form-select" id="usr_role" name="usr_role">
                                    <option value="">----Select Role----</option>
                                    <option value="Sales coordinator">Sales coordinator</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sales Area <span class="text-danger ms-1" required>*</span></label>
                                <select class="form-select" id="area" name="area" required>
                                    <option value="">----Select Area----</option>
                                    @foreach($areaMst as $area)
                                        <option value="{{ $area->id }}">
                                            {{ $area->area_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Business Category<span class="text-danger ms-1" required>*</span></label>

                                <select class="form-control" id="business_category" name="business_category[]" multiple required>
                                    @foreach($businessCategories as $businessCategory)
                                        <option value="{{ $businessCategory->id }}">
                                            {{ $businessCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Active <span class="text-danger ms-1" required>*</span></label>
                                <select class="form-control" id="usr_active" name="usr_active" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password <span class="text-danger ms-1" required>*</span></label>
                                <input type="text" class="form-control" name="password" id="password" required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Save Coordinator</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
	<script>
    $(document).ready(function(){
    // Add button reset
    $(".btn-primary[data-bs-target='#add-category']").click(function(){

        $("#modalTitle").text("Add Coordinator");
        $("#submitBtn").text("Add Coordinator");

        $("#edit_id").val('');
        $("#name").val('');
        $("#email").val('');
        $("#mobile").val('');
        $("#usr_role").val('');
        $("#usr_active").val('');
        $("#password").val('');
    });
    // Edit Coordinator
    $(document).on("click",".editCoordinator",function(){

        var data = $(this).data("coordinator");

        $("#modalTitle").text("Edit Coordinator");
        $("#submitBtn").text("Update Coordinator");

        $("#edit_id").val(data.id);
        $("#name").val(data.name);
        $("#email").val(data.email);
        $("#mobile").val(data.mobile);
        $("#usr_role").val(data.user_type);
        $("#usr_active").val(data.active);
        $("#password").val(data.password);

        $("#add-category").modal("show");

    });

});

</script>
@endsection