<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <?php
    $icons = new \Feather\IconManager();
    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href=" {{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/feather.css') }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href=" {{ asset('css/style.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/emoji.css') }}">

    <link rel="stylesheet" href=" {{ asset('css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/video-player.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    @livewireStyles
</head>

<body class="color-theme-blue mont-font">

    <div class="preloader"></div>

    <div class="main-wrapper">

        <!-- navigation top-->
        @include('layouts.navigation')
        <!-- navigation top -->

        <!-- navigation left -->
        @include('layouts.left-navigation')
        <!-- navigation left -->

        <!-- main content -->
        <main>
            @yield('content')
        </main>

        <!-- right chat -->
        <div class="border-0 shadow-lg app-footer bg-primary-gradiant">
            <a href="default.html" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
            <a href="default-video.html" class="nav-content-bttn"><i class="feather-package"></i></a>
            <a href="default-live-stream.html" class="nav-content-bttn" data-tab="chats"><i
                    class="feather-layout"></i></a>
            <a href="shop-2.html" class="nav-content-bttn"><i class="feather-layers"></i></a>
            <a href="default-settings.html" class="nav-content-bttn"><img src="images/female-profile.png" alt="user"
                    class="w30 shadow-xss"></a>
        </div>

        <div class="app-header-search">
            <form class="search-form">
                <div class="p-1 mb-0 border-0 form-group searchbox">
                    <input type="text" class="border-0 form-control" placeholder="Search...">
                    <i class="input-icon">
                        <ion-icon name="search-outline" role="img" class="md hydrated" aria-label="search outline">
                        </ion-icon>
                    </i>
                    <a href="#" class="mt-1 ms-1 d-inline-block close searchbox-close">
                        <i class="ti-close font-xs"></i>
                    </a>
                </div>
            </form>
        </div>

    </div>
    @foreach (App\Models\Story::where('created_at', '>=', now()->subDay())->latest()->get()->unique('user_id') as $story)
        <div class="modal bottom side fade" id="{{ $story->user->uuid }}" tabindex="-1" role="dialog"
            style=" overflow-y: auto;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 bg-transparent">
                    <button type="button" class="close mt-0 position-absolute top--30 right--10" data-dismiss="modal"
                        aria-label="Close"><i class=" text-grey-900 font-xssss">X</i></button>
                    <div class="modal-body p-0">
                        <div class="card w-100 border-0 rounded-3 overflow-hidden bg-gradiant-bottom bg-gradiant-top">
                            <div class="owl-carousel owl-theme dot-style3 story-slider owl-dot-nav nav-none">
                                @foreach (json_decode($story->story) as $story)
                                    <div class="item"><img src="{{ asset('storage') . '/' . $story }}"
                                            alt="image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group mt-3 mb-0 p-3 position-absolute bottom-0 z-index-1 w-100">
                            <input type="text"
                                class="style2-input w-100 bg-transparent border-light-md p-3 pe-5 font-xssss fw-500 text-white"
                                value="Write Comments">
                            <span class=" text-white font-md text-white position-absolute"
                                style="bottom: 35px;right:30px;"><i>{!! $icons->getIcon('send') !!}</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script src="{{ asset('js/plugin.js') }}"></script>

    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/video-player.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @livewireScripts

    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>
</body>

</html>
