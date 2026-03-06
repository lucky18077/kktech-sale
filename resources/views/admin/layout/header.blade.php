<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Dreams POS is a powerful Bootstrap based Inventory Management Admin Template designed for businesses, offering seamless invoicing, project tracking, and estimates.">
	<meta name="keywords" content="inventory management, admin dashboard, bootstrap template, invoicing, estimates, business management, responsive admin, POS system">
	<meta name="author" content="Dreams Technologies">
	<meta name="robots" content="index, follow">
	@stack('title')

	<!-- <script src="/admin/js/theme-script.js" type="4eb94832f85929b2ef942c65-text/javascript"></script> -->

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/admin/css/bootstrap.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="/admin/css/bootstrap-datetimepicker.min.css">

	<!-- animation CSS -->
	<link rel="stylesheet" href="/admin/css/animate.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="/admin/css/feather.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="/admin/css/select2.min.css">

	<!-- Quill CSS -->
	<link rel="stylesheet" href="/admin/css/quill.snow.css">

	<!-- Bootstrap Tagsinput CSS -->
	<link rel="stylesheet" href="/admin/css/bootstrap-tagsinput.css">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="/admin/css/tabler-icons.min.css">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="/admin/css/dataTables.bootstrap5.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="/admin/css/fontawesome.min.css">
	<link rel="stylesheet" href="/admin/css/all.min.css">

	<!-- Color Picker Css -->
	<link rel="stylesheet" href="/admin/css/nano.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="/admin/css/style.css">

	<script src="/admin/js/jquery-3.7.1.min.js"></script>

</head>

