<div class="bg-white border-0 shadow-xs nav-header">
    <?php
    $icons = new \Feather\IconManager();
    ?>
    <div class="nav-top">
        <a href="{{ url('/') }}"><i class=" text-success display1-size me-2 ms-0"
                style="margin-top: -10px">{!! $icons->getIcon('zap') !!}</i><span
                class="mb-0 text-current d-inline-block fredoka-font ls-3 fw-600 font-xxl logo-text">{{ config('app.name') }}
            </span>
        </a>
        <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i
                class=" text-grey-900 font-sm btn-round-md bg-greylight"
                style="margin-top: -10px">{!! $icons->getIcon('message-circle') !!}</i></a>
        <a href="default-video.html" class="mob-menu me-2"><i class=" text-grey-900 font-sm btn-round-md bg-greylight"
                style="margin-top: -10px">{!! $icons->getIcon('video') !!}</i></a>
        <a href="#" class="me-2 menu-search-icon mob-menu"><i
                class="text-grey-900 font-sm btn-round-md bg-greylight"
                style="margin-top: -10px">{!! $icons->getIcon('search') !!}</i></a>
        <button class="nav-menu me-0 ms-2"></button>
    </div>

    <link href="
https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.min.css
" rel="stylesheet">

    <form action="{{ route('search') }}" method="GET" class="float-left header-search">
        <div class="mb-0 form-group icon-input">
            <i class=" font-sm text-grey-400" style="margin-top: -10px">{!! $icons->getIcon('search') !!}</i>
            <input type="text" name="query" placeholder="Start typing to search.."
                class="pt-2 pb-2 border-0 bg-grey lh-32 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
        </div>
    </form>
    <a href="{{ url('/') }}" class="  p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class=" {{ request()->route()->getName() == 'home'? 'bg-primary': '' }} font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500"
            style="margin-top: -10px">{!! $icons->getIcon('home') !!}</i></a>
    <a href="{{ route('explore') }}" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class=" {{ request()->route()->getName() == 'explore'? 'bg-primary': '' }} font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500"
            style="margin-top: -10px">{!! $icons->getIcon('zap') !!}</i></a>
    <a href="{{ route('videos') }}" class="   p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="{{ request()->route()->getName() == 'videos'? 'bg-primary': '' }} font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500"
            style="margin-top: -10px">{!! $icons->getIcon('video') !!}</i></a>
    <a href="{{ route('user', auth()->user()->uuid) }} " class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class=" font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500"
            style="margin-top: -10px">{!! $icons->getIcon('user') !!}</i></a>


    <a href="#" class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown"
        aria-expanded="false">
        @if (App\Models\Notification::where(['user_id' => auth()->id(), 'read_at' => null])->latest()->exists())
            <span class="dot-count bg-warning"></span>
        @endif
        <i class="text-current font-xl" style="margin-top: -10px">{!! $icons->getIcon('bell') !!}</i>
    </a>
    <div class="p-4 border-0 shadow-lg dropdown-menu dropdown-menu-end rounded-3" aria-labelledby="dropdownMenu3">

        <h4 class="mb-4 fw-700 font-xss">Notification</h4>

        @forelse ((App\Models\Notification::where("user_id",auth()->id())->latest()->take(5)->get()) as $item)
            <a href="{{ $item->url ?? '#' }}">
                <div class="mb-3 border-0 card bg-transparent-card w-100 border-bottom shadow">
                    <p class="mt-0 mb-1 font-xsss text-grey-900 fw-700 d-block">
                        {{ $item->created_at->diffForHumans() }}</p>
                    <h6 class="text-grey-500 fw-500 font-xssss lh-4">{{ $item->message }}</h6>
                </div>
            </a>
        @empty
            <h1 class="text-center text-danger">No Notifications Found!</h1>
        @endforelse


    </div>
    <a href="{{ route('chat') }}" class="p-2 text-center ms-3"><i class="text-current font-xl"
            style="margin-top: -10px">{!! $icons->getIcon('message-circle') !!}</i></a>
    <div class="p-2 text-center cursor-pointer ms-3 position-relative dropdown-menu-icon menu-icon">
        <i class="text-current animation-spin d-inline-block font-xl"
            style="margin-top: -10px">{!! $icons->getIcon('settings') !!}</i>
        @livewire('menu-setting')
    </div>


    <a href="#" class="p-0 ms-3 menu-icon"><img
            src="{{ auth()->user()->profile ? asset('storage') . '/' . auth()->user()->profile : 'images/profile-4.png' }}"
            alt="user" class="w40 mt--1"></a>

</div>
