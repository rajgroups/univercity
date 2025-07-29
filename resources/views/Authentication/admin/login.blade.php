<!DOCTYPE html>
<html lang="en">

<head>

		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="pos Admin">
		<meta name="robots" content="index, follow">
		<title> {{ asset($defaultSettings->site_title ?? null)}} - Login</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset($defaultSettings->favicon ?? null)}}">

		<!-- Apple Touch Icon -->
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset($defaultSettings->favicon ?? null)}}">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('resource/admin/assets/css/bootstrap.min.css')}}">

        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('resource/admin/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('resource/admin/assets/plugins/fontawesome/css/all.min.css')}}">

        <!-- Tabler Icon CSS -->
	    <link rel="stylesheet" href="{{asset('resource/admin/assets/plugins/tabler-icons/tabler-icons.min.css')}}">

	    <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('resource/admin/assets/css/style.css')}}">

    </head>
    <body class="account-page">

        {{-- <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div> --}}

		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper bg-img">
                    <div class="login-content authent-content">
                            <div class="login-userset">
                                <div class="login-logo logo-normal">
                                   <img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt="img">
                               </div>
                               <a href="/" class="login-logo logo-white">
                                   <img src="{{ asset($defaultSettings->site_logo ?? null)}}"  alt="Img">
                               </a>
                               <div class="login-userheading">
                                   <h3>Sign In</h3>
                                   <h4 class="fs-16">Access the ISICO panel using your email and passcode.</h4>
                               </div>
                                  {{-- Error Handling --}}
                                  @if (session('success'))
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      <strong>Success!</strong> {{ session('success') }}
                                  </div>
                                  @endif

                                  @if (session('error'))
                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      <strong>Sorry!</strong> {{ session('error') }}
                                  </div>
                                  @endif
                                 @if ($errors->any())
                                     <div class="alert alert-danger" role="alert">
                                         <ul>
                                             @foreach ($errors->all() as $error)
                                                 <li>{{ $error }}</li>
                                                 @endforeach

                                         </ul>
                                     </div>
                                 @enderror
                                 <form method="POST" action="{{ route('admin.login') }}">
                                    @csrf
                                    @method('post')
                                    <div class="mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="email" class="form-control border-end-0 @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required autofocus>
                                            <span class="input-group-text border-start-0">
                                                <i class="ti ti-mail"></i>
                                            </span>
                                        </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-input form-control @error('password') is-invalid @enderror"
                                                   name="password" required>
                                            <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                        </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>

                                    <div class="form-login authentication-check">
                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center justify-content-between">
                                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1 fs-16 text-gray-6">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="checkmarks"></span>{{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-login">
                                        <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                                    </div>
                                </form>

                               {{-- <div class="signinform">
                                   <h4>New on our platform?<a href="register.html" class="hover-a"> Create an account</a></h4>
                               </div>
                               <div class="form-setlogin or-text">
                                   <h4>OR</h4>
                               </div> --}}
                               <div class="mt-2">
                                   <div class="d-flex align-items-center justify-content-center flex-wrap">
                                       <div class="text-center me-2 flex-fill">
                                           <a href="javascript:void(0);"
                                               class="br-10 p-2 btn btn-info d-flex align-items-center justify-content-center">
                                               <img class="img-fluid m-1" src="{{asset('resource/admin/assets/img/icons/facebook-logo.svg')}}" alt="Facebook">
                                           </a>
                                       </div>
                                       <div class="text-center me-2 flex-fill">
                                           <a href="javascript:void(0);"
                                               class="btn btn-white br-10 p-2  border d-flex align-items-center justify-content-center">
                                               <img class="img-fluid m-1" src="{{asset('resource/admin/assets/img/icons/google-logo.svg')}}" alt="Facebook">
                                           </a>
                                       </div>
                                       <div class="text-center flex-fill">
                                           <a href="javascript:void(0);"
                                               class="bg-dark br-10 p-2 btn btn-dark d-flex align-items-center justify-content-center">
                                               <img class="img-fluid m-1" src="{{asset('resource/admin/assets/img/icons/apple-logo.svg')}}" alt="Apple">
                                           </a>
                                       </div>
                                   </div>
                               </div>
                               <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                <p>{{ $defaultSettings->footer_copyright ?? null}}</p>
                            </div>
                           </div>

                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->


		<!-- jQuery -->
        <script src="{{asset('resource/admin/assets/js/jquery-3.7.1.min.js')}}" type="87bbc8871509f695afd56eb4-text/javascript"></script>

         <!-- Feather Icon JS -->
		<script src="{{asset('resource/admin/assets/js/feather.min.js')}}" type="87bbc8871509f695afd56eb4-text/javascript"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset('resource/admin/assets/js/bootstrap.bundle.min.js')}}" type="87bbc8871509f695afd56eb4-text/javascript"></script>

		<!-- Custom JS -->
        <script src="{{asset('resource/admin/assets/js/script.js')}}" type="87bbc8871509f695afd56eb4-text/javascript"></script>

    <script src="{{asset('resource/admin/assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="87bbc8871509f695afd56eb4-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"956d71855f217ebb","version":"2025.6.2","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"3ca157e612a14eccbb30cf6db6691c29","b":1}' crossorigin="anonymous"></script>
</body>


</html>
