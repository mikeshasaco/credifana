@extends('layouts.app')

@section('content')
@section('content')
    <section class="forgot_password_main_section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if ( Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ( Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="text-center">
                                <h3 class="mb-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="60" width="60" fill="#2e2e2e"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg></h3>
                                <h2 class="text-center mb-2">Login</h2>
                                <p>Please login to your account.</p>
                                <div class="panel-body mt-4">
                                    <form id="login-form" action="{{ route('log-in') }}" role="form" autocomplete="off" class="form" method="post">
                                        <div class="form-group mb-3">
                                            @csrf
                                            <div class="input-group mb-2">
                                                <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25" width="25" fill="#2e2e2e"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
                                                <input type="email" class="form-control" required id="loginEmail" placeholder="Email Address" name="email" value="azim@test.com">
                                            </div>

                                            <div class="input-group mb-2">
                                                <span class="input-group-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25" width="25" fill="#2e2e2e"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"></path></svg>
                                                </span>
                                                <input type="password" value="test123" class="form-control" id="password" autocomplete="true" placeholder="Password" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="login" class="btn btn-lg btn-primary btn-block w-100" value="Login" type="submit">
                                        </div>
                                    </form>
                                    <div class="registerFormLink mt-1">
                                        <div class="text">New here? <a href="{{ route('register') }}" class="registerLink">Register Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@endsection