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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5444717331936789"
     crossorigin="anonymous"></script>
    <!-- <title>{{ env('APP_NAME', 'MP4DOWN') }}</title> -->
    <title>MP4DOWN</title>
    <meta name="description" content="Fast, easy and convenient Facebook reels downloader">
    <meta name="keywords" content="facebook, reels, facebook download, reels download, reels down">
    <link rel="icon" type="image/x-icon" href="assets/images/mp4down-favicon.ico">
    <meta property="og:type" content="website">
    <!-- <meta property="og:url" content="https://example.com/page.html"> -->
    <meta property="og:title" content="MP4DOWN">
    <meta property="og:image" content="assets/images/mp4down-og.png">
    <meta property="og:description" content="Fast, easy and convenient Facebook reels downloader">
    <meta property="og:site_name" content="MP4DOWN">
    <meta property="og:locale" content="en_US">

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
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('More') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('youtube.index') }}">{{ __('Youtube Downloader') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('facebook.index') }}">{{ __('Facebook Downloader') }}</a></li>
                        </ul>
                    </li> -->

                </ul>
                <!-- <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
                </ul> -->
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- <div class="container">

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
                    ":app_name is a Social Media Services website and is not associated by any means to Facebook or the Facebook brand and doesn't have anything to do with Meta Platforms.",
                    ['app_name' => __(env('APP_NAME'))],
                ) !!}
            </div>
        </footer>
        {{-- Footer:END --}}
    </div> -->

    <div class="container">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="/" class="nav-link px-2 text-body-secondary black-link">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary black-link">About</a></li>
      <li class="nav-item"><a href="/terms-of-use" class="nav-link px-2 text-body-secondary black-link">Terms of Use</a></li>
      <li class="nav-item"><a href="/privacy-policy" class="nav-link px-2 text-body-secondary black-link">Privacy Policy</a></li>
    </ul>
    <p class="text-center text-body-secondary">&copy;2023 MP4DOWN, Inc. All rights reserved.</p>
  </footer>
</div>

    @stack('scripts')
</body>

</html>
