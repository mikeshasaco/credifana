@extends('layouts.app')

@section('content')

    <section class="contact-hero-section">
        <div class="container-lg">
            <div class="hero-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div name="termly-embed" data-id="247b89d5-c67b-4ce5-be5e-538aa9ee79a9" data-type="iframe"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript">
        (function(d, s, id) {
        var js, tjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://app.termly.io/embed-policy.min.js";
        tjs.parentNode.insertBefore(js, tjs);
        }(document, 'script', 'termly-jssdk'));
    </script>
@endsection