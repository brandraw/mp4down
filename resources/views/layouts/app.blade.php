<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(()=>{
            $("[data-toggle='tooltip']").tooltip();
        });
    </script>
    <title>{{ $title ?? 'Home' . ' | ' . env('APP_NAME', 'Video Downloader') }}</title>

    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="" width="150">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('More Downloaders') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('youtube.index') }}">{{ __('Youtube Downloader') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('facebook.index') }}">{{ __('Facebook Downloader') }}</a></li>
                        </ul>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img width="36" class="me-2"
                                src="{{ asset('assets/images/flags/' . App::getLocale() . '.png') }}"
                                alt="">{{ App::getLocale() }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item"
                                    href="{{ LaravelLocalization::getLocalizedURL('en') }}">{{ __('English (EN)') }}</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ LaravelLocalization::getLocalizedURL('es') }}">{{ __('Spanish (ES)') }}</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ LaravelLocalization::getLocalizedURL('zh') }}">{{ __('Chinese (ZH)') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <div class="container">

        {{-- Footer:BEGIN --}}
        <footer class="footer">
            <div class="fw-bolder text-center">{{ __(env('APP_NAME')) }}</div>
            <div class="fw-bolder text-center">
                {{ __(
                    ":app_name does not host any videos on its servers. All videos that you download are hosted on Facebook's CDNs.",
                    ['app_name' => __(env('APP_NAME'))],
                ) }}
            </div>
            <div class="fw-bolder text-center">
                {!! __(
                    ":app_name (formerly FBDOWN) is a Social Media Services website and is not associated by any means to Facebook or the Facebook brand and doesn't have anything to do with Meta Platforms, Inc. <a href='javascript:void(0);'>Read the full Disclaimer</a>",
                    ['app_name' => __(env('APP_NAME'))],
                ) !!}.
            </div>
        </footer>
        {{-- Footer:END --}}
    </div>


    @stack('scripts')
</body>

</html>
