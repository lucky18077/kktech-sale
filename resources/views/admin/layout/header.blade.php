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
						<img src="/admin/images/logo.svg" alt="Img">
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

					<!-- Search -->
					<li class="nav-item nav-searchinputs">

					</li>
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

					<li class="nav-item pos-nav">
						<a href="#" class="btn btn-dark btn-md d-inline-flex align-items-center">
							<i class="ti ti-device-laptop me-1"></i>POS
						</a>
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
						<a href="email.html">
							<i class="ti ti-mail"></i>
							<span class="badge rounded-pill">1</span>
						</a>
					</li>
					<!-- Notifications -->
					<li class="nav-item dropdown nav-item-box">
						<a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<i class="ti ti-bell"></i>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<h5 class="notification-title">Notifications</h5>
								<a href="javascript:void(0)" class="clear-noti">Mark all as read</a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="Img" src="/admin/images/avatar-13.jpg">
												</span>
												<div class="flex-grow-1">
													<p class="noti-details"><span class="noti-title">James Kirwin</span> confirmed his order. Order No: #78901.Estimated delivery: 2 days</p>
													<p class="noti-time">4 mins ago</p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="Img" src="/admin/images/avatar-03.jpg">
												</span>
												<div class="flex-grow-1">
													<p class="noti-details"><span class="noti-title">Leo Kelly</span> cancelled his order scheduled for 17 Jan 2025</p>
													<p class="noti-time">10 mins ago</p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html" class="recent-msg">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="Img" src="/admin/images/avatar-17.jpg">
												</span>
												<div class="flex-grow-1">
													<p class="noti-details">Payment of $50 received for Order #67890 from <span class="noti-title">Antonio Engle</span></p>
													<p class="noti-time">05 mins ago</p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html" class="recent-msg">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="Img" src="/admin/images/avatar-02.jpg">
												</span>
												<div class="flex-grow-1">
													<p class="noti-details"><span class="noti-title">Andrea</span> confirmed his order. Order No: #73401.Estimated delivery: 3 days</p>
													<p class="noti-time">4 mins ago</p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer d-flex align-items-center gap-3">
								<a href="#" class="btn btn-secondary btn-md w-100">Cancel</a>
								<a href="activities.html" class="btn btn-primary btn-md w-100">View all</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->

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
							<a class="dropdown-item" href="#"><i class="ti ti-file-text me-2"></i>Reports</a>
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
					<img src="/admin/images/logo.svg" alt="Img">
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
							</ul>
						</li>

						<li class="submenu-open">
							<h6 class="submenu-hdr">Product Master</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Product Master</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('product-category') }}">Product Category</a></li>
										<li><a href="{{ route('product-sub-category') }}">Product Sub Category</a></li>
										<li><a href="{{ route('product-uom') }}">Product UOM</a></li>
										<li><a href="{{ route('products') }}">Product</a></li>
									</ul>
								</li>
								<li><a href="invoice.html"><i class="ti ti-file-invoice fs-16 me-2"></i><span>Invoices</span></a></li>
								<li><a href="sales-returns.html"><i class="ti ti-receipt-refund fs-16 me-2"></i><span>Sales Return</span></a></li>
								<li><a href="quotation-list.html"><i class="ti ti-files fs-16 me-2"></i><span>Quotation</span></a></li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-device-laptop fs-16 me-2"></i><span>POS</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="pos.html">POS 1</a></li>
										<li><a href="pos-2.html">POS 2</a></li>
										<li><a href="pos-3.html">POS 3</a></li>
										<li><a href="pos-4.html">POS 4</a></li>
										<li><a href="pos-5.html">POS 5</a></li>
										<li><a href="https://dreamspos.dreamstechnologies.com/food-pos/html/" target="_blank">POS 6</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Peoples</h6>
							<ul>
								<li><a href="customers.html"><i class="ti ti-users-group fs-16 me-2"></i><span>Customers</span></a></li>
								<li><a href="billers.html"><i class="ti ti-user-up fs-16 me-2"></i><span>Billers</span></a></li>
								<li><a href="suppliers.html"><i class="ti ti-user-dollar fs-16 me-2"></i><span>Suppliers</span></a></li>
								<li><a href="store-list.html"><i class="ti ti-home-bolt fs-16 me-2"></i><span>Stores</span></a></li>
								<li><a href="warehouse.html"><i class="ti ti-archive fs-16 me-2"></i><span>Warehouses</span></a>
								</li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">HRM</h6>
							<ul>
								<li><a href="employees-grid.html"><i class="ti ti-user fs-16 me-2"></i><span>Employees</span></a></li>
								<li><a href="department-grid.html"><i class="ti ti-compass fs-16 me-2"></i><span>Departments</span></a></li>
								<li><a href="designation.html"><i class="ti ti-git-merge fs-16 me-2"></i><span>Designation</span></a></li>
								<li><a href="shift.html"><i class="ti ti-arrows-shuffle fs-16 me-2"></i><span>Shifts</span></a></li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-user-cog fs-16 me-2"></i><span>Attendence</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="attendance-employee.html">Employee</a></li>
										<li><a href="attendance-admin.html">Admin</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-calendar fs-16 me-2"></i><span>Leaves</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="leaves-admin.html">Admin Leaves</a></li>
										<li><a href="leaves-employee.html">Employee Leaves</a></li>
										<li><a href="leave-types.html">Leave Types</a></li>
									</ul>
								</li>
								<li><a href="holidays.html"><i class="ti ti-calendar-share fs-16 me-2"></i><span>Holidays</span></a>
								</li>
								<li class="submenu">
									<a href="employee-salary.html"><i class="ti ti-file-dollar fs-16 me-2"></i><span>Payroll</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="employee-salary.html">Employee Salary</a></li>
										<li><a href="payslip.html">Payslip</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Reports</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-chart-bar fs-16 me-2"></i><span>Sales Report</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="sales-report.html">Sales Report</a></li>
										<li><a href="best-seller.html">Best Seller</a></li>
									</ul>
								</li>
								<li><a href="purchase-report.html"><i class="ti ti-chart-pie-2 fs-16 me-2"></i><span>Purchase report</span></a></li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-triangle-inverted fs-16 me-2"></i><span>Inventory Report</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="inventory-report.html">Inventory Report</a></li>
										<li><a href="stock-history.html">Stock History</a></li>
										<li><a href="sold-stock.html">Sold Stock</a></li>
									</ul>
								</li>
								<li><a href="invoice-report.html"><i class="ti ti-businessplan fs-16 me-2"></i><span>Invoice Report</span></a></li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-user-star fs-16 me-2"></i><span>Supplier Report</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="supplier-report.html">Supplier Report</a></li>
										<li><a href="supplier-due-report.html">Supplier Due Report</a></li>
									</ul>
								</li>
								<li><a href="expense-report.html"><i class="ti ti-file-vector fs-16 me-2"></i><span>Expense Report</span></a></li>
								<li><a href="income-report.html"><i class="ti ti-chart-ppf fs-16 me-2"></i><span>Income Report</span></a></li>
							</ul>
						</li>

						<li class="submenu-open">
							<h6 class="submenu-hdr">User Management</h6>
							<ul>
								<li><a href="users.html"><i class="ti ti-shield-up fs-16 me-2"></i><span>Users</span></a></li>
								<li><a href="roles-permissions.html"><i class="ti ti-jump-rope fs-16 me-2"></i><span>Roles & Permissions</span></a></li>
								<li><a href="delete-account.html"><i class="ti ti-trash-x fs-16 me-2"></i><span>Delete Account Request</span></a></li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Settings</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-settings fs-16 me-2"></i><span>General Settings</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="general-settings.html">Profile</a></li>
										<li><a href="security-settings.html">Security</a></li>
										<li><a href="notification.html">Notifications</a></li>
										<li><a href="connected-apps.html">Connected Apps</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-world fs-16 me-2"></i><span>Website Settings</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="system-settings.html">System Settings</a></li>
										<li><a href="company-settings.html">Company Settings </a></li>
										<li><a href="localization-settings.html">Localization</a></li>
										<li><a href="prefixes.html">Prefixes</a></li>
										<li><a href="preference.html">Preference</a></li>
										<li><a href="appearance.html">Appearance</a></li>
										<li><a href="social-authentication.html">Social Authentication</a></li>
										<li><a href="language-settings.html">Language</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="ti ti-device-mobile fs-16 me-2"></i>
										<span>App Settings</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li class="submenu submenu-two"><a href="javascript:void(0);">Invoice<span class="menu-arrow inside-submenu"></span></a>
											<ul>
												<li><a href="invoice-settings.html">Invoice Settings</a></li>
												<li><a href="invoice-template.html">Invoice Template</a></li>
											</ul>
										</li>
										<li><a href="printer-settings.html">Printer</a></li>
										<li><a href="pos-settings.html">POS</a></li>
										<li><a href="custom-fields.html">Custom Fields</a></li>
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