<body>

	<div id="global-loader">
		<div class="whirly-loader"> </div>
	</div>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">
			<div class="main-header">

				<!-- Logo -->
				<div class="header-left active">
					<a href="/" class="logo logo-normal">
						<img src="/admin/images/logo.webp" alt="Img" style="height: 45px; width: 45px;">
					</a>
					<a href="/" class="logo logo-white">
						<img src="/admin/images/logo-white.svg" alt="Img">
					</a>
					<a href="/" class="logo-small">
						<img src="/admin/images/logo-small.png" alt="Img">
					</a>
					<a href="/" class="logo-small-white">
						<img src="/admin/images/logo-small-white.png" alt="Img">
					</a>
				</div>
				<!-- /Logo -->

				<a id="mobile_btn" class="mobile_btn" href="#sidebar">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>

				<!-- Header Menu -->
				<ul class="nav user-menu">
					<div class="nav-searchinputs d-flex align-items-center">
						<li class="nav-item "><button class="btn btn-sm btn-success">Sale</button></li>
						<li class="nav-item "><button class="btn btn-sm btn-dark">Inventory</button></li>
						<li class="nav-item "><button class="btn btn-sm btn-dark">Service</button></li>
					</div>
					<!-- /Search -->

					<!-- Select Store -->
					<li class="nav-item dropdown has-arrow main-drop select-store-dropdown">

					</li>
					<!-- /Select Store -->

					<li class="nav-item dropdown link-nav">
						<a href="javascript:void(0);" class="btn btn-primary btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
							<i class="ti ti-circle-plus me-1"></i>Add New
						</a>
						<div class="dropdown-menu dropdown-xl dropdown-menu-center">
							<div class="row g-2">
								<div class="col-md-2">
									<a href="category-list.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-brand-codepen"></i>
										</span>
										<p>Category</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="add-product.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-square-plus"></i>
										</span>
										<p>Product</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="category-list.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-shopping-bag"></i>
										</span>
										<p>Purchase</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="online-orders.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-shopping-cart"></i>
										</span>
										<p>Sale</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="expense-list.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-file-text"></i>
										</span>
										<p>Expense</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="quotation-list.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-device-floppy"></i>
										</span>
										<p>Quotation</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="sales-returns.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-copy"></i>
										</span>
										<p>Return</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="users.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-user"></i>
										</span>
										<p>User</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="customers.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-users"></i>
										</span>
										<p>Customer</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="sales-report.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-shield"></i>
										</span>
										<p>Biller</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="suppliers.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-user-check"></i>
										</span>
										<p>Supplier</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="stock-transfer.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-truck"></i>
										</span>
										<p>Transfer</p>
									</a>
								</div>
							</div>
						</div>
					</li>



					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav nav-item-box">

					</li>
					<!-- /Flag -->

					<li class="nav-item nav-item-box">
						<a href="javascript:void(0);" id="btnFullscreen">
							<i class="ti ti-maximize"></i>
						</a>
					</li>

					<li class="nav-item nav-item-box">
						<a href="#"><i class="ti ti-settings"></i></a>
					</li>
					<li class="nav-item dropdown has-arrow main-drop profile-nav">
						<a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
							<span class="user-info p-0">
								<span class="user-letter">
									<img src="/admin/images/avator1.jpg" alt="Img" class="img-fluid">
								</span>
							</span>
						</a>
						<div class="dropdown-menu menu-drop-user">
							<div class="profileset d-flex align-items-center">
								<span class="user-img me-2">
									<img src="/admin/images/avator1.jpg" alt="Img">
								</span>
								<div>
									<h6 class="fw-medium">John Smilga</h6>
									<p>Admin</p>
								</div>
							</div>
							<a class="dropdown-item" href="#"><i class="ti ti-user-circle me-2"></i>MyProfile</a>
							<a class="dropdown-item" href="#"><i class="ti ti-settings-2 me-2"></i>Settings</a>
							<hr class="my-2">
							<a class="dropdown-item logout" href="{{ route('logout') }}"><i class="ti ti-logout me-2"></i>Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#">My Profile</a>
						<a class="dropdown-item" href="#">Settings</a>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							Logout
						</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
			</div>
		</div>
		<!-- /Header -->

		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- Logo -->
			<div class="sidebar-logo">
				<a href="/" class="logo logo-normal">
					<img src="/admin/images/logo.webp" alt="Img" style="height: 45px; width: 45px;">
				</a>
				<a href="/" class="logo logo-white">
					<img src="/admin/images/logo-white.svg" alt="Img">
				</a>
				<a href="/" class="logo-small">
					<img src="/admin/images/logo-small.png" alt="Img">
				</a>
				<a href="/" class="logo-small-white">
					<img src="/admin/images/logo-small-white.png" alt="Img">
				</a>
				<a id="toggle_btn" href="javascript:void(0);">
					<i data-feather="chevrons-left" class="feather-16"></i>
				</a>
			</div>
			<!-- /Logo -->
			<div class="modern-profile p-3 pb-0">
				<div class="text-center rounded bg-light p-3 mb-4 user-profile">
					<div class="avatar avatar-lg online mb-3">
						<img src="/admin/images/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
					</div>
					<h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
					<p class="fs-12 mb-0">System Admin</p>
				</div>
				<div class="sidebar-nav mb-3">
					<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent" role="tablist">
						<li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
						<li class="nav-item"><a class="nav-link border-0" href="chat.html">Chats</a></li>
						<li class="nav-item"><a class="nav-link border-0" href="email.html">Inbox</a></li>
					</ul>
				</div>
			</div>
			<div class="sidebar-header p-3 pb-0 pt-2">
				<div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
					<div class="avatar avatar-md onlin">
						<img src="/admin/images/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
					</div>
					<div class="text-start sidebar-profile-info ms-2">
						<h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
						<p class="fs-12">System Admin</p>
					</div>
				</div>
				<div class="d-flex align-items-center justify-content-between menu-item mb-3">
					<div>
						<a href="/" class="btn btn-sm btn-icon bg-light">
							<i class="ti ti-layout-grid-remove"></i>
						</a>
					</div>
					<div>
						<a href="chat.html" class="btn btn-sm btn-icon bg-light">
							<i class="ti ti-brand-hipchat"></i>
						</a>
					</div>
					<div>
						<a href="email.html" class="btn btn-sm btn-icon bg-light position-relative">
							<i class="ti ti-message"></i>
						</a>
					</div>
					<div class="notification-item">
						<a href="activities.html" class="btn btn-sm btn-icon bg-light position-relative">
							<i class="ti ti-bell"></i>
							<span class="notification-status-dot"></span>
						</a>
					</div>
					<div class="me-0">
						<a href="general-settings.html" class="btn btn-sm btn-icon bg-light">
							<i class="ti ti-settings"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Main</h6>
							<ul>
								<li class="active"><a href="{{ route('dashboard') }}"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span></a></li>
								<li class="submenu mt-2">
									<a href="javascript:void(0);"><i class="ti ti-user-edit fs-16 me-2"></i><span>Staff Management</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('coordinator') }}">Coordinator</a></li>
										<li><a href="{{ route('vp') }}">VP</a></li>
										<li><a href="{{route('saleManager')}}">Sale Manager/Executive</a></li>
										<li><a href="{{route('designations')}}">Designations</a></li>
										<li><a href="{{route('officeTeams')}}">Office Team</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-layout-sidebar-right-collapse fs-16 me-2"></i><span>Masters</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('business-category') }}">Business Category</a></li>
										<li><a href="{{ route('department') }}">Department</a></li>
										<li><a href="{{ route('property-stage') }}">Property Stage</a></li>
										<li><a href="{{ route('source') }}">Sources</a></li>
										<li><a href="{{ route('property-category') }}">Property Category</a></li>
										<li><a href="{{ route('property-sub-category') }}">Property Sub Category</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-chart-bar fs-16 me-2"></i><span>Product Master</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('product-category') }}">Product Category</a></li>
										<li><a href="{{ route('product-sub-category') }}">Product Sub Category</a></li>
										<li><a href="{{ route('product-uom') }}">Product UOM</a></li>
										<li><a href="{{ route('products') }}">Product</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-device-laptop fs-16 me-2"></i><span>Purchase Order</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Generate PO</a></li>
										<li><a href="#">Generating PO</a></li>
										<li><a href="#">Generated PO</a></li>
										<li><a href="#">Purchases</a></li>
										<li><a href="#">MRN</a></li>
										<li><a href="#">Partial Approved</a></li>
										<li><a href="#">Full Approved</a></li>
										<li><a href="#">Purchase Return</a></li>
										<li><a href="#">MRN Product Wise</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-calendar fs-16 me-2"></i><span>Purchase Return</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Add Purchase Return</a></li>
										<li><a href="#">Return Challan</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-triangle-inverted fs-16 me-2"></i><span>Lead Management</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Add Lead</a></li>
										<li><a href="#">New Lead</a></li>
										<li><a href="#">Pending Lead</a></li>
										<li><a href="#">Processing Lead</a></li>
										<li><a href="#">Call Sheduled</a></li>
										<li><a href="#">Visit Sheduled</a></li>
										<li><a href="#">Visit Done</a></li>
										<li><a href="#">Lost Lead</a></li>
										<li><a href="#">Converted Lead</a></li>
										<li><a href="#">Partial Lead</a></li>
										<li><a href="#">Complete</a></li>
										<li><a href="#">All Lead</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-shield-up fs-16 me-2"></i><span>Quotes</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Requested Quotes</a></li>
										<li><a href="#">Generated Quotes</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-world fs-16 me-2"></i><span>Performa Invoice (PI)</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Requested Performa</a></li>
										<li><a href="#">Generated Performa</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-file fs-16 me-2"></i><span>Order Management</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Create order</a></li>
										<li><a href="#">New Order</a></li>
										<li><a href="#">Pending Order</a></li>
										<li><a href="#">Completed Order</a></li>
										<li><a href="#">View Pick Tickets</a></li>
										<li><a href="#">Cancelled Order</a></li>
									</ul>
								</li>
								<li><a href="#"><i class="ti ti-exchange fs-16 me-2"></i><span>Sale Return</span></a></li>
								<li><a href="#"><i class="ti ti-wallpaper fs-16 me-2"></i><span>Invoices</span></a></li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-compass fs-16 me-2"></i><span>Dispatch Management</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Dispatch Plan</a></li>
										<li><a href="#">Ready to Deliver</a></li>
										<li><a href="#">Delivered</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-arrows-shuffle fs-16 me-2"></i><span>Service CheckList</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Category</a></li>
										<li><a href="#">CheckList</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-businessplan fs-16 me-2"></i><span>Service Management</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="#">Add Service</a></li>
										<li><a href="#">Pending Service</a></li>
										<li><a href="#">Processing Service</a></li>
										<li><a href="#">Complete Service</a></li>
										<li><a href="#">Rejected Service</a></li>
										<li><a href="#">All Service</a></li>
									</ul>
								</li>
								<li>
									<a href="{{route('logout')}}"><i class="ti ti-logout fs-16 me-2"></i><span>Logout</span> </a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->