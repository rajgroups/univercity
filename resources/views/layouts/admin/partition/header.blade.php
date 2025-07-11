		<!-- Header -->
		<div class="header">
			<div class="main-header">
				<!-- Logo -->
				<div class="header-left active">
					<a href="/" class="logo logo-normal">
						<img src="{{ asset('resource/admin/assets/img/logo.svg')}}" alt="Img">
					</a>
					<a href="/" class="logo logo-white">
						<img src="{{ asset('resource/admin/assets/img/logo-white.svg')}}" alt="Img">
					</a>
					<a href="/" class="logo-small">
						<img src="{{ asset('resource/admin/assets/img/logo-small.png')}}" alt="Img">
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
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
							</a>

						</div>
					</li>
					<!-- /Search -->



					<li class="nav-item dropdown link-nav">
						<a href="javascript:void(0);" class="btn btn-primary btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
							<i class="ti ti-circle-plus me-1"></i>Add New
						</a>
						<div class="dropdown-menu dropdown-xl dropdown-menu-center">
							<div class="row g-2">
								<div class="col-md-2">
									<a href="{{ route('category.index') }}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-brand-codepen"></i>
										</span>
										<p>Category</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="{{ route('pos.index') }}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-shopping-cart"></i>
										</span>
										<p>POS</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="{{route('products.index')}}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-square-plus"></i>
										</span>
										<p>Product</p>
									</a>
								</div>

								<div class="col-md-2">
									<a href="{{route('order.index')}}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-square-plus"></i>
										</span>
										<p>Order</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="{{route('customers.index')}}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-users"></i>
										</span>
										<p>Customer</p>
									</a>
								</div>
								<div class="col-md-2">
									<a href="{{route('stores.index')}}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-user-check"></i>
										</span>
										<p>Store</p>
									</a>
								</div>

							</div>
						</div>
					</li>

					<li class="nav-item pos-nav">
						<a href="{{ route('pos.index') }}" class="btn btn-dark btn-md d-inline-flex align-items-center">
							<i class="ti ti-device-laptop me-1"></i>POS
						</a>
					</li>

					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav nav-item-box">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"
							role="button">
							<img src="{{ asset('resource/admin/assets/img/flags/us-flag.svg')}}" alt="Language" class="img-fluid">
						</a>
						<!-- <div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/flags/english.svg" alt="Img" height="16">English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/flags/arabic.svg" alt="Img" height="16">Arabic
							</a>
						</div> -->
					</li>
					<!-- /Flag -->

					<li class="nav-item nav-item-box">
						<a href="javascript:void(0);" id="btnFullscreen">
							<i class="ti ti-maximize"></i>
						</a>
					</li>




					<li class="nav-item dropdown has-arrow main-drop profile-nav">
						<a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
							<span class="user-info p-0">
								<span class="user-letter">
									<img src="{{ asset('resource/admin/assets/img/profiles/avator1.jpg')}}" alt="Img" class="img-fluid">
								</span>
							</span>
						</a>
						<div class="dropdown-menu menu-drop-user">
							<div class="profileset d-flex align-items-center">
								<span class="user-img me-2">
									<img src="{{ asset('resource/admin/assets/img/profiles/avator1.jpg')}}" alt="Img">
								</span>
								<div>
									<h6 class="fw-medium">John Smilga</h6>
									<p>Admin</p>
								</div>
							</div>
							{{-- <a class="dropdown-item" href="profile.html"><i class="ti ti-user-circle me-2"></i>MyProfile</a>
							<a class="dropdown-item" href="sales-report.html"><i class="ti ti-file-text me-2"></i>Reports</a>
							<a class="dropdown-item" href="general-settings.html"><i class="ti ti-settings-2 me-2"></i>Settings</a>
							<hr class="my-2"> --}}
							
							<form id="logout-form-second" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
							<a class="dropdown-item logout pb-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-second').submit();"><i class="ti ti-logout me-2"></i>Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
						aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						{{-- <a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="general-settings.html">Settings</a> --}}
						<form id="logout-form-second" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-second').submit();">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
			</div>
		</div>
		<!-- /Header -->