@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body mt-5">
            <div class="row" style=" margin-top: 79px; ">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ __('messages.Change_Password') }}</h4>
                            <div class="page-title-right mb-4">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Password</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        @if (Session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                                <strong>{{ Session('error') }}</strong>
                            </div>
                        @endif
                        @if (Session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                                <strong>{{ Session('success') }}</strong>
                            </div>
                        @endif
                        <form class="needs-validation" method="POST" novalidate="" action="{{ route('admin.password.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="validationCustom01">{{ __('messages.old_password') }}</label>
                                        <input type="password" name="current_password" id="current_password" placeholder="*********" class="form-control" required="">
                                        <div class="valid-feedback"> Looks good! </div>
                                        @if ($errors->has('old_password'))
                                            <div class="invalid-feedback"> {{ $errors->first('old_password') }} </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="validationCustom02">{{ __('messages.new_password') }}</label>
                                        <input type="password" class="form-control" id="new_password" placeholder="*********" name="new_password" required="">
                                        <div class="valid-feedback"> Looks good! </div>
                                        @if ($errors->has('new_password'))
                                            <div class="invalid-feedback"> {{ $errors->first('new_password_confirmation') }} </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom02">{{ __('messages.confirm_password') }}</label>
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="*********" class="form-control" required="">
                                        <div class="valid-feedback"> Looks good! </div>
                                        @if ($errors->has('new_password_confirmation'))
                                            <div class="invalid-feedback"> {{ $errors->first('new_password_confirmation') }} </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
