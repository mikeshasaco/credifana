@extends('layouts.app')

@section('content')

<section class="contact-hero-section d-block container-lg pt-0">
    <div class="">
        @if (Session::has('error'))
        <div class="alert alert-danger m-0">
            <i class="fas fa-check-circle text-success mr-2"></i> {{ Session::get('error') }}
        </div>
        @endif
    </div>    
    <div class="">
            <div class="hero-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="right-block">
                            <div class="top-content">
                                <div class="heading">
                                    <h1>Billing at Credifana</h1>
                                </div>
                                <div class="content">
                                    <p>
                                        We appreciate your interest in credifana. Have questions, Get in touch now!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="pricing-table-container">
        <div class="new_pricing_table_2020_12">
            <div class="pricing_table_container table_container">
                <table class="pricing_table_table">
                    <tbody>
                        <tr>
                            <td>
                                <div class="all_plans">
                                    <p><strong>On all plans</strong></p>
                                    <p><span class="general_check">✓ </span><span class="after_check">Upgrade
                                            anytime</span>
                                    </p>
                                    <p><span class="general_check">✓</span><span class="after_check">Downgrade
                                            anytime</span></p>
                                    <p><span class="general_check">✓</span><span class="after_check">Cancel
                                            anytime</span>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="plan_header">
                                    <div class="plan_name">Basic</div>
                                    <div class="plan_price">
                                        <div class="the_price_container"><span class="the_number">Free</span></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="plan_header">
                                    <div class="plan_name">Standard</div>
                                    <div class="plan_price" data-plan="Standard">
                                        <div class="the_price_container"><span class="the_dollar_sign">$</span><span
                                                class="the_number">{{ env("STANDARD_PLAN_PRICE") }}</span></div>
                                        <div class="price_per">USD / month</div>
                                    </div>
                                    <form action="{{ route('billing-checkout') }}" method="post" class="plan_cta">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email ?? '' }}">
                                        <button class="bigbutton small_block" name="selectedPlan"
                                            value="{{ env("STANDARD_PLAN_ID") }}">Get started</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="plan_header">
                                    <div class="plan_name">Premium</div>
                                    <div class="plan_price" data-plan="Premium">
                                        <div class="the_price_container"><span class="the_dollar_sign">$</span><span
                                                class="the_number">{{ env("PREMIUM_PLAN_PRICE") }}</span></div>
                                        <div class="price_per">USD / month</div>
                                    </div>
                                    <form action="{{ route('billing-checkout') }}" method="post" class="plan_cta">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email ?? '' }}">
                                        <button class="bigbutton small_block" name="selectedPlan"
                                            value="{{ env("PREMIUM_PLAN_ID") }}">Get started</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="section_divider">
                            <td>Quotas</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td><em>Total Number of API Property  Requests</em></td>
                            <td>
                                <div class="api_quota"><span class="fixed_amount">20</span><em> Monthly</em></div>
                            </td>
                            <td>
                                <div class="api_quota">
                                    <span>200</span>
                                    <em> Monthly</em>
                                </div>
                            </td>
                            <td>
                                <div class="api_quota">
                                    <span>500</span>
                                    <em> Monthly</em>
                                </div>
                            </td>
                        </tr>
                        <tr class="section_divider">
                            <td>Integrations</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td><em>Month/Yearly Gross Income Property Data</em></td>
                            <td><span class="general_check">&#10003;</span></td>
                            <td><span class="general_check">&#10003;</span></td>
                            <td><span class="general_check">&#10003;</span></td>
                        </tr>
                        <tr>
                            <td><em>Monthly/Yearly Cash Flow for properties Data</em></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Capitalization Rate </em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Cash on Cash Return Rate</em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Monthly/Yearly Net Operator Costs</em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Principal and interest rate for property</em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Capitalization Rate for property</em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr class="section_divider">
                            <td>Customization</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td><em>Customize multi-Units bedroom and bathroom for properties searches </em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr class="section_divider">
                            <td>Property History</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td><em>Track properties searches </em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal" id="pricing_page_modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <div class="modal-card-head">
                    <p class="modal-card-title"></p><a aria-label="close" class="delete" data-turbolinks="false"
                        href="#close_modal"></a>
                </div>
                <div class="modal-card-body">
                    <div class="content">
                        <div class="pricing_page_modal_info image--video-api-credits">
                            <p>Bannerbear uses an API credit system to record usage. <br>Credits are used when something
                                is
                                generated. 1 image = 1 credit.<br>Other types of media such as PDFs and videos use more
                                credits. You can check the <a
                                    href="https://www.bannerbear.com/help/articles/207-what-are-logs"
                                    target="_blank">logs
                                    section</a> on Bannerbear to see more details about your credit usage.</p>
                        </div>
                        <div class="pricing_page_modal_info dpa">A signed Data Processing Agreement that complies to
                            GDPR
                            requirements for 3rd party data processors.</div>
                        <div class="pricing_page_modal_info images">The Images API allows you to generate new images.
                            The
                            API monthly quota is the number of new images you can generate in one month.</div>
                        <div class="pricing_page_modal_info video-mins">The Videos API allows you to generate new
                            videos.
                            The API monthly quota is the number of minutes of new video footage you can process in one
                            month. Video API usage is measured in seconds and rounded to the nearest second.</div>
                        <div class="pricing_page_modal_info projects">Projects enable you to keep your templates
                            organized
                            into different workspaces. Each project has a different set of API keys.</div>
                        <div class="pricing_page_modal_info bandwidth-gb">Bannerbear delivers your image / video assets
                            via
                            a global Content Delivery Network (CDN). You may hotlink to these assets instead of
                            transferring
                            to your own server. If you decide to hotlink, this is your bandwidth allowance. <br><br>In
                            99%
                            of cases it should be more than enough 🙂</div>
                        <div class="pricing_page_modal_info rest-api">The REST API gives full access to the image /
                            video
                            generation capability of Bannerbear and allows integration into many external services or
                            your
                            own app. </div>
                        <div class="pricing_page_modal_info zapier">The Zapier integration enables you to integrate
                            Bannerbear with thousands of other apps without writing any code. Create fully automated
                            workflows that generate images and video for you and your clients.</div>
                        <div class="pricing_page_modal_info makecom">The Make.com / Integromat integration enables you
                            to
                            integrate Bannerbear with thousands of other apps without writing any code. Create fully
                            automated workflows that generate images and video for you and your clients.</div>
                        <div class="pricing_page_modal_info airtable">The Airtable integration enables you to generate
                            images from Airtable data, useful for situations where you need to create many images at
                            once.
                        </div>
                        <div class="pricing_page_modal_info signed-urls">The Signed URLs integration creates secure URLs
                            that generate images on demand, inside your application. Perfect for social meta images,
                            transactional email images and many more use cases.</div>
                        <div class="pricing_page_modal_info simple-urls">The Simple URLs integration creates dynamic
                            URLs
                            that generate images on demand, on any external platform. Perfect for using with Email
                            Service
                            Providers to increase email conversion rates and many more use cases.</div>
                        <div class="pricing_page_modal_info forms">The Forms integration creates HTML forms that your
                            team
                            or your users can interact with in order to generate images on demand. Embed them on your
                            website, add them to your internal dashboards and more.</div>
                        <div class="pricing_page_modal_info crawlers">The Crawlers integration pulls data from public
                            websites and generates images and social media graphics on demand.</div>
                        <div class="pricing_page_modal_info members">The Team Members feature enables you to add
                            multiple
                            team members to one account. Best for when you need to invite designers to design templates,
                            and
                            developers to grab API keys and view documentation.</div>
                        <div class="pricing_page_modal_info roles">Define different roles for team members, allowing you
                            to
                            control who has access to different parts of Bannerbear. For example, choose to hide API
                            keys
                            from members who do not need to view this information.</div>
                        <div class="pricing_page_modal_info 2fa">Optional Two Factor Authentication protection for your
                            Bannerbear account (and team members). Compatible with auth apps like Google Authenticator.
                        </div>
                        <div class="pricing_page_modal_info data-expiry">Optional granular control over when data
                            expires
                            and gets deleted from Bannerbear servers. You can set data to expire as soon as 10 seconds
                            after
                            assets are generated.</div>
                        <div class="pricing_page_modal_info email">Email us any time for support at
                            support@bannerbear.com —
                            we take pride in responding quickly!</div>
                        <div class="pricing_page_modal_info priority">Our email support is already pretty fast (if we do
                            say
                            so ourselves), but with priority support your requests go to the front of the queue.</div>
                        <div class="pricing_page_modal_info zoom">Get 1 to 1 support via Zoom to work through
                            challenging
                            integrations or troubleshoot issues.</div>
                        <div class="pricing_page_modal_info byo-storage">Bring Your Own Storage — connect Bannerbear
                            directly to your organization's AWS S3 Bucket so that generated media (images / videos) stay
                            within your managed technology estate.</div>
                    </div>
                </div>
                <div class="modal-card-foot"></div>
            </div>
        </div>
    </div>
    <div class="py-60">
        <div class="text-control-1">
            <h2>FAQ about credifana extension</h2>
            <div class="faqs-section">
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">What can I use Credifana for?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Credifana is a real estate chrome extension that allows users to browser properties from popular realtor websites to learn 
                            property metric such as gross income, cash flow returns, and many more metrics. What make Credifana different is that we use current property data to get a better 
                            understanding of property value specific to any location across the United States.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">
                            Why should we use Credifana?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Credifana helps potential real estate investors learn the numbers before buying property. 
                            Credifana give accurate analysis of property value specific to the area your interested in. 
                            Credifana scans properties, size, units, market value specific to the area to provide accurate metrics for that property.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">How does Freemium work?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Once you sign up you will receive 20 free clicks to search any properties that you want that integrated with the extension (ex: realtor.com). 
                            Once your 20 clicks are finished you can either wait till next month or subscribe for either standard or premium plan.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">How do I search for properties using the extension?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">After downloading the google chrome extension, you will first need to create a account on the chrome extension. Once done, 
                            you will need to visit a website that integrated with Credifana extension like realtor.com. Search for a property the extension will scrape information 
                            about that property like down payment, home price, and many more you may change the information to fit your specific needs.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">How do I subscribe to a plan?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Once you sign up you will receive 20 free clicks to search any properties that you want that integrated with the extension (ex: realtor.com). 
                            Once your 20 clicks are finished you can either wait till next month or subscribe for either standard or premium plan.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">How do I cancel my plan?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">To cancel your plan all you have to do is open the extension go to one of the websites that we are currently integrated with and click on any property. 
                            You will see a tab called “plan detail” on the extension click “cancel my plan”. Once you cancel you receive an email letting you know that your subscription has been canceled.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">Which websites is Credifana currently integrated with? </p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Credifana currently integrated with realtor.com, quarter one of 2023 Credifana will be integrating
                             with more realtor websites such as Zillow, Trulia, redfin and many more.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">Does the extension keep track of all the properties that previous searched? </p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Yes, the Credifana extension keeps track of all the properties that you previously searched under the “property history” tab.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection