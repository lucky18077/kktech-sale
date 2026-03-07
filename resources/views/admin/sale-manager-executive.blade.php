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
								<h4 class="fw-bold">Sale Executive/Manager</h4>
								<h6>Manage your Sale Exective/Manager</h6>
							</div>
						</div>
						<ul class="table-top-head">
							 
						</ul>
						<div class="page-btn">
							<div class="page-btn">
							<a href="#" class="btn btn-primary addOfficeTeam" data-bs-toggle="modal" data-bs-target="#add-category"><i class="ti ti-circle-plus me-1"></i>Add Sale Executive/Manager</a>
						</div>
						</div>	
						{{-- <div class="page-btn import">
							<a href="#" class="btn btn-secondary color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
								data-feather="download" class="me-1"></i>Import Product</a>
						</div> --}}
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
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                         @php
                                        $sno=1;
                                        @endphp
                                        @foreach ($salesManagers as $saleManager)
                                            <tr>
                                                <td>{{ $sno++ }}</td>
                                                <td>{{ $saleManager->name }}</td>
                                                <td>{{ $saleManager->phone }}</td>
                                                <td>{{ $saleManager->user_type }}</td>
                                                <td>{{ $saleManager->email }}</td>
                                                <td>
                                                    @if($saleManager->is_active == 1)
                                                    <span class="badge bg-success fw-medium fs-10">Active</span>
                                                    @else
                                                    <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="action-table-data">
													<div class="edit-delete-action">
													<a class="me-2 p-2 editOfficeTeams" data-data="{{ json_encode($saleManager) }}">
														<i data-feather="edit"></i>
													</a>

													<a class="me-2 p-2" href="{{route('view-sales-manager-executive-details', $saleManager->id)}}">
														<i data-feather="eye"></i>
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
		<div class="modal fade" id="addOfficeTeam">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<div class="page-title">
							<h4 id= 'submitBtn'>Add VP</h4>
						</div>
						<button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="/saleManager-save" method ='POST'>
						@csrf
						<div class="modal-body">
							<input type="hidden" name="id">
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
                                <label for=" " class="form-label">Role<span class="text-danger ms-1">*</span></label>
                                <select class="form-control" id="usr_role" name="usr_role" required>
                                 <option value="Sales Manager">Sales Manager</option>
                                 <option value="Sales Executive">Sales Executive</option>
                                </select>
                            </div>
							<div class="mb-3">
								<label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
								<select class="form-control" id="area" name="designation" required>
									<option value="">----Select  Designation----</option>
									@foreach($designations as $designation)
										<option value="{{ $designation->id }}">
											{{ $designation->name }}
										</option>
									@endforeach
								</select>
							</div>
                            <div class="mb-3">
                                <label for=" " class="form-label">Active<span class="text-danger ms-1">*</span></label>
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
							<button type="submit" class="btn btn-primary" id = 'submitBtn' >Add user</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Category -->
		<script>
			$(".addOfficeTeam").on("click", function() {
				$("#title").text("Add Sale Manager/Executive");
				$("#submitBtn").text("Add User");
				$("input, select, textarea").not("[name='_token']").val("");
				$("#addOfficeTeam").modal("show");
			});
			$(document).on("click", ".editOfficeTeams", function() {
				$("#title").text("Edit Team");
				$("#submitBtn").text("Update Team");
				var data = $(this).data("data");
				$.each(data, function(i, o) {
					$("input[name=" + i + "]").val(o)
					$("select[name=" + i + "]").val(o)
					$("textarea[name=" + i + "]").val(o)
				});
				$("#addOfficeTeam").modal("show");
			});
    	</script>
@endsection