<div class="main-content right-chat-active">
    @php
        $icons = new \Feather\IconManager();
    @endphp
    <div class="middle-sidebar-bottom">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
        <div class="middle-sidebar-left">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card w-100 border-0 p-0 rounded-3 overflow-hidden bg-image-contain bg-image-center"
                        style="background-image: url(images/help-bg.png);">
                        <div class="card-body p-md-5 p-4 text-center" style="background-color:rgba(0,85,255,0.8)">
                            <h2 class="fw-700 display2-size text-white display2-md-size lh-2">Welcome to the
                                {{ config('app.name') }} Commuinity!</h2>
                            <p class="font-xsss ps-lg-5 pe-lg-5 lh-28 text-grey-200">Here You can find answer to all of
                                your questions </p>
                            <div
                                class="form-group w-lg-75 mt-4 border-light border p-1 bg-white rounded-3 ms-auto me-auto">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group icon-input mb-0">
                                            <i class=" font-xs text-grey-400"
                                                style="margin-top: -10px">{!! $icons->getIcon('search') !!}</i>
                                            <input wire:model="search" type="text"
                                                class="style1-input border-0 ps-5 font-xsss mb-0 text-grey-500 fw-500 bg-transparent"
                                                placeholder="Search anythings..">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#"
                                            class="w-100 d-block btn bg-current text-white font-xssss fw-600 ls-3 style1-input p-0 border-0 text-uppercase ">Search</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card w-100 border-0 shadow-none bg-transparent mt-5">
                        <div class="accordion" id="accordionExample">
                            @forelse ($data as $item)
                                <div class="card">
                                    <div class="card-header" id="{{ $item->id }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#x{{ $item->id }}" aria-expanded="true"
                                                aria-controls="x{{ $item->id }}">
                                                {{ $item->question }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="x{{ $item->id }}" class="collapse {{ $item->first ? 'show' : '' }}"
                                        aria-labelledby="{{ $item->id }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            {{ $item->answer }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h1 class="text-center text-danger">No Found!..</h1>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
