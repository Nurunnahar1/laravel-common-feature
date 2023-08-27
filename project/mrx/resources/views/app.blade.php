<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <title>{{ $seo->title }}</title>
        <meta name="description" content="description" />
        <meta name="keywords" content="keywords" />
        <meta name="og:Site-name" content="ogSiteName" />
        <meta name="og:Url" content="ogUrl" />
        <meta name="og:Title" content="ogTitle" />
        <meta name="og:Description" content="ogDescription" />
        <meta name="og:Image" content="ogImage" />
        <meta name="author" content="" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/axios.min.js') }}"></script>
    </head>

    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            @include('components.navbar')
             @include('components.loader')

            <div class="" id="content-div">
                @yield('content')
            </div>


        </main>
        @include('components.footer')

        <script src="{{ asset('js/bootstrap.bundle.min.js') }} "></script>
    </body>
</html>
