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
							<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category"><i class="ti ti-circle-plus me-1"></i>Add VP</a>
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
                                                <td>{{ $vicePresident->mobile }}</td>
                                                <td>{{ $vicePresident->user_type }}</td>
                                                <td>{{ $vicePresident->email }}</td>
                                                <td>
                                                    @if($vicePresident->active == 1)
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
                                                        <a href="javascript:void(0)" class="me-2 p-2 editvicePresident" data-vicePresident='@json($vicePresident)'>
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

		<!-- Import Product -->
		<div class="modal fade" id="view-notes">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header">
								<div class="page-title">
									<h4>Import Product</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="https://dreamspos.dreamstechnologies.com/html/template/product-list.html">
								
									<div class="row">
										<div class="col-12">
											<div class="mb-3">
												<label>Product<span class="ms-1 text-danger">*</span></label>
												<select class="select">
													<option>Select</option>
													<option>Bold V3.2</option>
													<option>Nike Jordan</option>
													<option>Iphone 14 Pro</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6 col-12">
											<div class="mb-3">
												<label>Category<span class="ms-1 text-danger">*</span></label>
												<select class="select">
													<option>Select</option>
													<option>Laptop</option>
													<option>Electronics</option>
													<option>Shoe</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6 col-12">
											<div class="mb-3">
												<label>Sub Category<span class="ms-1 text-danger">*</span></label>
												<select class="select">
													<option>Select</option>
													<option>Lenovo</option>
													<option>Bolt</option>
													<option>Nike</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12 col-sm-6 col-12">
											<div class="row">
												<div>
													<div class="modal-footer-btn download-file">
														<a href="javascript:void(0)" class="btn btn-submit">Download Sample File</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3 image-upload-down">
												<label class="form-label">Upload CSV File</label>
												<div class="image-upload download">
													<input type="file">
													<div class="image-uploads">
														<img src="assets/img/download-img.png" alt="img">
														<h4>Drag and drop a <span>file to upload</span></h4>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Created by<span class="ms-1 text-danger">*</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-lg-12">
										<div class="mb-3 mb-3">
											<label class="form-label">Description</label>
											<textarea class="form-control"></textarea>
											<p class="mt-1">Maximum 60 Characters</p>
										</div>
									</div>
								</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn me-2 btn-secondary fs-13 fw-medium p-2 px-3 shadow-none" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary fs-13 fw-medium p-2 px-3">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Import Product -->

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
								<input type="phone"  name ='phone' class="form-control" required>
							</div>
                            <div class="mb-3">
                                <label for=" " class="form-label">Role</label>
                                <select class="form-control" id="usr_role" name="usr_role" required>
                                 <option value="Vice President" selected>Vice President</option>
                                </select>
                            </div>

							<div class="mb-3">
								<label class="form-label">Coordinator</label>
								<select class="form-control" id="parent_id" name="parent_id[]" multiple required>
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
							<button type="submit" class="btn btn-primary">Add user</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Category -->
@endsection