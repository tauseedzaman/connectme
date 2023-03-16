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
                            <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Groups</h2>
                            <div class="search-form-2 ms-auto">
                                <i class=" font-xss " style="margin-top: -10px">{!! $icons->getIcon('search') !!}</i>
                                <input type="text" wire:model="search"
                                    class="form-control text-grey-500 mb-0 bg-greylight theme-dark-bg border-0"
                                    placeholder="Search here.">
                            </div>
                            <a href="{{ route('create-group') }}" title="create group"
                                class="btn-round-md ms-2 bg-greylight theme-dark-bg  bg-success rounded-3 "
                                style="font-size: 17px ;   font-size: 47px;
                            color: yellow;">+</a>
                        </div>
                    </div>

                    <div class="row ps-2 pe-1">

                        @forelse ($groups as $group)
                            <div class="col-md-6 col-sm-6 pe-2 ps-2">
                                <div class="card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                        style="background-image: url({{ asset('storage') . '/' . $group->thumbnail }});">
                                    </div>
                                    <div
                                        class="card-body d-block w-100 pl-10 pe-4 pb-4 pt-0 text-left position-relative">
                                        <figure class="avatar position-absolute w75 z-index-1"
                                            style="top:-40px; left: 15px;"><img
                                                src="{{ asset('storage') . '/' . $group->icon }}" alt="image"
                                                class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-3 mb-1"> <a href="{{ route("group",$group->uuid) }}"> {{ $group->name }}</a></h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">
                                            {{ $group->members . ' Members - ' . App\Models\Post::where('group_id', $group->id)->count() }}
                                            Posts</p>
                                        <span class="position-absolute right-15 top-0 d-flex align-items-center">
                                            {{-- <a href="#" class="d-lg-block d-none"><i --}}
                                            {{-- class="feather-video btn-round-md font-md bg-primary-gradiant text-white"></i></a> --}}
                                            @if (App\Models\GroupMember::where(['user_id' => auth()->id(), 'group_id' => $group->id])->exists())
                                                <a wire:click="leave({{ $group->id }})"
                                                    class="mt-4 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-warning font-xsssss fw-700 ls-lg text-white">Leave</a>
                                            @else
                                                <a wire:click="join({{ $group->id }})"
                                                    class="mt-4 p-0 btn p-2 lh-24 w100 ms-1 ls-3 d-inline-block rounded-xl bg-current font-xsssss fw-700 ls-lg text-white">Join</a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h1 class="text-center-text-warning">No Group Fund...</h1>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
