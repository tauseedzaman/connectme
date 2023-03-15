<div class="main-content bg-white right-chat-active">
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="row">
                <div class="col-xl-12 mb-4">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div
                                class="card p-lg-5 p-4 bg-primary-gradiant rounded-3 shadow-xss bg-pattern border-0 overflow-hidden">
                                <div class="bg-pattern-div"></div>
                                <h2 class="display2-size display2-md-size fw-700 text-white mb-0 mt-0">Create Your Own
                                    Page </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 mx-auto">
                            <div class="page-title mt-3">
                                <p class="text-center text-info">Provide the required information in order to create a
                                    page</p>
                                <form wire:submit.prevent="createpage" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-gorup">
                                                <label class="mont-font fw-600 font-xssss">Page Name</label>
                                                <input type="text" name="name" wire:model.lazy="name"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="form-gorup">
                                                <label class="mont-font fw-600 font-xssss">Location</label>
                                                <input type="text" name="location" wire:model.lazy="location"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-12 mb-3">
                                            <div class="form-gorup">
                                                <label class="mont-font fw-600 font-xssss">Type</label>
                                                <input type="text" name="type" wire:model.lazy="type"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <label class="mont-font fw-600 font-xssss">Page Icon</label>
                                            <div class="custom-file">
                                                <input id="icon" wire:model.lazy="icon"
                                                    class="custom-file-input" type="file" name="icon">
                                                <label for="icon" class="custom-file-label">Page Icon</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            @if ($icon)
                                                <img src="{{ $icon->temporaryUrl() }}" alt=""
                                                    width="width:10px">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <label class="mont-font fw-600 font-xssss">Page Thumbnail</label>
                                            <div class="custom-file">
                                                <input id="thumbnail" wire:model.lazy="thumbnail"
                                                    class="custom-file-input" type="file" name="thumbnail">
                                                <label for="thumbnail" class="custom-file-label">Page Thumbnail</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            @if ($thumbnail)
                                                <img src="{{ $thumbnail->temporaryUrl() }}" alt=""
                                                    width="width:10px">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <div class="form-group">
                                                <label for="description">Page Description</label>
                                                <textarea id="description" class="form-control" name="description" rows="3" wire:model.lazy="description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <button class="btn btn-success btn-block" type="submit">Create
                                                Page</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
