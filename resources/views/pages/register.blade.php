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
                            @if ( Session::has('errors'))
                                <?php $errors = Session::get('errors'); ?>
                            @endif
                            <div class="text-center">
                                <h3 class="mb-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="60" width="60" fill="#2e2e2e"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg></h3>
                                <h2 class="text-center mb-2">Register</h2>
                                <p>Please create your account in seconds!.</p>
                                <div class="panel-body mt-4">
                                    <form id="register_form" action="{{ route('signup') }}" role="form" autocomplete="off" class="form" method="post">
                                        <div class="form-group mb-2">
                                            @csrf
                                            <div class="input-group d-flex gap-2">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <svg height="25" width="25" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    viewBox="0 0 60.671 60.671" xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <ellipse style="fill:#010002;" cx="30.336" cy="12.097" rx="11.997" ry="12.097"/>
                                                                <path style="fill:#010002;" d="M35.64,30.079H25.031c-7.021,0-12.714,5.739-12.714,12.821v17.771h36.037V42.9
                                                                    C48.354,35.818,42.661,30.079,35.64,30.079z"/>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                                <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <svg height="25" width="25" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    viewBox="0 0 60.671 60.671" xml:space="preserve">
                                                        <g>
                                                            <g>
                                                                <ellipse style="fill:#010002;" cx="30.336" cy="12.097" rx="11.997" ry="12.097"/>
                                                                <path style="fill:#010002;" d="M35.64,30.079H25.031c-7.021,0-12.714,5.739-12.714,12.821v17.771h36.037V42.9
                                                                    C48.354,35.818,42.661,30.079,35.64,30.079z"/>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                                <input type="text" class="form-control" id="registerFnamelname" placeholder="Last Name" name="lname">
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="input-group">
                                                <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25" width="25" fill="#2e2e2e"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></span>
                                                <input type="email" class="form-control" required id="email" placeholder="Email Address" name="email">
                                            </div>
                                            <div class="text-danger my-1" style="text-align: left!important;">{{$errors->first('email')}}</div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25" width="25" fill="#2e2e2e"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"></path></svg>
                                                </span>
                                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                            </div>
                                            <div class="text-danger my-1" style="text-align: left!important;">{{$errors->first('password')}}</div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25" width="25" fill="#2e2e2e"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"></path></svg>
                                                </span>
                                                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="password_confirmation">
                                            </div>
                                            <div class="text-danger my-1" style="text-align: left!important;">{{$errors->first('password_confirmation')}}</div>
                                        </div>
                                        <div class="form-group">
                                            <input name="register" class="btn btn-lg btn-primary btn-block w-100" value="Register" type="submit">
                                        </div>
                                    </form>
                                    <div class="loginFormLink mt-1">
                                        <div class="text">Already have an account? <a href="{{ route('login') }}" class="loginLink">Login Now</a></div>
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