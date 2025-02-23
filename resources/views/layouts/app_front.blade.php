<!doctype html>
<html class="no-js" lang="zxx">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Place favicon.ico in the root directory -->
      <link rel="shortcut icon" type="image/x-icon" href="/img/logo/favicon.png">

      <!-- CSS here -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper-bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome-pro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/spacing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @stack('style-css')

   </head>
   <body>
      <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->


      <!-- pre loader area start -->
      <div id="loading">
         <div class="loader-mask">
            <div class="loader">
              <div></div>
              <div></div>
            </div>
         </div>
      </div>
      <!-- pre loader area end -->

      <!-- back to top start -->
      <div class="back-to-top-wrapper">
         <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
         </button>
      </div>
      <!-- back to top end -->

      <!-- offcanvas area start -->
         <div class="offcanvas__area">
         <div class="offcanvas__close">
            <button class="offcanvas__close-btn offcanvas-close-btn">
               <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
            </button>
         </div>
         <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
               <div class="offcanvas__top mb-40">
                  <div class="offcanvas__logo">
                     <a href="index.html">
                        <img src="/img/logo/logo-white.png" alt="logo">
                     </a>
                  </div>
               </div>

               <div class="tp-offcanvas-menu fix d-xl-none mb-30">
                  <nav></nav>
               </div>

               <div class="offcanvas__contact d-none d-xl-block">
                  <div class="offcanvas__text mb-30">
                     <p>The design readable content of a page hen looking at its layout The point our of using Movie template</p>
                  </div>
                  <div class="offcanvas__gallery mb-30">
                     <h4 class="offcanvas__title">Gallery</h4>

                  </div>
               </div>
               <div class="offcanvas-info mb-30">
                  <h4 class="offcanvas__title">Contacts</h4>
                  <div class="offcanvas__contact-content d-flex">
                     <div class="offcanvas__contact-content-icon">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>
                     </div>
                     <div class="offcanvas__contact-content-content">
                        <a href="https://www.google.com/maps/search/86+Road+Broklyn+Street,+600+New+York,+USA/@40.6897806,-74.0278086,12z/data=!3m1!4b1">86 Road Broklyn Street, 600 </a>
                     </div>
                  </div>
                  <div class="offcanvas__contact-content d-flex">
                     <div class="offcanvas__contact-content-icon">
                        <i class="fa-solid fa-envelope"></i>
                     </div>
                     <div class="offcanvas__contact-content-content">
                        <a href="mailto:needhelp@company.com"> Needhelp@company.com  </a>
                     </div>
                  </div>
                  <div class="offcanvas__contact-content d-flex">
                     <div class="offcanvas__contact-content-icon">
                        <i class="fa-solid fa-phone"></i>
                     </div>
                     <div class="offcanvas__contact-content-content">
                        <a href="tel:01310-069824"> +92 666 888 0000</a>
                     </div>
                  </div>
               </div>
               <div class="offcanvas__social">
                  <a class="icon facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                  <a class="icon twitter" href="#"><i class="fab fa-twitter"></i></a>
                  <a class="icon youtube" href="#"><i class="fab fa-youtube"></i></a>
                  <a class="icon linkedin" href="#"><i class="fab fa-linkedin"></i></a>
               </div>
            </div>
         </div>
      </div>
      <div class="body-overlay"></div>
      <!-- offcanvas area end -->


      <!-- header area start -->
      <header class="tp-header-5-ptb p-relative">
         <div class="tp-header-main-sticky p-relative">
            <div class="container container-large">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-4 col-md-3 col-6">
                     <div class="tp-header-logo">
                        <a href="index.html">
                           <img src="img/logo/logo-black.png" alt="">
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-4 d-none d-lg-block">
                     <div class="tp-header-2-menu">
                        <div class="tp-main-menu d-none d-xl-block">
                           <nav class="tp-mobile-menu-active">
                              <ul>
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif
                                @else
                                 <li><a href="{{ route('map.index') }}">Home</a></li>
                                 <li><a href="{{ route('space.index') }}">Spaces</a></li>
                                 {{-- <li><a href="{{ route('centre-point.index')}}">Center Map</a></li> --}}
                                 <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                @endguest

                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-9 col-6">
                     <div class="tp-header-5-main-right d-flex align-items-center justify-content-end">

                        {{-- <div class="tp-header-5-contact mr-30">
                           <a href="tel:5697422">
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                 <path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#5758D6" stroke-width="1.5" stroke-miterlimit="10"/>
                                 <path d="M20.0002 4H15.2002M20.0002 4V8.8V4Z" stroke="#5758D6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                               </svg></span>
                               123-456-7890
                           </a>
                        </div>

                        <div class="tp-header-5-btn d-none d-md-block">
                           <a class="tp-btn" href="property-style-1.html">
                              <span class="btn-wrap">
                                 <b class="text-1">Find Property</b>
                                 <b class="text-2">Find Property</b>
                              </span>
                           </a>
                        </div> --}}

                        <div class="tp-header-hamburger d-xl-none offcanvas-open-btn">
                           <button class="hamburger-btn">
                              <span></span>
                              <span></span>
                              <span></span>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <header class="tp-header-2-ptb p-relative tp-int-menu tp-header-sticky-cloned">
         <div class="tp-header-main-sticky tp-header-5-main p-relative">
            <div class="container container-large">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-4 col-md-3 col-6">
                     <div class="tp-header-logo">
                        <a href="index.html">
                           <img src="/img/logo/logo-black.png" alt="">
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-4 d-none d-lg-block">
                     <div class="tp-header-2-menu">
                        <div class="tp-main-menu d-none d-xl-block">
                           <nav>
                              <ul>
                                 <li class="has-dropdown p-static">
                                    <a href="index.html">Home</a>
                                    <div class="tp-mega-menu">
                                       <div class="tp-home-menu">
                                          <div class="row row-cols-1 row-cols-xl-5 row-cols-xxl-5">
                                             <div class="col">
                                                <a href="index.html">
                                                   <div class="tp-home-thumb">
                                                      <img src="/img/menu/img-1.jpg" alt="">
                                                   </div>
                                                   <h3 class="tp-home-title">Home 01</h3>
                                                </a>
                                             </div>
                                             <div class="col">
                                                <a href="index-2.html">
                                                   <div class="tp-home-thumb">
                                                      <img src="/img/menu/img-2.jpg" alt="">
                                                   </div>
                                                   <h3 class="tp-home-title">Home 02</h3>
                                                </a>
                                             </div>
                                             <div class="col">
                                                <a href="index-3.html">
                                                   <div class="tp-home-thumb">
                                                      <img src="/img/menu/img-3.jpg" alt="">
                                                   </div>
                                                   <h3 class="tp-home-title">Home 03</h3>
                                                </a>
                                             </div>
                                             <div class="col">
                                                <a href="index-4.html">
                                                   <div class="tp-home-thumb">
                                                      <img src="/img/menu/img-4.jpg" alt="">
                                                   </div>
                                                   <h3 class="tp-home-title">Home 04</h3>
                                                </a>
                                             </div>
                                             <div class="col">
                                                <a href="index-5.html">
                                                   <div class="tp-home-thumb">
                                                      <img src="/img/menu/img-5.jpg" alt="">
                                                   </div>
                                                   <h3 class="tp-home-title">Home 05</h3>
                                                </a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="has-dropdown"><a href="#">Pages</a>
                                    <ul class="sub-menu">
                                       <li><a href="about.html">About</a></li>
                                       <li><a href="agency.html">Agency</a></li>
                                       <li><a href="agency-details.html">Agency Details</a></li>
