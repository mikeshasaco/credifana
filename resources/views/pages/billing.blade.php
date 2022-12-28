@extends('layouts.app')

@section('content')

<section class="contact-hero-section d-block container-lg">
    <div class="mb-5">
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
                            <td><em>Total Requests</em></td>
                            <td>
                                <div class="api_quota"><span class="fixed_amount">20</span></div>
                            </td>
                            <td>
                                <div class="api_quota">
                                    <span>200</span>
                                </div>
                            </td>
                            <td>
                                <div class="api_quota">
                                    <span>500</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="section_divider">
                            <td>Integrations</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td><em>Gross yearly income</em></td>
                            <td><span class="general_check">&#10003;</span></td>
                            <td><span class="general_check">&#10003;</span></td>
                            <td><span class="general_check">&#10003;</span></td>
                        </tr>
                        <tr>
                            <td><em>Gross monthly income</em></td>
                            <td><span class="general_check">&#10003;</span></td>
                            <td><span class="general_check">&#10003;</span></td>
                            <td><span class="general_check">&#10003;</span></td>
                        </tr>
                        <tr>
                            <td><em>Calculate Monthly and Yearly cash flow for multi-unit properties</em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Rent data provided for property</em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Total cash flow data, month and yearly data after property expenses</em></td>
                            <td><span class="general_check false">&#10005;</span></td>
                            <td><span class="general_check">✓</span></td>
                            <td><span class="general_check">✓</span></td>
                        </tr>
                        <tr>
                            <td><em>Monthly and Yearly net operator costs</em></td>
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
                            <p class="question" title="">
                                How many travellers make a Group?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Groups can start at as low as 8 people depending on the travel provider. Plus,
                            there is no size limit or maximum number of passengers. The more, the merrier!</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">
                                How much is a group discount?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Discounts vary depending on a number of factors, like the size of your group,
                            duration of stay, special activities and more. Discuss your group travel requirements with
                            your
                            agent and they’ll be sure to find you all the discounts your group is eligible for.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">What kinds of groups can travel together?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">You name it! We has booked all kinds of group travel. We’re happy to arrange
                            friends and family trips, destination weddings, group golf getaways, anniversaries and vow
                            renewals, as well as get-togethers for clubs and other special interest groups.</p>
                    </div>
                </div>
                <div class="faq accordion">
                    <div class="question-wrapper">
                        <div class="d-flex align-items-center"><span class="q-mark d-block">Q.</span>
                            <p class="question" title="">
                                Are there group travel benefits beyond discounted airfare and accommodation?</p>
                        </div><i class="material-icons drop fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="answer-wrapper">
                        <p class="answer">Yes! For starters, groups can take advantage of flexible payment options,
                            often
                            with lower deposits required to secure each booking. In addition to discounts up-front, your
                            group may be eligible for complimentary passengers, and qualify for more flexible terms. Be
                            sure
                            to ask your agent for details! Ask your Travel Professional for details!</p>
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