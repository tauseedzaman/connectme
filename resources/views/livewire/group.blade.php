<div class="main-content right-chat-active">
    @php
        $icons = new \Feather\IconManager();
        $icons->setSize(14);
    @endphp
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row">
                <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
                    <div class="card w-100 shadow-xss rounded-xxl overflow-hidden border-0 mb-3 mt-3 pb-3">
                        <div class="card-body position-relative h150 bg-image-cover bg-image-center"
                            style="background-image: url({{ asset('storage') . '/' . $group->thumbnail }});"></div>
                        <div class="card-body d-block pt-4 text-center">
                            <figure class="avatar mt--6 position-relative w75 z-index-1 w100 z-index-1 ms-auto me-auto">
                                <img src="{{ asset('storage') . '/' . $group->icon }}" alt="image"
                                    class="p-1 bg-white rounded-xl w-100">
                            </figure>
                            <h4 class="font-xs ls-1 fw-700 text-grey-900">{{ $group->name }} <span
                                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">@surfiyazakir22</span>
                            </h4>
                        </div>
                        <div class="card-body d-flex align-items-center ps-4 pe-4 pt-0">
                            <h4 class="font-xsssss text-center text-grey-500 fw-600 ms-2 me-2"><b
                                    class="text-grey-900 mb-1 font-xss fw-700 d-inline-block ls-3 text-dark">{{ App\Models\Post::where('group_id', $group->id)->count() }}
                                </b> Posts</h4>
                            <h4 class="font-xsssss text-center text-grey-500 fw-600 ms-2 me-2"><b
                                    class="text-grey-900 mb-1 font-xss fw-700 d-inline-block ls-3 text-dark">{{ App\Models\GroupMember::where('group_id', $group->id)->count() }}
                                </b> Members</h4>
                            {{-- <h4 class="font-xsssss text-center text-grey-500 fw-600 ms-2 me-2"><b class="text-grey-900 mb-1 font-xss fw-700 d-inline-block ls-3 text-dark">32k </b> Follow</h4> --}}
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center ps-4 pe-4 pt-0">
                            @if (App\Models\GroupMember::where(['user_id' => auth()->id(), 'group_id' => $group->id])->exists())
                                <a wire:click="leave({{ $group->id }})"
                                    class="bg-warning p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Leave</a>
                            @elseif (App\Models\Group::where(['user_id' => auth()->id(), 'id' => $group->id])->exists())
                                <a
                                    class="bg-primary p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Settings</a>
                            @else
                                <a wire:click="join({{ $group->id }})"
                                    class="bg-success p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Join</a>
                            @endif
                            <a href="#" class="bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700"><i
                                    class=" font-md" style="margin-top: -10px">{!! $icons->getIcon('mail') !!}</i></a>
                            {{-- <a href="#" class="bg-greylight theme-white-bg btn-round-lg ms-2 rounded-3 text-grey-700"><i class="ti-more font-md"></i></a> --}}
                        </div>
                    </div>
                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-block p-4">
                            <h4 class="fw-700 mb-3 font-xsss text-grey-900">About</h4>
                            <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">{{ $group->description }}</p>
                        </div>
                        <div class="card-body border-top-xs d-flex">
                            <i class=" text-grey-500 me-3 font-lg">{!! $group->is_private == 1 ? $icons->getIcon('luck') : '-' !!}</i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-0">Private <span
                                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">Only Accessable thro
                                    URL</span></h4>
                        </div>

                        {{-- <div class="card-body d-flex pt-0">
                            <i class="feather-eye text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-0">Visble <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">Anyone can find you</span></h4>
                        </div> --}}
                        <div class="card-body d-flex pt-0">
                            <i class=" text-grey-500 me-3 font-lg" style="margin-top: -10px">{!! $icons->getIcon('map-pin') !!}</i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $group->location }} </h4>
                        </div>
                        <div class="card-body d-flex pt-0">
                            <i class=" text-grey-500 me-3 font-lg" style="margin-top: -10px">{!! $icons->getIcon('users') !!}</i>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $group->type }}</h4>
                        </div>
                    </div>
                    @if (count($group_images))

                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-flex align-items-center  p-4">
                                <h4 class="fw-700 mb-0 font-xssss text-grey-900">Photos</h4>
                                <a href="#" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                            </div>
                            <div class="card-body d-block pt-0 pb-2">
                                <div class="row">
                                    {{-- @foreach ($group->posts as $post) --}}

                                    @foreach ($group_images as $image)
                                        <div class="mb-2 col-6 pe-1"><a
                                                href="{{ asset('storage') . '/' . json_decode($image->file)[0] }}"
                                                data-lightbox="roadtrip"><img
                                                    src="{{ asset('storage') . '/' . json_decode($image->file)[0] }}"
                                                    alt="image" class="img-fluid rounded-3 w-100"></a>
                                        </div>
                                    @endforeach
                                    {{-- @endforeach --}}
                                </div>
                            </div>
                            <div class="card-body d-block w-100 pt-0">
                                <a href="#"
                                    class="p-2 lh-28 w-100 d-block bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i
                                        class=" font-xss me-2" style="margin-top: -10px">{!! $icons->getIcon('external-link') !!}</i>
                                    More</a>
                            </div>
                        </div>
                    @endif



                </div>
                <div class="col-xl-8 col-xxl-9 col-lg-8">

                    @if (App\Models\GroupMember::where(['user_id' => auth()->id(), 'group_id' => $group->id])->exists() ||
                        App\Models\Group::where(['user_id' => auth()->id(), 'id' => $group->id]))
                        @livewire('components.create-post', ['type' => 'group', 'id' => $group->id])
                    @endif

                    @forelse ($posts as $post)
                        <div class="p-4 mb-3 border-0 card w-100 shadow-xss rounded-xxl">
                            <div class="p-0 card-body d-flex">
                                <figure class="avatar me-3"><img
                                        src="{{ asset('storage') . '/' . $post->user->profile ?? 'images/user-7.png' }}"
                                        alt="image" class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="mt-1 fw-700 text-grey-900 font-xssss">{{ $post->user->username }} <span
                                        class="mt-1 d-block font-xssss fw-500 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>
                                </h4>
                                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class=" text-grey-900 btn-round-md bg-greylight font-xss"
                                        style="margin-top: -10px">{!! $icons->getIcon('more-vertical') !!}</i></a>
                                <div class="p-4 border-0 shadow-lg dropdown-menu dropdown-menu-end rounded-xxl"
                                    aria-labelledby="dropdownMenu2">
                                    <div class="p-0 card-body d-flex">
                                        <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                        <h4 class="mt-0 fw-600 text-grey-900 font-xssss me-4">Save Link <span
                                                class="mt-1 d-block font-xsssss fw-500 lh-3 text-grey-500">Add this to
                                                your saved items</span></h4>
                                    </div>
                                    <div class="p-0 mt-2 card-body d-flex">
                                        <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                        <h4 class="mt-0 fw-600 text-grey-900 font-xssss me-4">Hide Post <span
                                                class="mt-1 d-block font-xsssss fw-500 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                    <div class="p-0 mt-2 card-body d-flex">
                                        <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                        <h4 class="mt-0 fw-600 text-grey-900 font-xssss me-4">Hide all from Group <span
                                                class="mt-1 d-block font-xsssss fw-500 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                    <div class="p-0 mt-2 card-body d-flex">
                                        <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                        <h4 class="mt-0 mb-0 fw-600 text-grey-900 font-xssss me-4">Unfollow Group <span
                                                class="mt-1 d-block font-xsssss fw-500 lh-3 text-grey-500">Save to your
                                                saved items</span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="p-0 card-body me-lg-5">
                                <a
                                    href="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}">
                                    <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">{{ $post->content }}</p>
                                </a>
                            </div>
                            <div class="p-0 card-body d-block">
                                <div class="row ps-2 pe-2">
                                    @php
                                        $post_media = App\Models\PostMedia::where('post_id', $post->id)->first();

                                    @endphp
                                    @if ($post_media && $post_media->file_type == 'image')
                                        @php

                                            $medias = json_decode($post_media->file);
                                        @endphp
                                        @foreach ($medias as $media)
                                            @if ($loop->index > 2)
                                                @continue
                                            @endif
                                            <div
                                                class=" p-1 {{ count($medias) == 1 ? 'col-12' : 'col-xs-4 col-sm-4' }} ">
                                                <a href="{{ asset('storage') . '/' . $media }}"
                                                    data-lightbox="roadtrip"
                                                    class="{{ $loop->index == 2 ? 'position-relative d-block' : '' }}"><img
                                                        src="{{ asset('storage') . '/' . $media }}"
                                                        class="rounded-3 w-100" alt="image">
                                                    @if ($loop->index == 2)
                                                        <span
                                                            class="text-white img-count font-sm ls-3 fw-600"><b>+{{ count($medias) - 3 }}</b></span>
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    @elseif ($post_media && $post_media->file_type == 'video')
                                        <video id="my-video" class="video-js" controls preload="auto"
                                            data-setup="{}" width="100%" height="100%">
                                            <source src="{{ asset('storage') . '/' . $post_media->file }}"
                                                type="video/mp4" />
                                            <p class="vjs-no-js">
                                                To view this video please enable JavaScript, and consider upgrading to a
                                                web browser that
                                                <a href="https://videojs.com/html5-video-support/"
                                                    target="_blank">supports HTML5 video</a>
                                            </p>
                                        </video>
                                    @endif

                                </div>
                            </div>
                            <div class="p-0 mt-3 card-body d-flex">
                                @php
                                    $like = App\Models\Like::where(['post_id' => $post->id, 'user_id' => auth()->id()])->exists();
                                @endphp
                                @if ($like)
                                    <a href="#" wire:click.prevent="dislike({{ $post->id }})"
                                        class=" d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i
                                            class="text-white me-2 btn-round-xs font-xss"
                                            style="margin-top: -10px">{!! $icons->getIcon('thumbs-up', ['fill' => 'yellow']) !!}</i>{{ $post->likes ?? 0 }}
                                        Like</a>
                                @else
                                    <a href="#" wire:click.prevent="like({{ $post->id }})"
                                        class=" d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i
                                            class="text-white me-2 btn-round-xs font-xss"
                                            style="margin-top: -10px">{!! $icons->getIcon('thumbs-up') !!}</i>{{ $post->likes ?? 0 }}
                                        Like</a>
                                @endif


                                <a href="#"
                                    class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                                        class=" text-dark text-grey-900 btn-round-sm font-lg"
                                        style="margin-top: -10px">{!! $icons->getIcon('message-circle') !!}</i><span
                                        class="d-none-xss">{{ $post->comments }} Comment</span></a>
                                <a href="#" id="dropdownMenu21" data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                                        class=" text-grey-900 text-dark btn-round-sm font-lg"
                                        style="margin-top: -10px">{!! $icons->getIcon('share-2') !!} </i><span
                                        class="d-none-xs">Share</span></a>
                                <div class="p-4 border-0 shadow-lg dropdown-menu dropdown-menu-end rounded-xxl"
                                    aria-labelledby="dropdownMenu21">
                                    <h4 class="fw-700 font-xss text-grey-900 d-flex align-items-center">Share
                                        <i
                                            class="feather-x ms-auto font-xssss btn-round-xs bg-greylight text-grey-900 me-2"></i>
                                    </h4>
                                    <div class="p-0 card-body d-flex">
                                        <ul class="mt-2 d-flex align-items-center justify-content-between">
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-facebook"><i
                                                        class="text-white font-xs "
                                                        style="margin-top: -10px">{!! $icons->getIcon('facebook') !!}</i></a>
                                            </li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-twiiter"><i
                                                        class="text-white font-xs "
                                                        style="margin-top: -10px">{!! $icons->getIcon('twitter') !!}</i></a>
                                            </li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-linkedin"
                                                    style="margin-top: -10px">{!! $icons->getIcon('linkedin') !!}<i
                                                        class="text-white font-xs "></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-instagram"><i
                                                        class="text-white font-xs "
                                                        style="margin-top: -10px">{!! $icons->getIcon('instagram') !!}</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    {{-- <div class="p-0 card-body d-flex">
                                    <ul class="mt-2 d-flex align-items-center justify-content-between">
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-tumblr"><i class="text-white font-xs ti-tumblr"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-youtube"><i class="text-white font-xs ti-youtube"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-flicker"><i class="text-white font-xs ti-flickr"></i></a></li>
                                        <li class="me-1"><a href="#" class="bg-black btn-round-lg"><i class="text-white font-xs ti-vimeo-alt"></i></a></li>
                                        <li><a href="#" class="btn-round-lg bg-whatsup"><i class="text-white font-xs feather-phone"></i></a></li>
                                    </ul>
                                </div> --}}
                                    <h4 class="mt-4 mb-3 fw-700 font-xssss text-grey-500 d-flex align-items-center">
                                        Copy Link</h4>
                                    {{-- <i class="mt-3 position-absolute right-35 font-xs text-grey-500" style="">{!! $icons->getIcon("copy")  !!}</i> --}}
                                    <input type="text"
                                        value="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}"
                                        class="p-2 border-0 bg-grey text-grey-500 font-xssss lh-32 fw-600 rounded-3 w-100 theme-dark-bg">
                                </div>
                            </div>
                            <form method="POST" wire:submit.prevent="saveComment({{ $post->id }})">
                                <input type="text" placeholder="write your comments here..." required
                                    name="comment" wire:model.lazy="comment"
                                    class="p-2 border-0 bg-grey text-grey-500 font-xssss lh-32 fw-600 rounded-3 w-100 theme-dark-bg"
                                    id="">
                            </form>
                        </div>

                    @empty
                        <h1 class="text-center text-danger">No Post Fund!</h1>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
</div>
