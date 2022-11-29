@extends('layouts.app')

@section('content')
@section('content')

    <section class="contact-hero-section">
        <div class="container-lg">
            <div class="hero-wrapper">
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <div class="right-block">
                            <div class="contact-form">
                                <div class="form-heading">
                                    <h2>forgot password</h2>
                                </div>
                                <form action="" id="forgot_password_form" method="POST">
                                    @csrf
                                    <div class="form-group mode-form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email" required />
                                        <label for="user_name">Email</label>
                                        <div class="error-message"></div>
                                    </div>
                                    
                                    <div class="send-btn d-flex align-items-center">
                                        <button class="btn std-btn-full" type="submit" name="submit_contact_form" value="submit_contact_form">
                                            <span class="text">Send</span>
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="1166 768 24 24"><path d="m1188.314 768.151-21.728 12.532a1.125 1.125 0 0 0 .103 2.025l4.983 2.09 13.469-11.866c.257-.23.623.122.403.389l-11.294 13.755v3.772c0 1.106 1.336 1.542 1.993.74l2.977-3.622 5.84 2.447a1.128 1.128 0 0 0 1.548-.853l3.375-20.246c.16-.947-.858-1.631-1.669-1.163Z" fill="#fff" fill-rule="evenodd" data-name="Icon awesome-paper-plane"/></svg>
                                            </span>
                                        </button>
                                        <div class="submit-loader ms-3 d-none">
                                            <div class="spinner-border text-primary align-middle"></div>
                                        </div>
                                    </div>

                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          <h3><i class="fa fa-lock fa-4x"></i></h3>
                          <h2 class="text-center">Forgot Password?</h2>
                          <p>You can reset your password here.</p>
                            <div class="panel-body">
                              
                              <form class="form">
                                <fieldset>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                      
                                      <input id="emailInput" placeholder="email address" class="form-control" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <input class="btn btn-lg btn-primary btn-block" value="Send My Password" type="submit">
                                  </div>
                                </fieldset>
                              </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@endsection