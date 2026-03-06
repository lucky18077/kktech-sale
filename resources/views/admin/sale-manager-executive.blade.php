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
							<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category"><i class="ti ti-circle-plus me-1"></i>Add Sale Executive/Manager</a>
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
                                                <td>{{ $saleManager->mobile }}</td>
                                                <td>{{ $saleManager->user_type }}</td>
                                                <td>{{ $saleManager->email }}</td>
                                                <td>
                                                    @if($saleManager->active == 1)
                                                    <span class="badge bg-success fw-medium fs-10">Active</span>
                                                    @else
                                                    <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <a href="javascript:void(0)" class="me-2 p-2 editsaleManager" data-saleManager='@json($saleManager)'>
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

		 

		<!-- delete modal -->
			<div class="modal fade" id="delete-modal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content p-5 px-3 text-center">
								<span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2"><i class="ti ti-trash fs-24 text-danger"></i></span>
								<h4 class="fs-20 text-gray-9 fw-bold mb-2 mt-1">Delete Product</h4>
								<p class="text-gray-6 mb-0 fs-16">Are you sure you want to delete product?</p>
								<div class="modal-footer-btn mt-3 d-flex justify-content-center">
									<button type="button" class="btn me-2 btn-secondary fs-13 fw-medium p-2 px-3 shadow-none" data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-primary fs-13 fw-medium p-2 px-3">Yes Delete</button>
								</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- Add Category -->
		<div class="modal fade" id="add-category">
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
								<label class="form-label">Sales Area<span class="text-danger ms-1">*</span></label>
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
							<button type="submit" class="btn btn-primary">Add user</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Category -->
@endsection