<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental Property Calculator And Analysis | Credifana </title>
    <meta name="description" content="Credifana is a rental property browser extension that intergrates with popular realtor websites that calculates investment returns for single and multi unit properties.">
    <meta property="og:title" content="Rental Property Calculator And Analysis | Credifana">
    <meta property="og:description" content="Credifana is a rental property browser extension that intergrates with popular realtor websites that calculates investment returns for single and multi unit properties.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/favicon/android-icon-192x192.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}" />
    <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}" />
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NVBPE6Y89E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-NVBPE6Y89E');
</script>


<!-- Event snippet for Website sale conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-11093564458/6vGKCIqiv5EYEKq46akp',
      'transaction_id': ''
  });
</script>

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '846486693215673');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=846486693215673&ev=PageView&noscript=1"
        />
    </noscript>
<!-- End Meta Pixel Code -->
</head>
<body>

    @php 
        if (!isset($_COOKIE['UD'])) {
            if (Auth::user()) {
                Session::flush();
                Auth::logout();
            }
        }
    @endphp

    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script>
        let UD = "<?php echo isset($_COOKIE['UD']) ? $_COOKIE['UD'] : ''; ?>";
        let user = '<?php echo Auth::user(); ?>';
        if(document.readyState == 'loading' && user == ''){
            if (UD && UD != '') {
                UD = JSON.parse(atob(UD));
                $('.spinner-body').show();
                $('.body-wrapper').hide();
    
                $.ajax({
                    type: "post",
                    url: "{{ route('custom-login')}}",
                    data: {
                        userData: UD,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        response = JSON.parse(response);
                        if(response.status == 'success') {
                            $('.spinner-body').hide();
                            $('.body-wrapper').show();
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
    <div class="spinner-body" style="display: none;">
        <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
        </svg>
    </div>

    <div class="body-wrapper">
        <header>
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container-fluid mb-3">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="" width="38" height="38" class="d-inline-block align-text-top">
                        <h1>Credifana</h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            @if (Auth::user())
                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item" id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="outline: 0!important;">
                                    <img src="{{ asset('images/user-profile.png') }}" style="margin-top: -3px;" alt="User profile" width="25" height="25" class="d-inline-block align-text-top">
                                    <span class="d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->fname).' '.ucfirst(Auth::user()->lname) }}</span>
                                    <i class="fa fa-chevron-down d-xl-inline-block"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="right: -3px!important;">
                                    <!-- item-->
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        @lang('Profile')
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        @lang('Logout')
                                    </a>
                                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> --}}
                                </div>
                            </div>
                            @else
                                <li class="nav-item px-2">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                            <li class="nav-item px-2">
                                <a class="nav-link" href="{{ route('pricing') }}">Pricing</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                            </li>
                            <li class="nav-item px-2 btn-item">
                                <a class="nav-link btn" target="_blank" href="https://chrome.google.com/webstore/detail/credifana/fflmomjllcnfoegpmpfllcikpobkdmco">Click Here To Download</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="container">
                <div class="copyright">
                    <p>&copy; Copyright 2022 Credifana. All rights reserved</p>
                    <p><a href="{{ route('privacy-policy') }}">Privacy policy</a> | <a href="{{ route('terms-of-use') }}">Terms of use</a></p>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/lib/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>
</html>