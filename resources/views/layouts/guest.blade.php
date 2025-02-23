<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} - {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('admin/font/iconsmind-s/css/iconsminds.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/font/simple-line-icons/css/simple-line-icons.css') }} " />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('admin/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/vendor/bootstrap-float-label.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dore.light.blueolympic.css') }}" />


</head>

<body class="background show-spinner no-footer">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                      {{ $slot }}
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('admin/js/vendor/jquery-3.3.1.min.js') }}" ></script>
    <script src="{{ asset('admin/js/vendor/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('admin/js/dore.script.js') }}" ></script>
    <script src="{{ asset('admin/js/scripts.single.theme.js')}}"></script>
</body>
</html>
