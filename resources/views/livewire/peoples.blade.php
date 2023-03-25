<div class="main-content right-chat-active">
    @php
        $icons = new \Feather\IconManager();
        $icons->setSize(14);
    @endphp
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="p-4 mb-3 border-0 card shadow-xss w-100 d-block d-flex">
                        <div class="p-0 card-body d-flex align-items-center">
                            <h2 class="mt-0 mb-0 fw-700 font-md text-grey-900">Explore</h2>
                            <div class="search-form-2 ms-auto">
                                <i class=" font-xss" style="margin-top: -10px">{!! $icons->getIcon('search') !!}</i>
                                <input type="text" wire:model="search"
                                    class="mb-0 border-0 form-control text-grey-500 bg-greylight theme-dark-bg"
                                    placeholder="Search here.">
                            </div>
                        </div>
                    </div>

                    <div class="row ps-2 pe-2">
                        @forelse ($users as $user)
                            <div class="col-md-3 col-sm-4 pe-2 ps-2">
                                <div class="mb-3 overflow-hidden border-0 card d-block shadow-xss rounded-3">
                                    <div class="pb-4 text-center card-body d-block w-100 ps-3 pe-3">
                                        <figure class="mb-0 avatar ms-auto me-auto position-relative w65 z-index-1"><img
                                                src="{{ asset('storage') . '/' . $user->profile }}" alt="image"
                                                class="float-right p-0 bg-white rounded-circle w-100 shadow-xss">
                                        </figure>
                                        <div class="clearfix"></div>
                                        <h4 class="mt-3 mb-1 fw-700 font-xsss">
                                            {{ $user->first_name . ' ' . $user->last_name }}
                                        </h4>
                                        <small class="mt-3 mb-1"><a
                                                href="{{ route('user', $user->uuid) }}">{{ ' @' . $user->username }}</a></small><br>
                                        <span
                                            class="mt-1 d-block font-xssss fw-500 lh-3 text-grey-500">{{ $user->mutual_friends() }}
                                            mutual
                                            friends</span>
                                        <br>
                                        @if (App\Models\Friend::Where([
                                            'friend_id' => auth()->id(),
                                            'user_id' => $user->id,
                                            'status' => 'pending',
                                        ])->exists())
                                            <button wire:click="acceptfriend('{{ $user->id }}')"
                                                class="pt-2 pb-2 mt-0 text-white btn ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-primary font-xsssss fw-700 ls-lg">ACCEPT</button>
                                        @elseif (App\Models\Friend::Where([
                                            'friend_id' => $user->id,
                                            'user_id' => auth()->id(),
                                            'status' => 'pending',
                                        ])->exists())
                                            <button wire:click="removefriend('{{ $user->uuid }}')"
                                                class="pt-2 pb-2 mt-0 text-white btn ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-warning font-xsssss fw-700 ls-lg">CANCEL</button>
                                        @elseif (App\Models\Friend::Where([
                                            'friend_id' => auth()->id(),
                                            'user_id' => $user->id,
                                            'status' => 'rejected',
                                        ])->exists())
                                            <button wire:click="addfriend('{{ $user->uuid }}')"
                                                class="pt-2 pb-2 mt-0 text-white btn ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg">ADD
                                                FRIEND</button>
                                        @elseif ($user->is_friend() == 'accepted')
                                            <button
                                                class="pt-2 pb-2 mt-0 text-white btn ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-info font-xsssss fw-700 ls-lg">FRIEND</button>
                                        @else
                                            <button wire:click="addfriend('{{ $user->uuid }}')"
                                                class="pt-2 pb-2 mt-0 text-white btn ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg">ADD
                                                FRIEND</button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col pe-2 ps-2">
                                <h1>No Member available</h1>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
