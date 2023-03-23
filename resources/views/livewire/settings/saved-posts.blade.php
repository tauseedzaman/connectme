<div class="main-content right-chat-active">
    <?php
    $icons = new \Feather\IconManager();
    ?>
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <a href="{{ route('settings') }}" class="d-inline-block mt-2"><i class=" font-sm text-white"
                                style="margin-top: -10px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"
                                    aria-hidden="true" style="margin-top: -15px;">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg> </i></a>
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Saved Posts</h4>
                    </div>
                </div>
                <div class="col-xl-10">

                    <div class="card w-100 border-0 shadow-none bg-transparent mt-5">
                        <div id="" class="accordion mb-0">
                            @forelse ($posts as $post)
                                <a
                                    href="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->post->uuid]) }}">
                                    <div class="card shadow-xss">
                                        <div class="card-header" id="">
                                            <h5 class="mb-0">
                                                @if ($post->post->content)
                                                    {{ Str::limit($post->post->content, $limit = 90, $end = '...') }}
                                                @else
                                                    Click here to view this post
                                                @endif

                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <h1 class="text-center text-danger">No Posts Found..</h1>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
