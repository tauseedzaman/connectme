<div class="main-content right-chat-active">
    @php
        $icons = new \Feather\IconManager();
        $icons->setSize(14);
    @endphp
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                        <div class="card-body d-flex align-items-center p-0">
                            <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Pages</h2>
                            <div class="search-form-2 ms-auto">
                                <i class=" font-xss " style="margin-top: -10px">{!! $icons->getIcon('search') !!}</i>
                                <input type="text" wire:model="search"
                                    class="form-control text-grey-500 mb-0 bg-greylight theme-dark-bg border-0"
                                    placeholder="Search here.">
                            </div>
                            <a href="{{ route('create-page') }}" title="create page"
                                class="btn-round-md ms-2 bg-greylight theme-dark-bg  bg-success rounded-3 "
                                style="font-size: 17px ;   font-size: 47px;
                            color: yellow;">+</a>
                        </div>
                    </div>

                    <div class="row ps-2 pe-1">
                        @forelse ($pages as $page)
                            <div class="col-md-4 col-sm-6 pe-2 ps-2">
                                <div class="card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3">
                                    <div class="card-body d-block w-100 p-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w90 z-index-1"><img
                                                src="{{ asset('storage') . '/' . $page->icon }}" alt="image"
                                                class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xss mt-3 mb-0"> <a
                                                href="{{ route('page', $page->uuid) }}"> {{ $page->name }}</a> </h4>
                                        <p class="fw-500 font-xssss text-grey-500 mt-0 mb-3">{{ $page->location }}</p>
                                        <ul class="d-flex align-items-center justify-content-center mt-1">
                                            <li class="m-2">
                                                <h4 class="fw-700 font-sm">
                                                    {{ App\Models\Post::where('page_id', $page->id)->count() }} <span
                                                        class="font-xsssss fw-500 mt-1 text-grey-500 d-block">Posts</span>
                                                </h4>
                                            </li>
                                            <li class="m-2">
                                                <h4 class="fw-700 font-sm">{{ $page->members }} <span
                                                        class="font-xsssss fw-500 mt-1 text-grey-500 d-block">Follower</span>
                                                </h4>
                                            </li>
                                        </ul>
                                        {{-- <ul class="d-flex align-items-center justify-content-center mt-1">
                                        <li class="m-1"><img src="images/top-student.svg" alt="icon"></li>
                                        <li class="m-1"><img src="images/onfire.svg" alt="icon"></li>
                                        <li class="m-1"><img src="images/challenge-medal.svg" alt="icon"></li>
                                        <li class="m-1"><img src="images/fast-graduate.svg" alt="icon"></li>
                                    </ul> --}}
                                        @if (App\Models\PageLike::where(['user_id' => auth()->id(), 'page_id' => $page->id])->exists())
                                            <a wire:click="ulfollow({{ $page->id }})"
                                                class="mt-4 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-warning font-xsssss fw-700 ls-lg text-white">UNFOLLOW</a>
                                        @else
                                            <a wire:click="follow({{ $page->id }})"
                                                class="mt-4 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-current font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @empty
                            <h1 class="text-center text-danger">No Page Fund!</h1>
                        @endforelse


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