<li><a href="faq.html">Faq</a></li>
                                       <li><a href="pricing.html">Pricing</a></li>
                                       <li><a href="agent.html">Agent</a></li>
                                       <li><a href="agent-details.html">Agent Details</a></li>
                                       <li><a href="register.html">Register</a></li>
                                       <li><a href="sign-in.html">Sign In</a></li>
                                       <li><a href="error.html">Error</a></li>
                                    </ul>
                                 </li>
                                 <li class="has-dropdown">
                                    <a href="property-style-1.html">Real Estate</a>
                                    <ul class="sub-menu">
                                       <li><a href="property-style-1.html">Property Style 1</a></li>
                                       <li><a href="property-style-2.html">Property Style 2</a></li>
                                       <li><a href="property-style-3.html">Property Style 3</a></li>
                                       <li><a href="property-details-1.html">Property Details 1</a></li>
                                       <li><a href="property-details-2.html">Property Details 2</a></li>
                                       <li><a href="property-details-3.html">Property Details 3</a></li>
                                    </ul>
                                 </li>
                                 <li class="has-dropdown">
                                    <a href="blog.html">Blog</a>
                                    <ul class="sub-menu">
                                       <li><a href="blog.html">Blog</a></li>
                                       <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                 </li>
                                 <li><a href="contact.html">Contact</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-9 col-6">
                     <div class="tp-header-5-main-right d-flex align-items-center justify-content-end">

                        <div class="tp-header-5-contact mr-30">
                           <a href="tel:5697422">
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                 <path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#5758D6" stroke-width="1.5" stroke-miterlimit="10"/>
                                 <path d="M20.0002 4H15.2002M20.0002 4V8.8V4Z" stroke="#5758D6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                               </svg></span>
                               123-456-7890
                           </a>
                        </div>

                        <div class="tp-header-5-btn d-none d-md-block">
                           <a class="tp-btn" href="property-style-1.html">
                              <span class="btn-wrap">
                                 <b class="text-1">Find Property</b>
                                 <b class="text-2">Find Property</b>
                              </span>
                           </a>
                        </div>

                        <div class="tp-header-hamburger d-xl-none offcanvas-open-btn">
                           <button class="hamburger-btn">
                              <span></span>
                              <span></span>
                              <span></span>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->

        <main>
            @yield('content')
        </main>

      <!-- footer area start -->
      {{-- <footer class="tp-footer-area p-relative pt-20">
         <div class="tp-footer-bg"></div>
         <div class="container">
            <div class="tp-footer-widget-border">
               <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                     <div class="tp-footer-widget tp-footer-col-1 mb-50">
                        <div class="tp-footer-logo mb-35">
                           <a href="index.html"> <img src="/img/logo/logo-white.png" alt=""></a>
                        </div>
                        <div class="tp-footer-widget-content">
                           <p>The home and elements needed to create beautiful products.</p>
                           <div class="tp-footer-widget-contact">
                              <a href="tel:555-0111"><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                 <path d="M0 16.33C0 16.69 0.0801201 17.06 0.250376 17.42C0.420631 17.78 0.640961 18.12 0.931396 18.44C1.42213 18.98 1.96294 19.37 2.57386 19.62C3.17476 19.87 3.82574 20 4.52679 20C5.54832 20 6.63996 19.76 7.79169 19.27C8.94342 18.78 10.0951 18.12 11.2369 17.29C12.3886 16.45 13.4802 15.52 14.5218 14.49C15.5533 13.45 16.4847 12.36 17.316 11.22C18.1372 10.08 18.7982 8.94 19.2789 7.81C19.7596 6.67 20 5.58 20 4.54C20 3.86 19.8798 3.21 19.6395 2.61C19.3991 2 19.0185 1.44 18.4877 0.94C17.8468 0.31 17.1457 0 16.4046 0C16.1242 0 15.8438 0.0600001 15.5934 0.18C15.333 0.3 15.1027 0.48 14.9224 0.74L12.5989 4.01C12.4186 4.26 12.2884 4.49 12.1983 4.71C12.1082 4.92 12.0581 5.13 12.0581 5.32C12.0581 5.56 12.1282 5.8 12.2684 6.03C12.3986 6.26 12.5889 6.5 12.8292 6.74L13.5904 7.53C13.7006 7.64 13.7506 7.77 13.7506 7.93C13.7506 8.01 13.7406 8.08 13.7206 8.16C13.6905 8.24 13.6605 8.3 13.6405 8.36C13.4602 8.69 13.1497 9.12 12.7091 9.64C12.2584 10.16 11.7777 10.69 11.2569 11.22C10.7161 11.75 10.1953 12.24 9.6645 12.69C9.14372 13.13 8.71307 13.43 8.37256 13.61C8.32248 13.63 8.26239 13.66 8.19229 13.69C8.11217 13.72 8.03205 13.73 7.94191 13.73C7.77166 13.73 7.64146 13.67 7.5313 13.56L6.77015 12.81C6.51978 12.56 6.27942 12.37 6.04907 12.25C5.81873 12.11 5.58838 12.04 5.33801 12.04C5.14772 12.04 4.94742 12.08 4.72709 12.17C4.50676 12.26 4.27641 12.39 4.02604 12.56L0.711065 14.91C0.450676 15.09 0.270405 15.3 0.16024 15.55C0.060091 15.8 0 16.05 0 16.33Z" fill="currentColor"/>
                               </svg> +624 423 26 72</span></a>
                               <p>support@bhumi.com</p>
                           </div>
                           <div class="tp-footer-widget-social">
                              <a href="#"><i class="fab fa-facebook-f"></i></a>
                              <a href="#"><i class="fa-brands fa-instagram"></i></a>
                              <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                              <a href="#"><i class="fab fa-twitter"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                     <div class="tp-footer-widget tp-footer-col-2 mb-50">
                        <h3 class="tp-footer-widget-title">Quick Link</h3>
                        <div class="tp-footer-widget-content">
                           <ul>
                              <li><a href="#">About</a></li>
                              <li><a href="#">Blog</a></li>
                              <li><a href="#">All Products</a></li>
                              <li><a href="#">Location Map</a></li>
                              <li><a href="#">Our Faq</a></li>
                              <li><a href="#">Contact  </a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                     <div class="tp-footer-widget tp-footer-col-3 mb-50">
                        <h3 class="tp-footer-widget-title">Services</h3>
                        <div class="tp-footer-widget-content">
                           <ul>
                              <li><a href="#">Order Tracking</a></li>
                              <li><a href="#">Wish List</a></li>
                              <li><a href="#">Login</a></li>
                              <li><a href="#">My account</a></li>
                              <li><a href="#">Terms & Conditions</a></li>
                              <li><a href="#">Promotional Offers</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                     <div class="tp-footer-widget tp-footer-col-4 mb-50">
                        <div class="tp-footer-widget-content">
                           <div class="tp-footer-widget-contact">
                              <h3 class="tp-footer-widget-title">Newsletter</h3>
                              <p>Subscribe our newsletter to get the latest news & updates.</p>
                              <div class="tp-footer-widget-content-input">
                                 <form action="index.html">
                                    <input type="email" placeholder="email@example.com...">
                                    <button>
                                       <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                          <path d="M1 11L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M1 1H11V11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                    </button>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tp-footer-copyright-ptb pt-20 pb-20">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tp-footer-copyright text-center">
                        <p>© 2024 Bhumi. All images are for demo purposes.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer> --}}
      <!-- footer area end -->


      <!-- JS here -->
    <script src="{{ asset('js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('js/range-slider.js') }}"></script>
    <script src="{{ asset('js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('js/magnific-popup.js') }}"></script>
    <script src="{{ asset('js/purecounter.js') }}"></script>
    <script src="{{ asset('js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('js/nice-select.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/ajax-form.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('javascript')

   </body>
</html>

