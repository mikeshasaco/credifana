@extends('layouts.app')

@section('content')
@section('content')
    <section class="profile_page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3 class="mb-4"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60"fill="white">
                                    <title>Abstract user icon</title>
                                    <defs>
                                      <clipPath id="circular-border">
                                        <circle cx="30" cy="30" r="28" />
                                      </clipPath>
                                      <clipPath id="avoid-antialiasing-bugs">
                                        <rect width="100%" height="49" />
                                      </clipPath>
                                    </defs>
                                    
                                    <circle cx="30" cy="30" r="28" fill="black" clip-path="url(#avoid-antialiasing-bugs)" />
                                    <circle cx="30" cy="23" r="11" />
                                    <circle cx="30" cy="55" r="20" clip-path="url(#circular-border)" />
                                  </svg></h3>
                                <h2 class="text-center mb-2">User Profile</h2>
                                <p>Welcome <strong> {{ ucfirst($user->fname) }}  {{ ucfirst($user->lname) }}</strong>!.</p>
                                <div class="panel-body mt-4">
                                    <div class="plan-details">
                                        <div class="plan-status">
                                            <span>Active Plan</span>
                                            <span class="active-plan">{{ ucfirst($subscription->plan_name) }}</span>
                                        </div>
                                        <div class="clicks-status">
                                            <div class="clicks-info">
                                                <div>
                                                    <span>Total Clicks</span>
                                                    <span class="total-clicks">{{ ucfirst($subscription->total_click) }}</span>
                                                </div>
                                                <div>
                                                    <span>Used Clicks</span>
                                                    <span class="used-clicks">{{ ucfirst($subscription->used_click) }}</span>
                                                </div>
                                            </div>
                                            <div class="expired-info">
                                                <span><i>{{ $subscription->is_cancelled == 1 ? 'Expire' : 'Renew' }} At</i><span class="expired-date ps-2">{{ $subscription->plan_end }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="plan-btns">
                                        <div id="cancel_btn_cntnr" class="{{ $subscription->is_cancelled == 1 ? 'd-none' : '' }}">
                                            <form action="{{ route('cancel-subscription') }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn" id="cancel_btn">Cancel plan</button>
                                            </form>
                                        </div>
                                        <div>
                                            <a href="{{ route('pricing') }}" target="_blank" class="btn change-plan">Change plan</a>
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

@endsection
@endsection