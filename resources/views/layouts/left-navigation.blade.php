<nav class="navigation scroll-bar">
    <?php
    $icons = new \Feather\IconManager();
    ?>
    <div class="container ps-0 pe-0">
        <div class="nav-content">
            <div class="pt-3 pb-1 mt-2 mb-2 bg-white nav-wrap bg-transparent-card rounded-xxl shadow-xss">
                <div class="nav-caption fw-600 font-xssss text-grey-500"><span>New </span>Feeds</div>
                <ul class="mb-1 top-content">
                    <li class="logo d-none d-xl-block d-lg-block"></li>
                    <li><a href="{{ config('app.url') }}" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-blue-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('tv') !!}</i><span>Newsfeed</span></a></li>
                    <li><a href="{{ route('pages') }}" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-red-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('award') !!}</i><span>Popular Pages</span></a></li>
                    {{-- <li><a href="default-storie.html" class="nav-content-bttn open-font" ><i class=" btn-round-md bg-gold-gradiant me-3" style="margin-top: -10px">{!! $icons->getIcon("globe")  !!}</i><span>Explore Stories</span></a></li> --}}
                    <li><a href="{{ route('groups') }}" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-mini-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('zap') !!}</i><span>Popular Groups</span></a>
                    </li>
                    <li><a href="user-page.html" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-primary-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('user') !!}</i><span>Author Profile </span></a>
                    </li>
                </ul>
            </div>


            <div class="pt-3 pb-1 bg-white nav-wrap bg-transparent-card rounded-xxl shadow-xss">
                <div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Account</div>
                <ul class="mb-1">
                    <li class="logo d-none d-xl-block d-lg-block"></li>
                    <li><a href="{{ route('settings') }}" class="h-auto pt-2 pb-2 nav-content-bttn open-font"><i
                                class="font-sm  me-3 text-grey-500"
                                style="margin-top: -10px">{!! $icons->getIcon('settings') !!}</i><span>Settings</span></a></li>
                    <li><a href="{{ url("chat") }}" class="h-auto pt-2 pb-2 nav-content-bttn open-font"><i
                                class="font-sm -square me-3 text-grey-500"
                                style="margin-top: -10px">{!! $icons->getIcon('message-circle') !!}</i><span>Chat</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
