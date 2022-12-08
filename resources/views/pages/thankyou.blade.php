@extends('layouts.app')

@section('content')

    <section class="contact-hero-section" style="height: calc(100vh - 161px);" >
        <div class="container-lg">
            <div class="hero-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="right-block">
                            <div class="top-content">
                                <div class="heading">
                                    <h1>Thank you!</h1>
                                </div>
                                <div class="content">
                                    <p>
                                        Your subscription will be start in 5 minutes. Thank you for join Credifana.
                                    </p>
                                </div>
                            </div>
                        </div>
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
@endsection