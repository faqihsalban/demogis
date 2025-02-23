<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('admin/font/iconsmind-s/css/iconsminds.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/font/simple-line-icons/css/simple-line-icons.css') }}" />
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('admin/css/vendor/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/css/vendor/component-custom-switch.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/css/vendor/perfect-scrollbar.css') }}" />
        <style>
            .bottom-action {
                display: flex;
                justify-content: flex-end;
            }
            .lock-modal {
                display: none;
                background-color: black;
                opacity: 0.6;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: inherit;
            }

            .loading-circle {
                display: none;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                margin: auto;
                width: 40px;
                height: 40px;
                border: 4px solid #f3f3f3;
                border-top: 4px solid #3498db;
                border-radius: 50%;
                animation: spin 0.6s ease-in infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
        @stack('style')
        {{-- <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" /> --}}
        <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin/css/dore.light.blueolympic.css') }}" />

    </head>
    <body id="app-container" class="menu-default">
         {{-- @include('sweet::alert') --}}
        @include('layouts.navigation')
        @include('layouts.menu')

        <!-- Page Content -->
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-5 header-content">
                            <div class="card-body">
                                {{ $header }}
                            </div>
                        </div>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </main>

        <footer class="page-footer">
            <div class="footer-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <p class="mb-0 text-muted">quem-studio.com 2020</p>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block">
                            <ul class="breadcrumb pt-0 pr-0 float-right">
                                <li class="breadcrumb-item mb-0">
                                    <a href="#" class="btn-link">Docs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Scripts -->
        <script>
            var baseUrl = "{{config('app.url')}}";
        </script>
        <script src="{{asset('admin/js/vendor/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('admin/js/vendor/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('admin/js/vendor/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('admin/js/vendor/mousetrap.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <script>
            function modalLoading(idForm,action){
                const lockModal = $(".lock-modal");
                const loadingCircle = $(".loading-circle");
                if (idForm == "no") {
                    if(action === "show")
                    {
                        lockModal.css("display", "block");
                        loadingCircle.css("display", "block");
                    }
                    else{
                        lockModal.css("display", "none");
                        loadingCircle.css("display", "none");
                    }
                }else{
                    const form = $("#"+idForm);
                    if(action === "show")
                    {
                        lockModal.css("display", "block");
                        loadingCircle.css("display", "block");

                        form.children("input").each(function() {
                            $(this).attr("readonly", true);
                        });
                    }
                    else{
                        lockModal.css("display", "none");
                        loadingCircle.css("display", "none");

                        form.children("input").each(function() {
                            $(this).attr("readonly", false);
                        });
                    }
                }


            }
        </script>
        @stack('script')
        <script src="{{asset('admin/js/dore.script.js')}}"></script>
        <script src="{{asset('admin/js/scripts.single.theme.js')}}"></script>
    </body>
</html>
