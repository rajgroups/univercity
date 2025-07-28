		<!-- Horizontal Sidebar -->
		<div class="sidebar sidebar-horizontal" id="horizontal-menu">
			<div id="sidebar-menu-3" class="sidebar-menu">
				<div class="main-menu">
					<ul class="nav-menu">
						<li class="submenu">
							<a href="#"><i class="ti ti-layout-grid fs-16 me-2"></i><span> Main Menu</span></a>

						</li>
						<li class="submenu">
							<a href="javascript:void(0);"><i class="ti ti-brand-unity fs-16 me-2"></i><span> Inventory
								</span> <span class="menu-arrow"></span></a>
							<ul>
								{{-- <li><a href="{{ route('category.index') }}"><i class="ti ti-list-details fs-16 me-2"></i><span>Category</span></a></li>
								<li><a href="{{route('subcategory.index')}}"><i class="ti ti-carousel-vertical fs-16 me-2"></i><span>Sub Category</span></a></li>
								<li><a href="{{route('products.create')}}"><i class="ti ti-table-plus fs-16 me-2"></i><span>Create Product</span></a></li>
								<li><a href="{{route('products.index')}}"><i data-feather="box"></i><span>Products</span></a></li> --}}

								<!-- <li><a href="expired-products.html"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Expired Products</span></a></li> -->
								{{-- <li><a href="low-stocks.html"><i class="ti ti-trending-up-2 fs-16 me-2"></i><span>Low Stocks</span></a></li> --}}
								{{-- <li><a href="{{route('units.index')}}"><i class="ti ti-brand-unity fs-16 me-2"></i><span>Units</span></a></li> --}}
							</ul>
						</li>

						<li class="submenu">
							<a href="javascript:void(0);"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Sales &amp; Purchase</span> <span class="menu-arrow"></span></a>
							<ul>
								{{-- <li class="submenu">
									<a href="{{ route('pos.index') }}"><i class="ti ti-device-laptop fs-16 me-2"></i><span>POS</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('pos.index') }}">POS 4</a></li>
									</ul>
								</li> --}}
							</ul>
						</li>

						<li class="submenu">
							{{-- <a href="{{route('order.index')}}"><i class="ti ti-user-edit fs-16 me-2"></i><span>Orders</span><span class="menu-arrow"></span></a> --}}
						</li>
						<li class="submenu">
							<a href="javascript:void(0);"><i class="ti ti-circle-plus fs-16 me-2"></i><span>User Management</span><span class="menu-arrow"></span></a>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"><span>People</span><span class="menu-arrow"></span></a>
									{{-- <ul>
										<li><a href="{{route('customers.index')}}"><span>Customers</span></a></li>
										<li><a href="{{route('stores.index')}}"><span>Stores</span></a></li>
										</li>
									</ul> --}}
								</li>

							</ul>
						</li>

						<li class="submenu">
							<a href="javascript:void(0);"><i class="ti ti-settings fs-16 me-2"></i><span>Settings</span><span class="menu-arrow"></span></a>
							{{-- <ul>
								<form id="logout-form-second" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-second').submit();"><i class="ti ti-logout fs-16 me-2"></i><span>Logout</span> </a>
								</li>
							</ul> --}}
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Horizontal Sidebar -->

		<!-- Two Col Sidebar -->
		<div class="two-col-sidebar" id="two-col-sidebar">
			<div class="sidebar sidebar-twocol">
				{{-- <div class="twocol-mini">
					<div class="sidebar-left slimscroll">
						<div class="nav flex-column align-items-center nav-pills" id="sidebar-tabs" role="tablist"
							aria-orientation="vertical">
							<a href="#" class="nav-link active" title="Dashboard" data-bs-toggle="tab" data-bs-target="#dashboard">
								<i class="ti ti-smart-home"></i>
							</a>
							<a href="#" class="nav-link " title="Super Admin" data-bs-toggle="tab" data-bs-target="#super-admin">
								<i class="ti ti-user-star"></i>
							</a>
							<a href="#" class="nav-link " title="Apps" data-bs-toggle="tab" data-bs-target="#application">
								<i class="ti ti-layout-grid-add"></i>
							</a>
							<a href="#" class="nav-link" title="Layout" data-bs-toggle="tab" data-bs-target="#layout">
								<i class="ti ti-layout-board-split"></i>
							</a>
							<a href="#" class="nav-link" title="Inventory" data-bs-toggle="tab" data-bs-target="#inventory">
								<i class="ti ti-table-plus"></i>
							</a>
							<a href="#" class="nav-link" title="Stock" data-bs-toggle="tab" data-bs-target="#stock">
								<i class="ti ti-stack-3"></i>
							</a>
							<a href="#" class="nav-link" title="Sales" data-bs-toggle="tab" data-bs-target="#sales">
								<i class="ti ti-device-laptop"></i>
							</a>
							<a href="#" class="nav-link" title="Finance" data-bs-toggle="tab" data-bs-target="#finance">
								<i class="ti ti-shopping-cart-dollar"></i>
							</a>
							<a href="#" class="nav-link" title="Hrm" data-bs-toggle="tab" data-bs-target="#hrm">
								<i class="ti ti-cash"></i>
							</a>
							<a href="#" class="nav-link" title="Reports" data-bs-toggle="tab" data-bs-target="#reports">
								<i class="ti ti-license"></i>
							</a>
							<a href="#" class="nav-link" title="Pages" data-bs-toggle="tab" data-bs-target="#pages">
								<i class="ti ti-page-break"></i>
							</a>
							<a href="#" class="nav-link" title="Settings" data-bs-toggle="tab" data-bs-target="#settings">
								<i class="ti ti-lock-check"></i>
							</a>
							<a href="#" class="nav-link " title="UI Elements" data-bs-toggle="tab" data-bs-target="#ui-elements">
								<i class="ti ti-ux-circle"></i>
							</a>
							<a href="#" class="nav-link" title="Extras" data-bs-toggle="tab" data-bs-target="#extras">
								<i class="ti ti-vector-triangle"></i>
							</a>
						</div>
					</div>
				</div> --}}
				<div class="sidebar-right">
					<!-- Logo -->
					<div class="sidebar-logo">
						<a href="/" class="logo logo-normal">
							<img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt="Img">
						</a>
						<a href="/" class="logo logo-white">
							<img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt="Img">
							{{-- <img src="{{ asset('resource/admin/assets/img/logo-white.svg')}}" alt="Img"> --}}
						</a>
						<a href="/" class="logo-small">
							<img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt="Img">
						</a>
					</div>
					<!-- /Logo -->
					<div class="sidebar-scroll">
						<div class="text-center rounded bg-light p-3 mb-3 border">
							<div class="avatar avatar-lg online mb-3">
								<img src="{{ asset('resource/admin/assets/img/customer/customer15.jpg')}}" alt="Img" class="img-fluid rounded-circle">
							</div>
							<h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
							<p class="fs-12 mb-0">System Admin</p>
						</div>
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="dashboard">
								<ul>
									<li class="menu-title"><span>MAIN</span></li>
									<li><a href="/" class="active">Admin Dashboard</a></li>
								</ul>
							</div>
							<div class="tab-pane fade" id="inventory">
								<ul>
									{{-- <li><a href="{{ route('category.index') }}"><i class="ti ti-list-details fs-16 me-2"></i><span>Category</span></a></li>
								<li><a href="{{route('subcategory.index')}}"><i class="ti ti-carousel-vertical fs-16 me-2"></i><span>Sub Category</span></a></li>
								<li><a href="{{route('products.create')}}"><i class="ti ti-table-plus fs-16 me-2"></i><span>Create Product</span></a></li>
								<li><a href="{{route('products.index')}}"><i data-feather="box"></i><span>Products</span></a></li> --}}
								<!-- <li><a href="expired-products.html"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Expired Products</span></a></li> -->
								{{-- <li><a href="low-stocks.html"><i class="ti ti-trending-up-2 fs-16 me-2"></i><span>Low Stocks</span></a></li> --}}
								{{-- <li><a href="{{route('units.index')}}"><i class="ti ti-brand-unity fs-16 me-2"></i><span>Units</span></a></li> --}}
								</ul>
							</div>
							<div class="tab-pane fade" id="sales">
								{{-- <ul>
									<li class="menu-title"><span>Sales</span></li>
									<li><a href="{{ route('pos.index') }}"><span>POS</span></a></li>
								</ul> --}}
							</div>

							<li class="submenu">
								{{-- <a href="{{route('order.index')}}"><i class="ti ti-user-edit fs-16 me-2"></i><span>Orders</span><span class="menu-arrow"></span></a> --}}
							</li>
							<div class="tab-pane fade" id="finance">
								{{-- <ul>
									<li><a href="{{route('customers.index')}}"><span>Customers</span></a></li>
									<li><a href="{{route('stores.index')}}"><span>Stores</span></a></li>
								</ul> --}}
							</div>

							<div class="tab-pane fade" id="settings">
								{{-- <ul>
									<li class="menu-title"><span>Settings</span></li>
									<form id="logout-form-second" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-second').submit();"><i class="ti ti-logout fs-16 me-2"></i><span>Logout</span> </a>
									</li>
								</ul> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Two Col Sidebar -->
