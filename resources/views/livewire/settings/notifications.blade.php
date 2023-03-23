<div class="main-content right-chat-active">
    @php
        $icons = new \Feather\IconManager();
        $icons->setSize(18);
    @endphp
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">

                <div class="col-xl-12">
                    <div class="chat-wrapper p-3 w-100 position-relative scroll-bar bg-white theme-dark-bg">
                        <h2 class="fw-700 mb-4 mt-2 font-md text-grey-900 d-flex align-items-center">Notification
                            <span
                                class="circle-count bg-warning text-white font-xsssss rounded-3 ms-2 ls-3 fw-600 p-2  mt-0">{{ App\Models\Notification::where(['user_id' => auth()->id(), 'read_at' => null])->count() ?? '0' }}</span>
                            <a href="#" title="read notifications" wire:click="readall"
                                class="ms-auto btn-round-sm bg-greylight rounded-3"
                                style="margin-top: -10px">{!! $icons->getIcon('hard-drive') !!}<i
                                    class=" font-xss text-grey-500"></i></a>
                            <a href="#" title="clear notifications" wire:click="clear"
                                class="ms-2 btn-round-sm bg-greylight rounded-3"
                                style="margin-top: -10px">{!! $icons->getIcon('trash-2') !!}<i
                                    class=" font-xss text-grey-500"></i></a>
                        </h2>

                        </h2>

                        <ul class>
                            @forelse ($notifications as $notification)
                                <li class="border-bottom">
                                    <a href="{{ $notification->url }}"
                                        class="d-flex align-items-center p-3 rounded-3 {{ $notification->read_at == null ? 'bg-lightblue' : 'bg-light' }} theme-light-bg">
                                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20">
                                            {{ $notification->message }} <span
                                                class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto">{{ $notification->created_at->diffForHumans() }}</span>
                                        </h6>
                                        <i class=" text-grey-500 font-xs ms-auto"
                                            style="margin-top: -10px">{!! $icons->getIcon('arrow-right-circle') !!}</i>
                                    </a>
                                </li>
                            @empty
                                <h1 class="text-center text-danger">No Notifications..</h1>
                            @endforelse


                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
