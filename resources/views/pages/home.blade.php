@extends('layouts.app')

@section('content')
    
    <section class="hero-container">
        <div class="container-lg">
            <div class="hero-wrapper">
                <div class="row align-items-end">
                    <div class="col-md-6 order-md-1 order-2">
                        <div class="left-block">
                            <div class="hero-content">
                                <h2>  
                                    <span class="line-break"> Automation <span class="green bold special-text">tool </span>  </span>
                                    <span class="line-break"> for <span class="orange bold special-text"> properties   </span> </span>
                                    <span class="line-break">investments  <span class="primary bold special-text"> & analysis</span> </span>
                                </h2>
                                <div class="hero-btn">
                                    <a href="#" class="btn btn-outline-primary download-btn std-btn">Download now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 order-md-2 order-1">
                        <div class="right-block">
                            <div class="hero-image">
                                <img src="{{ asset('images/main-hero.png') }}" alt="Hero image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="intro-section">
        <div class="container-lg">
            <div class="intro-wrapper">
                <div class="intro-que">
                    <div class="heading">
                     <center><h2>Credifana is an automation tool that integrates with popular real estate websites to provide real time investments analysis to help find quality investment properties. </h2></center>   
                    </div>
                </div>
                <!-- <div class="intro-ans content">
                    <p>
                        Credifana is a google chrome extension that allows you to search real estate properties from top websites, to calulate monthly and yearly revenue with a click of a button.
                    </p>
                </div> -->
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="container-lg">
            <div class="process-wrapper">
                <div class="heading">
                    <h2>Credifana helps potential property buyers, learn the numbers before purchasing investment properties.</h2>
                </div>
                <div class="process-steps">
                    <div class="step">
                        <div class="step-wrapper">
                            <div class="row">
                                <div class="col-md-6 order-1 order-md-1">
                                    <div class="left-block">
                                        <div class="heading">
                                            <h3>
                                            How Credifana Works
                                            </h3>
                                        </div>
                                        <div class="content">
                                            <!-- <p>Download Credifana Extension</p>
                                            <p>Browse realtor websites thats intergated with Credifana. (realtor.com) </p>
                                            <p>Select any property that your interested</p>
                                            <p>Open the Credifana extension and click evaluate!</p>
                                            <p>Credifana will then automate</p> -->

                                            <p>Credifana integrates with popular realtor websites that allow users to browse properties, analysis property metrics in real-time without having to change tabs. Credifana automation tool will determine property estimated gross revenue monthly/yearly, net operator cost for that individual property and many more to help with the property evaluation process.   </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 order-2 order-md-2">
                                    <div class="right-block">
                                        <div class="image">
                                            <img src="{{ asset('images/dummy.png') }}" alt="Dummy image" width="440px" height="440px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-wrapper">
                            <div class="row">
                                <div class="col-md-6 order-2 order-md-1">
                                    <div class="left-block">
                                        <div class="image">
                                            <img src="{{ asset('images/dummy.png') }}" alt="Dummy image" width="440px" height="440px" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 order-1 order-md-2">
                                    <div class="right-block">
                                        <div class="heading">
                                            <h3>Benefits using Credifana</h3>
                                        </div>
                                        <div class="content">
                                            <p>Average Rent - Credifana pulls rent analytics from all accross the country to give the most accurate rent price.   </p>
                                            <p>Gross Revenue - Credifana calulates properties expenses and maintenance fees to give the most accurate results when determining annual income a property can generate.   </p>
                                            <p>Net Revenue  - Credifana calulates properties revenue after expenses are paid for in any location to give accurate results.   </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-wrapper">
                            <div class="row">
                                <div class="col-md-6 order-1 order-md-1">
                                    <div class="left-block">
                                        <div class="heading">
                                            <h3>Keep Track of property History</h3>
                                        </div>
                                        <div class="content">
                                            <p>Credifana saves a portifolo of every property search so keeping track of future investment is made easy.</p>
                                                
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 order-1 order-md-1">
                                    <div class="right-block">
                                        <div class="image">
                                            <img src="{{ asset('images/dummy.png') }}" alt="Dummy image" width="440px" height="440px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stores-section">
        <div class="container-lg">
            <div class="stores-list-wrapper">
                <div class="heading">
                    <h3>Keep track of property Searches</h3>
                </div>
                <div class="stores-list">
                    <div class="images">
                        <img src="{{ asset('images/stores/amazon.png') }}" alt="Amazon" width="200" height="100" />
                        <img src="{{ asset('images/stores/ebay.png') }}" alt="Ebay" width="200" height="100" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cc-repair-section">
        <div class="container">
            <div class="repair-container">
                <div class="heading">
                    <h2>Repair your Credit Card</h2>
                </div>
                <div class="content">
                    <p>
                        Credit is very important us and if you are interested in repairing your credit let us know we would be happy to help you
                    </p>
                </div>
                <div class="contact-btn">
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary std-btn-full">Contact us</a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('js/lib/gsap.min.js') }}"></script>
    <script src="{{ asset('js/lib/gsap.scrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/animation.js') }}"></script>
@endsection