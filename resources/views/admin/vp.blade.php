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
								<h4 class="fw-bold">Vice Presidents</h4>
								<h6>Manage your Vice Presidnets</h6>
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
							<a href="#" class="btn btn-primary addVp" data-bs-toggle="modal" data-bs-target="#add-category"><i class="ti ti-circle-plus me-1"></i>Add VP</a>
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
							{{-- <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
								<div class="dropdown me-2">
									<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
										Category
									</a>
									<ul class="dropdown-menu  dropdown-menu-end p-3">
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Computers</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Electronics</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Shoe</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Electronics</a>
										</li>
									</ul>
								</div>
								<div class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
										Brand
									</a>
									<ul class="dropdown-menu  dropdown-menu-end p-3">
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Lenovo</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Beats</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Nike</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Apple</a>
										</li>
									</ul>
								</div>
							</div> --}}
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
                                        @foreach ($vicePresidents as $vicePresident)
                                            <tr>
                                                <td>{{ $sno++ }}</td>
                                                <td>{{ $vicePresident->name }}</td>
                                                <td>{{ $vicePresident->phone }}</td>
                                                <td>{{ $vicePresident->user_type }}</td>
                                                <td>{{ $vicePresident->email }}</td>
                                                <td>
                                                    @if($vicePresident->is_active == 1)
                                                    <span class="badge bg-success fw-medium fs-10">Active</span>
                                                    @else
                                                    <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $vicePresident->password }}</td>
                                                 <td>{{ $vicePresident->created_at }}</td>
                                                 <td>{{ $vicePresident->updated_at }}</td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
														<a class="me-2 p-2 editVp" data-data="{{ @json_encode($vicePresident) }}">
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
		<!-- /Main Wrapper -->

        <!-- Add Category -->
		<div class="modal fade" id="addVp">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<div class="page-title">
							<h4>Add VP</h4>
						</div>
						<button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="/vp-save" method ='POST'>
						@csrf
						<div class="modal-body">
							<input type="hidden" name="id" id="edit_id">
							<div class="mb-3">
								<label class="form-label">Name<span class="text-danger ms-1">*</span></label>
								<input type="text" class="form-control" name ='name' required>
							</div>
							<div class="mb-3">
								<label class="form-label">Email<span class="text-danger ms-1">*</span></label>
								<input type="email" name ='email' class="form-control" required>
							</div>
                            <div class="mb-3">
								<label class="form-label">Mobile<span class="text-danger ms-1">*</span></label>
								<input type="tel"  name ='phone' class="form-control" required>
							</div>
                            <div class="mb-3">
                                <label for=" " class="form-label">Role</label>
                                <select class="form-control" id="usr_role" name="usr_role" required>
                                 <option value="Vice President" selected>Vice President</option>
                                </select>
                            </div>

							<div class="mb-3" id="coordinatorField">
								<label class="form-label">Coordinator</label>
								<select class="select2" id="coordinators" name="coordinators[]" multiple="multiple">
									@foreach($users as $user)
										<option value="{{ $user->id }}">
											{{ $user->name }}
										</option>
									@endforeach
								</select>
							</div>
                            <div class="mb-3">
                                <label for=" " class="form-label">Active</label>
                                <select class="form-control" id="" name="is_active" required>
                                    <option value="1">Active</option>
                                    <option value="0">In Active</option>
                                </select>
                            </div>
                             <div class="mb-3">
								<label class="form-label">Password<span class="text-danger ms-1" required>*</span></label>
								<input type="password" class="form-control" name= 'password' required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" id = 'submitBtn'>Add user</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Category -->
		<script>
			$(".addVp").on("click", function() {
				$("#title").text("Add VP");
				$("#submitBtn").text("Add VP");
				$("input, select, textarea").not("[name='_token']").val("");
				$("select[name='coordinators[]']").val(null).trigger('change');
				$("#coordinatorField").show();
				$("#addVp").modal("show");
			});
			$(document).on("click", ".editVp", function() {
				$("#title").text("Edit VP");
				$("#submitBtn").text("Update VP");
				$("#coordinatorField").show();
				var data = $(this).data("data");
				
				$.each(data, function(i, o) {
					$("input[name=" + i + "]").val(o)
					$("select[name=" + i + "]").val(o)
					$("textarea[name=" + i + "]").val(o)
				});
				
				// Load available coordinators and currently assigned ones
				if(data.id) {
					$.ajax({
						url: '/vp/coordinators/' + data.id,
						type: 'GET',
						dataType: 'json',
						success: function(response) {
							var $select = $("select[name='coordinators[]']");
							var assignedIds = response.assigned || [];
							var availableCoordinators = response.available || [];
							
							// Convert assigned IDs to strings for comparison
							assignedIds = assignedIds.map(function(id) {
								return String(id);
							});
							
							// Rebuild dropdown with available (unassigned) coordinators
							$select.empty();
							
							availableCoordinators.forEach(function(coordinator) {
								var coordinatorId = String(coordinator.id);
								$select.append(
									$("<option/>")
										.val(coordinatorId)
										.text(coordinator.name)
								);
							});
							
							// Set the currently assigned ones as selected
							// If a coordinator is assigned but not in the available list,
							// add an option for it so it can be displayed and optionally deselected
							assignedIds.forEach(function(coordId) {
								if ($select.find("option[value='" + coordId + "']").length === 0) {
									// This coordinator is assigned but not in available list
									// We'll just skip adding it and rely on the assignment maintaining it
								}
							});
							
							// Set the selected values
							$select.val(assignedIds);
							
							// Trigger change to update select2
							$select.trigger('change');
						},
						error: function(xhr, status, error) {
							console.error('Error loading coordinators:', error);
							console.log('Response:', xhr.responseText);
						}
					});
				}

				$("#addVp").modal("show");
			});
    </script>
@endsection