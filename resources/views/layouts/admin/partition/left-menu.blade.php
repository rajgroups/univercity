		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- Logo -->
			<div class="sidebar-logo active">
				<a href="/" class="logo logo-normal">
					<img src="{{ asset('resource/admin/assets/img/logo.svg') }}" alt="Img">
				</a>
				<a href="/" class="logo logo-white">
					<img src="{{ asset('resource/admin/assets/img/logo-white.svg') }}" alt="Img">
				</a>
				<a href="/" class="logo-small">
					<img src="{{ asset('resource/admin/assets/img/logo-small.png')}}" alt="Img">
				</a>
				<a id="toggle_btn" href="javascript:void(0);">
					<i data-feather="chevrons-left" class="feather-16"></i>
				</a>
			</div>
			<!-- /Logo -->
			<div class="modern-profile p-3 pb-0">
				<div class="text-center rounded bg-light p-3 mb-4 user-profile">
					<div class="avatar avatar-lg online mb-3">
						<img src="{{ asset('resource/admin/assets/img/customer/customer15.jpg')}}" alt="Img" class="img-fluid rounded-circle">
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
						<img src="{{ asset('resource/admin/assets/img/customer/customer15.jpg')}}" alt="Img" class="img-fluid rounded-circle">
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
					{{-- <div>
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
					</div> --}}
				</div>
			</div>
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
                        						<li class="submenu-open">
							<h6 class="submenu-hdr">Inventory</h6>
							<ul>
								<li><a href="{{ route('admin.category.index') }}"><i class="ti ti-eraser fs-16 me-2"></i><span>Category</span></a></li>
                                <li><a href="{{ route('admin.sectors.index') }}"><i class="ti ti-list-details fs-16 me-2"></i><span>Sector</span></a></li>
								<li><a href="{{ route('admin.project.index') }}"><i data-feather="box"></i><span>Project</span></a></li>
								<li><a href="{{ route('admin.banner.index') }}"><i class="ti ti-table-plus fs-16 me-2"></i><span>Banner</span></a></li>
								<li><a href="{{ route('admin.announcement.index') }}"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Announcement </span></a></li>
								<li><a href="{{ route('admin.setting.home.edit') }}"><i class="ti ti-settings fs-16 me-2"></i><span>Setting </span></a></li>
								{{--
								<li><a href="category-list.html"><i class="ti ti-list-details fs-16 me-2"></i><span>Category</span></a></li>
								<li><a href="sub-categories.html"><i class="ti ti-carousel-vertical fs-16 me-2"></i><span>Sub Category</span></a></li>
								<li><a href="brand-list.html"><i class="ti ti-triangles fs-16 me-2"></i><span>Brands</span></a></li>
								<li><a href="units.html"><i class="ti ti-brand-unity fs-16 me-2"></i><span>Units</span></a></li>
								<li><a href="varriant-attributes.html"><i class="ti ti-checklist fs-16 me-2"></i><span>Variant Attributes</span></a></li>
								<li><a href="warranty.html"><i class="ti ti-certificate fs-16 me-2"></i><span>Warranties</span></a></li>
								<li><a href="barcode.html"><i class="ti ti-barcode fs-16 me-2"></i><span>Print Barcode</span></a></li>
								<li><a href="qrcode.html"><i class="ti ti-qrcode fs-16 me-2"></i><span>Print QR Code</span></a></li> --}}
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Main</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);" class="subdrop active"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span></a>
								</li>
							</ul>
						</li>
                        <li class="submenu-open">
							<h6 class="submenu-hdr">Sector</h6>
							<ul>

							</ul>
						</li>

						{{-- <li class="submenu-open">
							<h6 class="submenu-hdr">Sales</h6>
							<ul>
								<li class="submenu">
									<a href="{{ route('pos.index') }}"><i class="ti ti-device-laptop fs-16 me-2"></i><span>POS</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('pos.index') }}">POS 4</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu-open">
							<h6 class="submenu-hdr">Peoples</h6>
							<ul>
								<li><a href="{{route('customers.index')}}"><i class="ti ti-users-group fs-16 me-2"></i><span>Customers</span></a></li>
								<li><a href="{{route('stores.index')}}"><i class="ti ti-home-bolt fs-16 me-2"></i><span>Stores</span></a></li>
								</li>
							</ul>
						</li> --}}


						{{-- <li class="submenu-open">
							<h6 class="submenu-hdr">Settings</h6>
							<ul>
                                <form id="logout-form-second" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-second').submit();"><i class="ti ti-logout fs-16 me-2"></i><span>Logout</span> </a>
								</li>
							</ul>
						</li> --}}
                        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-second').submit();" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa fa-power-off"></i></span>
                            <span class="nk-menu-text">Logout</span>
                        </a> --}}
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->
