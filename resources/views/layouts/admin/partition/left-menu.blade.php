		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- Logo -->
			<div class="sidebar-logo active">
				<a href="/" class="logo logo-normal">
					<img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt="Img">
				</a>
				<a href="/" class="logo logo-white">
					<img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt="Img">
				</a>
				<a href="/" class="logo-small">
					<img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt="Img">
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
					{{-- <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent" role="tablist">
						<li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
						<li class="nav-item"><a class="nav-link border-0" href="chat.html">Chats</a></li>
						<li class="nav-item"><a class="nav-link border-0" href="email.html">Inbox</a></li>
					</ul> --}}
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
							<h6 class="submenu-hdr">Main</h6>
							<ul>
								<li class="submenu">
									<a href="{{route('admin.home')}}" class="subdrop active"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span></a>
								</li>
							</ul>
						</li>
                        
                       <li class="submenu-open">
							<h6 class="submenu-hdr">Inventory</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);" class=""><i class="ti ti-eraser fs-16 me-2"></i><span>Category</span><span class="menu-arrow"></span></a>
									<ul style="display: none;">
										<li><a href="{{ route('admin.category.index') }}">Category List</a></li>
										<li><a href="{{ route('admin.category.create') }}">Add Category</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);" class=""><i class="ti ti-world fs-16 me-2"></i><span>Sector</span><span class="menu-arrow"></span></a>
									<ul style="display: none;">
										<li><a href="{{ route('admin.sectors.index') }}">Sector List</a></li>
										<li><a href="{{ route('admin.sectors.create') }}">Add Sector</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);" class=""><i class="ti ti-list-details fs-16 me-2"></i><span>Course</span><span class="menu-arrow"></span></a>
									<ul style="display: none;">
										<li><a href="{{ route('admin.course.index') }}">Course List</a></li>
										<li><a href="{{ route('admin.course.create') }}">Add Course</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);" class=""><i data-feather="box"></i><span>Project</span><span class="menu-arrow"></span></a>
									<ul style="display: none;">
										<li><a href="{{ route('admin.project.index') }}">Project List</a></li>
										<li><a href="{{ route('admin.project.create') }}">Add Project</a></li>
									</ul>
								</li>
							</ul>
						</li>
                        <li class="submenu-open">
                            <li class="submenu">
                                <a href="javascript:void(0);" class=""><i class="ti ti-table-plus fs-16 me-2"></i><span>Blog</span><span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{ route('admin.blog.index') }}">Blog List</a></li>
                                    <li><a href="{{ route('admin.blog.create') }}">Add Blog</a></li>
                                </ul>
                            </li>
						</li>

                       <li class="submenu-open">
							<h6 class="submenu-hdr">Settings</h6>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);" class=""><i class="ti ti-settings fs-16 me-2"></i><span>General Settings</span></a>
									<ul style="display: none;">
										<li><a href="{{ route('admin.setting.general.edit') }}">General Settings</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);" class=""><i class="ti ti-world fs-16 me-2"></i><span>Website Settings</span></a>
									<ul style="display: none;">
										<li><a href="{{ route('admin.setting.home.edit') }}">Website Settings</a></li>
									</ul>
								</li>
                                {{-- <li><a href="{{ route('admin.banner.index') }}"><i class="ti ti-table-plus fs-16 me-2"></i><span>Banner</span></a></li>
								<li><a href="{{ route('admin.announcement.index') }}"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Announcement </span></a></li> --}}
								<li class="submenu">
									<a href="{{ route('admin.banner.index') }}"><i class="ti ti-device-mobile fs-16 me-2"></i>
										<span>Banner</span>
									</a>
								</li>
								<li class="submenu">
									<a href="{{ route('admin.announcement.index') }}"><i class="ti ti-device-desktop fs-16 me-2"></i>
										<span>Announcement</span>
									</a>
								</li>
								{{-- <li class="submenu">
									<a href="javascript:void(0);" class=""><i class="ti ti-settings-2 fs-16 me-2"></i>
										<span>Other Settings</span><span class="menu-arrow"></span>
									</a>
									<ul style="display: none;">
										<li><a href="storage-settings.html">Storage</a></li>
									</ul>
								</li> --}}
								<li>
									<a href="#"><i class="ti ti-logout fs-16 me-2"></i><span>Logout</span> </a>
								</li>
							</ul>
						</li>
						{{-- <li class="submenu-open">
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