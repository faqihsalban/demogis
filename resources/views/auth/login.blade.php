@extends('layouts.app')

@section('content')
<main>
     <!-- sign in area start -->
     <section class="tp-sign-in-ptb pt-195 pb-95" data-background="/img/others/sign-in-thumb.jpg">
        <div class="container">
           <div class="row justify-content-center">
              <div class="col-lg-6">
                 <div class="tp-sign-in-register-box p-relative text-center">
                    <div class="tp-sign-in-register-heading mb-30">
                       <h4 class="tp-sign-in-register-title">Hello again</h4>
                       <p>Enter your credentials to acces your account.</p>
                    </div>
                    <div class="tp-sign-in-input-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="tp-sign-in-input p-relative">
                                        <input id="email" name="email" type="email" placeholder="Email " required autocomplete="email" autofocus>
                                        <i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                                        <path d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z" stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.5 17.6C15.5 14.504 12.3626 12 8.5 12C4.63737 12 1.5 14.504 1.5 17.6" stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg></i>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="tp-sign-in-input p-relative">
                                        <div class="password-input p-relative">
                                            <input id="password" type="password" name="password" required autocomplete="current-password">
                                            {{-- <input type="password" placeholder="Password"> --}}
                                        <div class="tp-sign-in-input-eye password-show-toggle">
                                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path d="M4.20215 7.4V5.8C4.20215 3.152 5.00215 1 9.00215 1C13.0021 1 13.8021 3.152 13.8021 5.8V7.4" stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 14.2C10.1046 14.2 11 13.3045 11 12.2C11 11.0954 10.1046 10.2 9 10.2C7.89543 10.2 7 11.0954 7 12.2C7 13.3045 7.89543 14.2 9 14.2Z" stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M13 17H5C1.8 17 1 16.2 1 13V11.4C1 8.20002 1.8 7.40002 5 7.40002H13C16.2 7.40002 17 8.20002 17 11.4V13C17 16.2 16.2 17 13 17Z" stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg></i>
                                            <span class="open-eye open-eye-icon">
                                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none" >
                                                    <path d="M1 6.77778C1 6.77778 3.90909 1 9 1C14.0909 1 17 6.77778 17 6.77778C17 6.77778 14.0909 12.5556 9 12.5556C3.90909 12.5556 1 6.77778 1 6.77778Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9.00018 8.94466C10.2052 8.94466 11.182 7.97461 11.182 6.77799C11.182 5.58138 10.2052 4.61133 9.00018 4.61133C7.79519 4.61133 6.81836 5.58138 6.81836 6.77799C6.81836 7.97461 7.79519 8.94466 9.00018 8.94466Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                            <span class="open-close close-eye-icon">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" >
                                                    <path d="M6.8822 11.7457C6.72311 11.7457 6.56402 11.6871 6.43842 11.5615C5.7518 10.8749 5.375 9.9622 5.375 8.99926C5.375 6.99803 6.99943 5.3736 9.00066 5.3736C9.9636 5.3736 10.8763 5.7504 11.5629 6.43701C11.6801 6.55424 11.7471 6.71333 11.7471 6.8808C11.7471 7.04827 11.6801 7.20736 11.5629 7.32459L7.32599 11.5615C7.20039 11.6871 7.0413 11.7457 6.8822 11.7457ZM9.00066 6.6296C7.69442 6.6296 6.631 7.69302 6.631 8.99926C6.631 9.41793 6.73986 9.81985 6.94082 10.1715L10.1729 6.93941C9.82125 6.73845 9.41933 6.6296 9.00066 6.6296Z" fill="#1C274C"/>
                                                    <path opacity="0.5" d="M3.63816 14.4503C3.49582 14.4503 3.3451 14.4001 3.22787 14.2996C2.33192 13.5376 1.52808 12.5998 0.841463 11.5112C-0.0461127 10.1296 -0.0461127 7.87721 0.841463 6.48723C2.88456 3.28861 5.8571 1.44647 8.99711 1.44647C10.8393 1.44647 12.6563 2.08285 14.2472 3.28024C14.5235 3.48957 14.5821 3.88312 14.3728 4.15944C14.1635 4.43576 13.7699 4.49437 13.4936 4.28504C12.1204 3.24674 10.5629 2.70248 8.99711 2.70248C6.29252 2.70248 3.70515 4.32691 1.89651 7.16547C1.2685 8.14516 1.2685 9.85332 1.89651 10.833C2.52451 11.8127 3.24462 12.6584 4.04009 13.345C4.29966 13.5711 4.33315 13.9646 4.10707 14.2326C3.98984 14.3749 3.814 14.4503 3.63816 14.4503Z" fill="#1C274C"/>
                                                    <path opacity="0.5" d="M9.00382 16.552C7.89017 16.552 6.80163 16.3259 5.75496 15.8821C5.43678 15.7482 5.28606 15.3797 5.42003 15.0616C5.554 14.7434 5.92243 14.5927 6.24062 14.7266C7.12819 15.1034 8.05764 15.296 8.99545 15.296C11.7 15.296 14.2874 13.6716 16.0961 10.833C16.7241 9.85333 16.7241 8.14517 16.0961 7.16548C15.8365 6.75519 15.5518 6.36164 15.2503 5.99321C15.0326 5.72527 15.0745 5.33172 15.3425 5.10564C15.6104 4.88793 16.0039 4.92142 16.23 5.19775C16.5566 5.59967 16.8748 6.03508 17.1595 6.48724C18.047 7.86885 18.047 10.1213 17.1595 11.5113C15.1164 14.7099 12.1438 16.552 9.00382 16.552Z" fill="#1C274C"/>
                                                    <path d="M9.58061 12.5747C9.28754 12.5747 9.01959 12.3654 8.96098 12.0639C8.89399 11.7206 9.12007 11.3941 9.46338 11.3355C10.3845 11.168 11.1548 10.3976 11.3223 9.47657C11.3893 9.13327 11.7158 8.91556 12.0591 8.97417C12.4024 9.04116 12.6285 9.36772 12.5615 9.71103C12.2936 11.1596 11.1381 12.3068 9.69783 12.5747C9.65597 12.5663 9.62247 12.5747 9.58061 12.5747Z" fill="#1C274C"/>
                                                    <path d="M0.625908 18.0007C0.466815 18.0007 0.307721 17.9421 0.18212 17.8165C-0.0607068 17.5736 -0.0607068 17.1717 0.18212 16.9289L6.43702 10.674C6.67984 10.4312 7.08177 10.4312 7.32459 10.674C7.56742 10.9168 7.56742 11.3188 7.32459 11.5616L1.0697 17.8165C0.944096 17.9421 0.785002 18.0007 0.625908 18.0007Z" fill="#1C274C"/>
                                                    <path d="M11.122 7.50881C10.9629 7.50881 10.8038 7.45019 10.6782 7.32459C10.4354 7.08177 10.4354 6.67984 10.6782 6.43702L16.9331 0.182121C17.1759 -0.0607068 17.5779 -0.0607068 17.8207 0.182121C18.0635 0.424948 18.0635 0.826869 17.8207 1.0697L11.5658 7.32459C11.4402 7.45019 11.2811 7.50881 11.122 7.50881Z" fill="#1C274C"/>
                                                </svg>
                                            </span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="tp-sign-in-from-remeber">
                                        <div class="row">
                                        <div class="col-6">
                                            <div class="tp-contact-input-remeber">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember">Remember me</label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6">
                                            <div class="tp-sign-in-input-remeber text-end">
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                        </div> --}}
                                        </div>
                                    </div>
                                    <div class="tp-sign-in-from-btn mb-30">
                                        <button class="tp-btn w-100 text-center" type="submit">Login In</button>
                                    </div>
                                    {{-- <div class="tp-sign-in-from-subtitle-heading">
                                        <h5 class="tp-sign-in-from-subtitle">Or Sign In with</h5>
                                    </div> --}}
                                    {{-- <div class="tp-sign-in-from-btn mb-30">
                                        <a href="https://google.com" target="_blank">
                                        <span><svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.5642 11.7235C21.5642 10.8961 21.4957 10.2924 21.3474 9.66626H11.707V13.4005H17.3657C17.2517 14.3285 16.6356 15.7261 15.2665 16.6652L15.2473 16.7902L18.2954 19.1044L18.5066 19.125C20.4461 17.3696 21.5642 14.7869 21.5642 11.7235" fill="#4285F4"></path>
                                            <path d="M11.7039 21.5625C14.4761 21.5625 16.8035 20.668 18.5034 19.1251L15.2633 16.6653C14.3963 17.2579 13.2326 17.6716 11.7039 17.6716C8.98861 17.6716 6.68407 15.9163 5.86257 13.4901L5.74215 13.5001L2.5727 15.9039L2.53125 16.0168C4.21972 19.3039 7.68797 21.5625 11.7039 21.5625Z" fill="#34A853"></path>
                                            <path d="M5.86404 13.4901C5.64728 12.864 5.52183 12.1931 5.52183 11.5C5.52183 10.8067 5.64728 10.1359 5.85263 9.50984L5.84689 9.37649L2.63771 6.93405L2.53271 6.983C1.83681 8.34704 1.4375 9.87881 1.4375 11.5C1.4375 13.1212 1.83681 14.6528 2.53271 16.0169L5.86404 13.4901" fill="#FBBC05"></path>
                                            <path d="M11.7039 5.32831C13.632 5.32831 14.9325 6.14448 15.6741 6.82654L18.5719 4.05375C16.7922 2.43257 14.4762 1.4375 11.7039 1.4375C7.688 1.4375 4.21973 3.69595 2.53125 6.98301L5.85118 9.50985C6.6841 7.08367 8.98865 5.32831 11.7039 5.32831" fill="#EB4335"></path>
                                        </svg></span>
                                        Google
                                        </a>
                                        <a href="https://facebook.com" target="_blank">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path d="M18 9C18 4.02944 13.9706 0 9 0C4.02943 0 0 4.02944 0 9C0 13.4921 3.29115 17.2155 7.59375 17.8907V11.6016H5.30859V9H7.59375V7.01719C7.59375 4.76156 8.93742 3.51563 10.9932 3.51563C11.9776 3.51563 13.0078 3.69141 13.0078 3.69141V5.90625H11.873C10.755 5.90625 10.4062 6.60006 10.4062 7.3125V9H12.9023L12.5033 11.6016H10.4062V17.8907C14.7088 17.2155 18 13.4921 18 9Z" fill="#4285F4"/>
                                                <path d="M12.5014 11.6016L12.9004 9H10.4043V7.3125C10.4043 6.60076 10.753 5.90625 11.871 5.90625H13.0059V3.69141C13.0059 3.69141 11.976 3.51562 10.9912 3.51562C8.93547 3.51562 7.5918 4.76156 7.5918 7.01719V9H5.30664V11.6016H7.5918V17.8907C8.52363 18.0364 9.47246 18.0364 10.4043 17.8907V11.6016H12.5014Z" fill="white"/>
                                            </svg>
                                        </span>
                                        Facebook
                                        </a>
                                        <a href="https://apple.com" target="_blank">
                                        <span>
                                            <i class="fa-brands fa-apple"></i>
                                        </span>
                                        Apple
                                        </a>
                                    </div> --}}
                                    {{-- <div class="tp-sign-in-from-register">
                                        <p>Don’t have an account? <a class="textline" href="register.html">Register Now</a></p>
                                    </div> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                 </div>
              </div>
           </div>
        </div>
      </section>
     <!-- sign in area end -->
    <!-- contact area start -->
    {{-- <section class="tp-contact-inner-ptb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <blockquote>
                        <strong>
                            ** Login menggunakan akun administrator <br>
                            ** Email (admin@email.test) <br>
                            ** Password (password123) <br>
                            ** Jika ingin menggunakan akun baru silahkan lakukan register
                        </strong>
                    </blockquote>
                    <div class="card">
                        <div class="card-header">{{ __('Login') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- contact area end -->
</main>

@endsection
