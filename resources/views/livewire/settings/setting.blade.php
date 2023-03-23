<div class="main-content bg-lightblue theme-dark-bg right-chat-active">
    @php
        $icons = new \Feather\IconManager();
        $icons->setSize(14);
    @endphp
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="middle-wrap">
                <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">

                    <div class="card-body p-lg-5 p-4 w-100 border-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="mb-4 font-xxl fw-700 mont-font mb-lg-5 mb-4 font-md-xs">Settings</h4>
                                <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">Genaral</div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{ route('settings.account_information') }}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-primary-gradiant text-white  font-md me-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('home') !!}</i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Acount Information</h4><i
                                                class=" font-xsss text-grey-500 ms-auto mt-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('arrow-right') !!}</i>
                                        </a></li>
                                    <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{ route('settings.saved_posts') }}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-gold-gradiant text-white  font-md me-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('map-pin') !!}</i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Saved Posts</h4><i
                                                class=" font-xsss text-grey-500 ms-auto mt-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('arrow-right') !!}</i>
                                        </a></li>
                                    <li class="list-inline-item d-block me-0"><a href="{{ route('settings.socials') }}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-red-gradiant text-white  font-md me-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('twitter') !!}</i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Social Accounts</h4><i
                                                class=" font-xsss text-grey-500 ms-auto mt-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('arrow-right') !!}</i>
                                        </a></li>
                                </ul>

                                <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Acount</div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item d-block  me-0"><a
                                            href="{{ route('settings.password_update') }}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-blue-gradiant text-white  font-md me-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('inbox') !!}</i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Password</h4><i
                                                class=" font-xsss text-grey-500 ms-auto mt-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('arrow-right') !!}</i>
                                        </a></li>
                                </ul>

                                <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Other</div>
                                <ul class="list-inline">
                                    <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{ route('settings.notifications') }}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-gold-gradiant text-white font-md me-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('bell') !!}</i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Notification</h4><i
                                                class=" font-xsss text-grey-500 ms-auto mt-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('arrow-right') !!}</i>
                                        </a></li>
                                    <li class="list-inline-item d-block border-bottom me-0"><a
                                            href="{{ route('settings.help') }}"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-primary-gradiant text-white  font-md me-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('help-circle') !!}</i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Help</h4><i
                                                class=" font-xsss text-grey-500 ms-auto mt-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('arrow-right') !!}</i>
                                        </a></li>
                                    <li class="list-inline-item d-block me-0" wire:click="logout"><a href="#"
                                            class="pt-2 pb-2 d-flex align-items-center"><i
                                                class="btn-round-md bg-red-gradiant text-white  font-md me-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('lock') !!}</i>
                                            <h4 class="fw-600 font-xsss mb-0 mt-0">Logout</h4><i
                                                class=" font-xsss text-grey-500 ms-auto mt-3"
                                                style="margin-top: -10px">{!! $icons->getIcon('arrow-right') !!}</i>
                                        </a></li>

                                </ul>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
